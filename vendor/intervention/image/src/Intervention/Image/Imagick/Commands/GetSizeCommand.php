<?php

namespace Ttc\Freebies\Intervention\Image\Imagick\Commands;

use Ttc\Freebies\Intervention\Image\Commands\AbstractCommand;
use Ttc\Freebies\Intervention\Image\Size;

class GetSizeCommand extends \Ttc\Freebies\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Reads size of given image instance in pixels
     *
     * @param \Ttc\Freebies\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        /** @var \Imagick $core */
        $core = $image->getCore();

        $this->setOutput(new \Ttc\Freebies\Intervention\Image\Size(
            $core->getImageWidth(),
            $core->getImageHeight()
        ));

        return true;
    }
}
