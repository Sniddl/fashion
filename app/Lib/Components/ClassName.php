<?php

namespace App\Lib\Components;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ClassName
{
    public Collection $classes;

    public function __construct()
    {
        $this->classes = collect([]);
    }

    public function __toString()
    {
        return $this->classes->unique()->join(" ");
    }

    public function add(...$args)
    {
        foreach ($args as $arg) {
            $names = Str::of($arg)->trim()->explode(' ');
            foreach ($names as $name) {
                $this->classes->push($name);
            }
        }
        return $this;
    }

    public function remove($value)
    {
        $this->classes = $this->classes->filter(fn ($x) => $x != $value);
        return $this;
    }

    public function toggle($value)
    {
        if ($this->classes->contains($value)) {
            $this->remove($value);
        } else {
            $this->add($value);
        }
        return $this;
    }
}
