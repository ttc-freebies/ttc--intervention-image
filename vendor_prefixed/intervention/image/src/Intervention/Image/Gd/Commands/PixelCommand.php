<?php

namespace Ttc\Intervention\Image\Gd\Commands;

use Ttc\Intervention\Image\Commands\AbstractCommand;
use Ttc\Intervention\Image\Gd\Color;

class PixelCommand extends \Ttc\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Draws one pixel to a given image
     *
     * @param  \Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $color = $this->argument(0)->required()->value();
        $color = new \Ttc\Intervention\Image\Gd\Color($color);
        $x = $this->argument(1)->type('digit')->required()->value();
        $y = $this->argument(2)->type('digit')->required()->value();

        return imagesetpixel($image->getCore(), $x, $y, $color->getInt());
    }
}