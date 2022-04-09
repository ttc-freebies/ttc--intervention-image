<?php

namespace Ttc\Freebies\Intervention\Image\Commands;

use Ttc\Freebies\Intervention\Image\Response;

class ResponseCommand extends \Ttc\Freebies\Intervention\Image\Commands\AbstractCommand
{
    /**
     * Builds HTTP response from given image
     *
     * @param  \Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $format = $this->argument(0)->value();
        $quality = $this->argument(1)->between(0, 100)->value();

        $response = new \Ttc\Freebies\Intervention\Image\Response($image, $format, $quality);

        $this->setOutput($response->make());

        return true;
    }
}
