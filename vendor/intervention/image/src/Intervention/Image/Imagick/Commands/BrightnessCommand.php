<?php

namespace Ttc\Intervention\Image\Imagick\Commands;

use Ttc\Intervention\Image\Commands\AbstractCommand;

class BrightnessCommand extends \Ttc\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Changes image brightness
     *
     * @param \Ttc\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $level = $this->argument(0)->between(-100, 100)->required()->value();

        return $image->getCore()->modulateImage(100 + $level, 100, 100);
    }
}
