<?php

namespace Ttc\Freebies\Intervention\Image\Imagick\Commands;

use Ttc\Freebies\Intervention\Image\Commands\ExifCommand as BaseCommand;
use Ttc\Freebies\Intervention\Image\Exception\NotSupportedException;

class ExifCommand extends \Ttc\Freebies\Intervention\Image\Commands\ExifCommand
{
    /**
     * Prefer extension or not
     *
     * @var bool
     */
    private $preferExtension = true;

    /**
     *
     */
    public function dontPreferExtension() {
        $this->preferExtension = false;
    }

    /**
     * Read Exif data from the given image
     *
     * @param \Ttc\Freebies\Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        if ($this->preferExtension && function_exists('exif_read_data')) {
            return parent::execute($image);
        }

        $core = $image->getCore();

        if ( ! method_exists($core, 'getImageProperties')) {
            throw new \Ttc\Freebies\Intervention\Image\Exception\NotSupportedException(
                "Reading Exif data is not supported by this PHP installation."
            );
        }

        $requestedKey = $this->argument(0)->value();
        if ($requestedKey !== null) {
            $this->setOutput($core->getImageProperty('exif:' . $requestedKey));
            return true;
        }

        $exif = [];
        $properties = $core->getImageProperties();
        foreach ($properties as $key => $value) {
            if (substr($key, 0, 5) !== 'exif:') {
                continue;
            }

            $exif[substr($key, 5)] = $value;
        }

        $this->setOutput($exif);
        return true;
    }
}
