<?php

namespace Ttc\Intervention\Image\Gd\Commands;

use Ttc\Intervention\Image\Commands\AbstractCommand;

class GammaCommand extends \Ttc\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Applies gamma correction to a given image
     *
     * @param \Ttc\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $gamma = $this->argument(0)->type('numeric')->required()->value();

        return imagegammacorrect($image->getCore(), 1, $gamma);
    }
}
