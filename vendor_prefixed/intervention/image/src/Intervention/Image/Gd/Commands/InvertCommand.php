<?php

namespace Ttc\Intervention\Image\Gd\Commands;

use Ttc\Intervention\Image\Commands\AbstractCommand;

class InvertCommand extends \Ttc\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Inverts colors of an image
     *
     * @param  \Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        return imagefilter($image->getCore(), IMG_FILTER_NEGATE);
    }
}
