<?php

namespace Ttc\Intervention\Image\Commands;

use Ttc\Intervention\Image\Response;

class ResponseCommand extends \Ttc\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Builds HTTP response from given image
     *
     * @param \Ttc\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $format = $this->argument(0)->value();
        $quality = $this->argument(1)->between(0, 100)->value();

        $response = new \Ttc\Intervention\Image\Response($image, $format, $quality);

        $this->setOutput($response->make());

        return true;
    }
}
