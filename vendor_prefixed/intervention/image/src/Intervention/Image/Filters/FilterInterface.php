<?php

namespace Ttc\Intervention\Image\Filters;

use Ttc\Intervention\Image\Image;

interface FilterInterface
{
    /**
     * Applies filter to given image
     *
     * @param  \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    public function applyFilter(\Ttc\Intervention\Image\Image $image);
}
