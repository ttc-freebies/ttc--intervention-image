<?php

namespace Ttc\Freebies\Intervention\Image\Gd\Commands;

use Ttc\Freebies\Intervention\Image\Commands\AbstractCommand;

class BrightnessCommand extends \Ttc\Freebies\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Changes image brightness
     *
     * @param  \Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $level = $this->argument(0)->between(-100, 100)->required()->value();

        return imagefilter($image->getCore(), IMG_FILTER_BRIGHTNESS, ($level * 2.55));
    }
}
