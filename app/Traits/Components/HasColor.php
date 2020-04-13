<?php

namespace App\Traits\Components;

/**
 * A trait for components that have color.
 */
trait HasColor
{
    public string $textColor = "";
    public string $textShade = "400";

    public string $bgColor = "";
    public string $bgShade = "400";

    public function HasColor()
    {
        if ($this->textColor) {
            $this->classes->add("text-$this->textColor-$this->textShade");
        }

        if ($this->bgColor) {
            $this->classes->add("bg-$this->bgColor-$this->bgShade");
        }
    }
}
