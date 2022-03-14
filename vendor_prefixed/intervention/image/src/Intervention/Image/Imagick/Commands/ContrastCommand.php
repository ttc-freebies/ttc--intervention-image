<?php

namespace Ttc\Intervention\Image\Imagick\Commands;

use Ttc\Intervention\Image\Commands\AbstractCommand;

class ContrastCommand extends \Ttc\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Changes contrast of image
     *
     * @param  \Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $level = $this->argument(0)->between(-100, 100)->required()->value();

        return $image->getCore()->sigmoidalContrastImage($level > 0, $level / 4, 0);
    }
}
