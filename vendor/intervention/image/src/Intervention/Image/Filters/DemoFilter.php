<?php

namespace Ttc\Intervention\Image\Filters;

use Ttc\Intervention\Image\Image;

class DemoFilter implements \Ttc\Intervention\Image\Filters\FilterInterface
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
     * @param  \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    public function applyFilter(\Ttc\Intervention\Image\Image $image)
    {
        $image->pixelate($this->size);
        $image->greyscale();

        return $image;
    }
}