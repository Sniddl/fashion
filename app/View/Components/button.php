<?php

namespace App\View\Components;

use App\Lib\Components\Component as ComponentsComponent;
use App\Traits\Components\HasColor;
use Exception;
use Illuminate\View\Component;




class button extends ComponentsComponent
{

    use HasColor;

    public string $role;
    public string $href;

    public string $style = "p-3 rounded";

    public string $el = "button";

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $bgColor = "red", string $role = "button", string $href = "#")
    {
        parent::__construct();
        if (!collect(["button", "link"])->contains($role)) {
            throw new Exception("Invalid role option", 1);
        }

        if ($role == "link") {
            $this->el = "a";
        }

        $this->role = $role;
        $this->bgColor = $bgColor;
        $this->href = $href;

        $this->classes->add("p-3 rounded inline-block");
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.button');
    }
}
