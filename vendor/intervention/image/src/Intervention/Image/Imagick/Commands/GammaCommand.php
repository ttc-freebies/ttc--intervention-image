<?php

namespace Ttc\Freebies\Intervention\Image\Imagick\Commands;

use Ttc\Freebies\Intervention\Image\Commands\AbstractCommand;

class GammaCommand extends \Ttc\Freebies\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Applies gamma correction to a given image
     *
     * @param \Ttc\Freebies\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $gamma = $this->argument(0)->type('numeric')->required()->value();

        return $image->getCore()->gammaImage($gamma);
    }
}
