<?php

namespace Ttc\Intervention\Image\Gd\Commands;

use Ttc\Intervention\Image\Commands\AbstractCommand;

class InterlaceCommand extends \Ttc\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Toggles interlaced encoding mode
     *
     * @param \Ttc\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $mode = $this->argument(0)->type('bool')->value(true);

        imageinterlace($image->getCore(), $mode);

        return true;
    }
}
