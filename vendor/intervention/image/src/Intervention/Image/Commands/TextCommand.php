<?php

namespace Ttc\Intervention\Image\Commands;

use Closure;

class TextCommand extends \Ttc\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Write text on given image
     * @param \Ttc\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $text = $this->argument(0)->required()->value();
        $x = $this->argument(1)->type('numeric')->value(0);
        $y = $this->argument(2)->type('numeric')->value(0);
        $callback = $this->argument(3)->type('closure')->value();

        $fontclassname = sprintf('\Intervention\Image\%s\Font',
            $image->getDriver()->getDriverName());

        $font = new $fontclassname($text);

        if ($callback instanceof Closure) {
            $callback($font);
        }

        $font->applyToImage($image, $x, $y);

        return true;
    }
}
