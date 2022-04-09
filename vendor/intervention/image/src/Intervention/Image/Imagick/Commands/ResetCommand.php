<?php

namespace Ttc\Freebies\Intervention\Image\Imagick\Commands;

use Ttc\Freebies\Intervention\Image\Commands\AbstractCommand;
use Ttc\Freebies\Intervention\Image\Exception\RuntimeException;

class ResetCommand extends \Ttc\Freebies\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Resets given image to its backup state
     *
     * @param \Ttc\Freebies\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $backupName = $this->argument(0)->value();

        $backup = $image->getBackup($backupName);

        if ($backup instanceof \Imagick) {

            // destroy current core
            $image->getCore()->clear();

            // clone backup
            $backup = clone $backup;

            // reset to new resource
            $image->setCore($backup);

            return true;
        }

        throw new \Ttc\Freebies\Intervention\Image\Exception\RuntimeException(
            "Backup not available. Call backup({$backupName}) before reset()."
        );
    }
}
