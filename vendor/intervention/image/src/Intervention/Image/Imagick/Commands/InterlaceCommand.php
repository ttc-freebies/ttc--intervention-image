<?php

namespace Ttc\Freebies\Intervention\Image\Imagick\Commands;

use Ttc\Freebies\Intervention\Image\Commands\AbstractCommand;

class InterlaceCommand extends \Ttc\Freebies\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Toggles interlaced encoding mode
     *
     * @param \Ttc\Freebies\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $mode = $this->argument(0)->type('bool')->value(true);

        if ($mode) {
            $mode = \Imagick::INTERLACE_LINE;
        } else {
            $mode = \Imagick::INTERLACE_NO;
        }

        $image->getCore()->setInterlaceScheme($mode);

        return true;
    }
}
