<?php

namespace App\Lib\Components;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component as ViewComponent;
use Illuminate\View\ComponentAttributeBag;

abstract class Component extends ViewComponent
{
    // public ClassName $classes;

    public $classes;

    public function __construct()
    {
        $this->classes = new ClassName;
    }

    public function data()
    {
        $traits = collect(get_declared_traits())->filter(fn ($x) => Str::of($x)->contains("App\Traits\Components"));
        foreach ($traits as $trait) {
            $this->{class_basename($trait)}();
        }
        return parent::data();
    }
}
