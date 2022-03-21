<?php

namespace Ttc\Intervention\Image\Imagick\Commands;

use Ttc\Intervention\Image\Commands\AbstractCommand;

class InvertCommand extends \Ttc\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Inverts colors of an image
     *
     * @param \Ttc\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        return $image->getCore()->negateImage(false);
    }
}
