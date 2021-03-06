<?php

namespace Ttc\Freebies\Intervention\Image\Gd;

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
    public function __construct(\Ttc\Freebies\Intervention\Image\Gd\Decoder $decoder = null, \Ttc\Freebies\Intervention\Image\Gd\Encoder $encoder = null)
    {
        if ( ! $this->coreAvailable()) {
            throw new \Ttc\Freebies\Intervention\Image\Exception\NotSupportedException(
                "GD Library extension not available with this PHP installation."
            );
        }

        $this->decoder = $decoder ? $decoder : new \Ttc\Freebies\Intervention\Image\Gd\Decoder;
        $this->encoder = $encoder ? $encoder : new \Ttc\Freebies\Intervention\Image\Gd\Encoder;
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
        // create empty resource
        $core = imagecreatetruecolor($width, $height);
        $image = new \Ttc\Freebies\Intervention\Image\Image(new static, $core);

        // set background color
        $background = new \Ttc\Freebies\Intervention\Image\Gd\Color($background);
        imagefill($image->getCore(), 0, 0, $background->getInt());

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
        return new \Ttc\Freebies\Intervention\Image\Gd\Color($value);
    }

    /**
     * Checks if core module installation is available
     *
     * @return boolean
     */
    protected function coreAvailable()
    {
        return (extension_loaded('gd') && function_exists('gd_info'));
    }

    /**
     * Returns clone of given core
     *
     * @return mixed
     */
    public function cloneCore($core)
    {
        $width = imagesx($core);
        $height = imagesy($core);
        $clone = imagecreatetruecolor($width, $height);
        imagealphablending($clone, false);
        imagesavealpha($clone, true);
        $transparency = imagecolorallocatealpha($clone, 0, 0, 0, 127);
        imagefill($clone, 0, 0, $transparency);
        
        imagecopy($clone, $core, 0, 0, 0, 0, $width, $height);

        return $clone;
    }
}
