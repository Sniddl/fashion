<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class StartDevelopment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all developer commands to get up and running fast!';


    private $run = true;
    private Collection $background_processes;


    public function __construct()
    {
        parent::__construct();
        $this->background_processes = collect([]);
    }


    public function handleSignals()
    {
        if (function_exists('pcntl_signal')) {

            declare(ticks=1);

            pcntl_signal(SIGINT, [$this, 'shutdown']);
            pcntl_signal(SIGTERM, [$this, 'shutdown']);
        } else if (function_exists('sapi_windows_set_ctrl_handler')) {
            sapi_windows_set_ctrl_handler([$this, 'shutdown']);
        } else {
            throw new \Exception("Cannot handle signals");
        }
    }

    public function callArtisan(...$args)
    {
        $result = Artisan::call(...$args);
        $output = Str::of(Artisan::output())->trim();
        if ($result) {
            $this->error($output);
        } else {
            $this->info($output);
        }
    }

    public function generateEnvKey()
    {
        if (!env('APP_KEY')) {
            Artisan::call('key:generate');
        } else {
            $this->info('Application key already set.');
        };
    }

    public function migrateTables()
    {
        $this->callArtisan('migrate');
    }

    public function bg($start_output, $stop_output, $command)
    {
        $this->info($start_output);
        $process = new Process($command);
        $process->start();
        $this->background_processes->push([
            "stop_output" => $stop_output,
            "process" => $process
        ]);
    }

    public function handle()
    {

        $this->handleSignals();
        $this->generateEnvKey();
        $this->migrateTables();

        $this->bg("Installing NPM dependencies", "Stopped watching assets", ['npm', 'install']);
        $this->bg("Starting web server on localhost:8000", "Stopped web server", ['php', 'artisan', 'serve', '--host=0.0.0.0:8000']);
        $this->bg("Compiling and watching assets. Your web browser should open shortly.", "Stopped watching assets", ['npm', 'run', 'hot']);

        while ($this->run) {
            try {
                $cmd = $this->ask('What now? Run some commands here.');
                if ($cmd) {
                    $process = new Process(explode(" ", $cmd));
                    $process->run(function ($type, $buffer) {
                        echo $buffer;
                    });
                }
            } catch (\Exception $err) {
                echo "";
            }
        } // infinite loop DON'T DELETE


    }

    public function shutdown()
    {
        $this->warn("\nGracefully stopping development...");
        foreach ($this->background_processes as $bg) {
            $bg['process']->stop();
            $this->info($bg['stop_output']);
        }
        $this->run = false;
        $this->warn("BYE!");
    }
}
