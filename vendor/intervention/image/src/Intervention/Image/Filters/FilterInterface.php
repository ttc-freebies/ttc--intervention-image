<?php

namespace Ttc\Freebies\Intervention\Image\Filters;

use Ttc\Freebies\Intervention\Image\Image;

interface FilterInterface
{
    /**
     * Applies filter to given image
     *
     * @param \Ttc\Freebies\Intervention\Image\Image $image
     * @return \Ttc\Freebies\Intervention\Image\Image
     */
    public function applyFilter(\Ttc\Freebies\Intervention\Image\Image $image);
}
