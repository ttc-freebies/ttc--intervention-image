<?php

namespace Ttc\Freebies\Intervention\Image\Imagick\Commands;

use Ttc\Freebies\Intervention\Image\Commands\AbstractCommand;
use Ttc\Freebies\Intervention\Image\Imagick\Color;

class PixelCommand extends \Ttc\Freebies\Intervention\Image\Commands\AbstractCommand
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
        $color = new \Ttc\Freebies\Intervention\Image\Imagick\Color($color);
        $x = $this->argument(1)->type('digit')->required()->value();
        $y = $this->argument(2)->type('digit')->required()->value();

        // prepare pixel
        $draw = new \ImagickDraw;
        $draw->setFillColor($color->getPixel());
        $draw->point($x, $y);

        // apply pixel
        return $image->getCore()->drawImage($draw);
    }
}
