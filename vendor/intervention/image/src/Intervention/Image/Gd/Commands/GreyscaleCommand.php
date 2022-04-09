<?php

namespace Ttc\Freebies\Intervention\Image\Gd\Commands;

use Ttc\Freebies\Intervention\Image\Commands\AbstractCommand;

class GreyscaleCommand extends \Ttc\Freebies\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Turns an image into a greyscale version
     *
     * @param  \Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        return imagefilter($image->getCore(), IMG_FILTER_GRAYSCALE);
    }
}
