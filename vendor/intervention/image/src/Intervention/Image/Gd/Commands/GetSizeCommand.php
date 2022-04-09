<?php

namespace Ttc\Freebies\Intervention\Image\Gd\Commands;

use Ttc\Freebies\Intervention\Image\Commands\AbstractCommand;
use Ttc\Freebies\Intervention\Image\Size;

class GetSizeCommand extends \Ttc\Freebies\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Reads size of given image instance in pixels
     *
     * @param  \Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $this->setOutput(new \Ttc\Freebies\Intervention\Image\Size(
            imagesx($image->getCore()),
            imagesy($image->getCore())
        ));

        return true;
    }
}
