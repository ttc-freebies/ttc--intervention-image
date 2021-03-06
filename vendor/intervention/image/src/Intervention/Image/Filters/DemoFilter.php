<?php

namespace Ttc\Freebies\Intervention\Image\Filters;

use Ttc\Freebies\Intervention\Image\Image;

class DemoFilter implements \Ttc\Freebies\Intervention\Image\Filters\FilterInterface
{
    /**
     * Default size of filter effects
     */
    const DEFAULT_SIZE = 10;

    /**
     * Size of filter effects
     *
     * @var int
     */
    private $size;

    /**
     * Creates new instance of filter
     *
     * @param int $size
     */
    public function __construct($size = null)
    {
        $this->size = is_numeric($size) ? intval($size) : self::DEFAULT_SIZE;
    }

    /**
     * Applies filter effects to given image
     *
     * @param \Ttc\Freebies\Intervention\Image\Image $image
     * @return \Ttc\Freebies\Intervention\Image\Image
     */
    public function applyFilter(\Ttc\Freebies\Intervention\Image\Image $image)
    {
        $image->pixelate($this->size);
        $image->greyscale();

        return $image;
    }
}
