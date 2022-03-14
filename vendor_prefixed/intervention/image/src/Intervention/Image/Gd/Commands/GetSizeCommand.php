<?php

namespace Ttc\Intervention\Image\Gd\Commands;

use Ttc\Intervention\Image\Commands\AbstractCommand;
use Ttc\Intervention\Image\Size;

class GetSizeCommand extends \Ttc\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Reads size of given image instance in pixels
     *
     * @param  \Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $this->setOutput(new \Ttc\Intervention\Image\Size(
            imagesx($image->getCore()),
            imagesy($image->getCore())
        ));

        return true;
    }
}
