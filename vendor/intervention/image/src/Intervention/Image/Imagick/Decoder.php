<?php

namespace Ttc\Freebies\Intervention\Image\Imagick;

use Ttc\Freebies\Intervention\Image\AbstractDecoder;
use Ttc\Freebies\Intervention\Image\Exception\NotReadableException;
use Ttc\Freebies\Intervention\Image\Exception\NotSupportedException;
use Ttc\Freebies\Intervention\Image\Image;

class Decoder extends \Ttc\Freebies\Intervention\Image\AbstractDecoder
{
    /**
     * Initiates new image from path in filesystem
     *
     * @param  string $path
     * @return \Ttc\Freebies\Intervention\Image\Image
     */
    public function initFromPath($path)
    {
        $core = new \Imagick;

        try {

            $core->setBackgroundColor(new \ImagickPixel('transparent'));
            $core->readImage($path);
            $core->setImageType(defined('\Imagick::IMGTYPE_TRUECOLORALPHA') ? \Imagick::IMGTYPE_TRUECOLORALPHA : \Imagick::IMGTYPE_TRUECOLORMATTE);

        } catch (\ImagickException $e) {
            throw new \Ttc\Freebies\Intervention\Image\Exception\NotReadableException(
                "Unable to read image from path ({$path}).",
                0,
                $e
            );
        }

        // build image
        $image = $this->initFromImagick($core);
        $image->setFileInfoFromPath($path);

        return $image;
    }

    /**
     * Initiates new image from GD resource
     *
     * @param  Resource $resource
     * @return \Ttc\Freebies\Intervention\Image\Image
     */
    public function initFromGdResource($resource)
    {
        throw new \Ttc\Freebies\Intervention\Image\Exception\NotSupportedException(
            'Imagick driver is unable to init from GD resource.'
        );
    }

    /**
     * Initiates new image from Imagick object
     *
     * @param  Imagick $object
     * @return \Ttc\Freebies\Intervention\Image\Image
     */
    public function initFromImagick(\Imagick $object)
    {
        // currently animations are not supported
        // so all images are turned into static
        $object = $this->removeAnimation($object);

        // reset image orientation
        $object->setImageOrientation(\Imagick::ORIENTATION_UNDEFINED);

        return new \Ttc\Freebies\Intervention\Image\Image(new \Ttc\Freebies\Intervention\Image\Imagick\Driver, $object);
    }

    /**
     * Initiates new image from binary data
     *
     * @param  string $data
     * @return \Ttc\Freebies\Intervention\Image\Image
     */
    public function initFromBinary($binary)
    {
        $core = new \Imagick;

        try {
            $core->setBackgroundColor(new \ImagickPixel('transparent'));

            $core->readImageBlob($binary);

        } catch (\ImagickException $e) {
            throw new \Ttc\Freebies\Intervention\Image\Exception\NotReadableException(
                "Unable to read image from binary data.",
                0,
                $e
            );
        }

        // build image
        $image = $this->initFromImagick($core);
        $image->mime = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $binary);

        return $image;
    }

    /**
     * Turns object into one frame Imagick object
     * by removing all frames except first
     *
     * @param  Imagick $object
     * @return Imagick
     */
    private function removeAnimation(\Imagick $object)
    {
        $imagick = new \Imagick;

        foreach ($object as $frame) {
            $imagick->addImage($frame->getImage());
            break;
        }

        $object->destroy();

        return $imagick;
    }
}
