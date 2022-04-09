<?php

namespace Ttc\Freebies\Intervention\Image\Gd\Commands;

use Ttc\Freebies\Intervention\Image\Commands\AbstractCommand;

class DestroyCommand extends \Ttc\Freebies\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Destroys current image core and frees up memory
     *
     * @param  \Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        // destroy image core
        imagedestroy($image->getCore());

        // destroy backups
        foreach ($image->getBackups() as $backup) {
            imagedestroy($backup);
        }

        return true;
    }
}
