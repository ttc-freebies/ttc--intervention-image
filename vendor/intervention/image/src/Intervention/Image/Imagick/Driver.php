<?php

namespace Ttc\Freebies\Intervention\Image\Imagick;

use Ttc\Freebies\Intervention\Image\AbstractDriver;
use Ttc\Freebies\Intervention\Image\Exception\NotSupportedException;
use Ttc\Freebies\Intervention\Image\Image;

class Driver extends \Ttc\Freebies\Intervention\Image\AbstractDriver
{
    /**
     * Creates new instance of driver
     *
     * @param Decoder $decoder
     * @param Encoder $encoder
     */
    public function __construct(\Ttc\Freebies\Intervention\Image\Imagick\Decoder $decoder = null, \Ttc\Freebies\Intervention\Image\Imagick\Encoder $encoder = null)
    {
        if ( ! $this->coreAvailable()) {
            throw new \Ttc\Freebies\Intervention\Image\Exception\NotSupportedException(
                "ImageMagick module not available with this PHP installation."
            );
        }

        $this->decoder = $decoder ? $decoder : new \Ttc\Freebies\Intervention\Image\Imagick\Decoder;
        $this->encoder = $encoder ? $encoder : new \Ttc\Freebies\Intervention\Image\Imagick\Encoder;
    }

    /**
     * Creates new image instance
     *
     * @param  int     $width
     * @param  int     $height
     * @param  mixed   $background
     * @return \Ttc\Freebies\Intervention\Image\Image
     */
    public function newImage($width, $height, $background = null)
    {
        $background = new \Ttc\Freebies\Intervention\Image\Imagick\Color($background);

        // create empty core
        $core = new \Imagick;
        $core->newImage($width, $height, $background->getPixel(), 'png');
        $core->setType(\Imagick::IMGTYPE_UNDEFINED);
        $core->setImageType(\Imagick::IMGTYPE_UNDEFINED);
        $core->setColorspace(\Imagick::COLORSPACE_UNDEFINED);

        // build image
        $image = new \Ttc\Freebies\Intervention\Image\Image(new static, $core);

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
        return new \Ttc\Freebies\Intervention\Image\Imagick\Color($value);
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
