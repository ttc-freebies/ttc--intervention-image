<?php

namespace Ttc\Freebies\Intervention\Image\Gd\Commands;

use Ttc\Freebies\Intervention\Image\Commands\AbstractCommand;
use Ttc\Freebies\Intervention\Image\Gd\Color;
use Ttc\Freebies\Intervention\Image\Gd\Decoder;

class FillCommand extends \Ttc\Freebies\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Fills image with color or pattern
     *
     * @param \Ttc\Freebies\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $filling = $this->argument(0)->value();
        $x = $this->argument(1)->type('digit')->value();
        $y = $this->argument(2)->type('digit')->value();

        $width = $image->getWidth();
        $height = $image->getHeight();
        $resource = $image->getCore();

        try {

            // set image tile filling
            $source = new \Ttc\Freebies\Intervention\Image\Gd\Decoder;
            $tile = $source->init($filling);
            imagesettile($image->getCore(), $tile->getCore());
            $filling = IMG_COLOR_TILED;

        } catch (\Ttc\Freebies\Intervention\Image\Exception\NotReadableException $e) {

            // set solid color filling
            $color = new \Ttc\Freebies\Intervention\Image\Gd\Color($filling);
            $filling = $color->getInt();
        }

        imagealphablending($resource, true);

        if (is_int($x) && is_int($y)) {

            // resource should be visible through transparency
            $base = $image->getDriver()->newImage($width, $height)->getCore();
            imagecopy($base, $resource, 0, 0, 0, 0, $width, $height);

            // floodfill if exact position is defined
            imagefill($resource, $x, $y, $filling);

            // copy filled original over base
            imagecopy($base, $resource, 0, 0, 0, 0, $width, $height);

            // set base as new resource-core
            $image->setCore($base);
            imagedestroy($resource);

        } else {
            // fill whole image otherwise
            imagefilledrectangle($resource, 0, 0, $width - 1, $height - 1, $filling);
        }

        isset($tile) ? imagedestroy($tile->getCore()) : null;

        return true;
    }
}
