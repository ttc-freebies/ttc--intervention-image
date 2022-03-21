<?php

namespace Ttc\Intervention\Image\Imagick\Commands;

use Ttc\Intervention\Image\Commands\AbstractCommand;

class DestroyCommand extends \Ttc\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Destroys current image core and frees up memory
     *
     * @param \Ttc\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        // destroy image core
        $image->getCore()->clear();

        // destroy backups
        foreach ($image->getBackups() as $backup) {
            $backup->clear();
        }

        return true;
    }
}
