<?php

namespace Ttc\Freebies\Intervention\Image\Gd\Commands;

use Ttc\Freebies\Intervention\Image\Commands\AbstractCommand;

class BlurCommand extends \Ttc\Freebies\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Applies blur effect on image
     *
     * @param \Ttc\Freebies\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $amount = $this->argument(0)->between(0, 100)->value(1);

        for ($i=0; $i < intval($amount); $i++) {
            imagefilter($image->getCore(), IMG_FILTER_GAUSSIAN_BLUR);
        }

        return true;
    }
}
