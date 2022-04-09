<?php

namespace Ttc\Freebies\Intervention\Image\Imagick\Commands;

use Ttc\Freebies\Intervention\Image\Commands\AbstractCommand;

class FlipCommand extends \Ttc\Freebies\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Mirrors an image
     *
     * @param \Ttc\Freebies\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $mode = $this->argument(0)->value('h');

        if (in_array(strtolower($mode), [2, 'v', 'vert', 'vertical'])) {
            // flip vertical
            return $image->getCore()->flipImage();
        } else {
            // flip horizontal
            return $image->getCore()->flopImage();
        }
    }
}
