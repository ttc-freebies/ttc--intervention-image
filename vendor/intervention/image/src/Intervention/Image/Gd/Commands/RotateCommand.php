<?php

namespace Ttc\Intervention\Image\Gd\Commands;

use Ttc\Intervention\Image\Commands\AbstractCommand;
use Ttc\Intervention\Image\Gd\Color;

class RotateCommand extends \Ttc\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Rotates image counter clockwise
     *
     * @param \Ttc\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $angle = $this->argument(0)->type('numeric')->required()->value();
        $color = $this->argument(1)->value();
        $color = new \Ttc\Intervention\Image\Gd\Color($color);

        // restrict rotations beyond 360 degrees, since the end result is the same
        $angle = fmod($angle, 360);

        // rotate image
        $image->setCore(imagerotate($image->getCore(), $angle, $color->getInt()));

        return true;
    }
}
