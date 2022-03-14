<?php

namespace Ttc\Intervention\Image\Imagick;

use Ttc\Intervention\Image\AbstractDriver;
use Ttc\Intervention\Image\Exception\NotSupportedException;
use Ttc\Intervention\Image\Image;

class Driver extends \Ttc\Intervention\Image\AbstractDriver
{
    /**
     * Creates new instance of driver
     *
     * @param Decoder $decoder
     * @param Encoder $encoder
     */
    public function __construct(\Ttc\Intervention\Image\Imagick\Decoder $decoder = null, \Ttc\Intervention\Image\Imagick\Encoder $encoder = null)
    {
        if ( ! $this->coreAvailable()) {
            throw new \Ttc\Intervention\Image\Exception\NotSupportedException(
                "ImageMagick module not available with this PHP installation."
            );
        }

        $this->decoder = $decoder ? $decoder : new \Ttc\Intervention\Image\Imagick\Decoder;
        $this->encoder = $encoder ? $encoder : new \Ttc\Intervention\Image\Imagick\Encoder;
    }

    /**
     * Creates new image instance
     *
     * @param  int     $width
     * @param  int     $height
     * @param  mixed   $background
     * @return \Intervention\Image\Image
     */
    public function newImage($width, $height, $background = null)
    {
        $background = new \Ttc\Intervention\Image\Imagick\Color($background);

        // create empty core
        $core = new \Imagick;
        $core->newImage($width, $height, $background->getPixel(), 'png');
        $core->setType(\Imagick::IMGTYPE_UNDEFINED);
        $core->setImageType(\Imagick::IMGTYPE_UNDEFINED);
        $core->setColorspace(\Imagick::COLORSPACE_UNDEFINED);

        // build image
        $image = new \Ttc\Intervention\Image\Image(new static, $core);

        return $image;
    }

    /**
     * Reads given string into color object
     *
     * @param  string $value
     * @return AbstractColor
     */
    public function parseColor($value)
    {
        return new \Ttc\Intervention\Image\Imagick\Color($value);
    }

    /**
     * Checks if core module installation is available
     *
     * @return boolean
     */
    protected function coreAvailable()
    {
        return (extension_loaded('imagick') && class_exists('Imagick'));
    }
}
