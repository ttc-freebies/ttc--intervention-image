<?php

namespace Intervention\Image\Drivers\Imagick\Modifiers;

use Intervention\Image\Geometry\Size;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\SizeInterface;

class PadDownModifier extends PadModifier
{
    protected function getCropSize(ImageInterface $image): SizeInterface
    {
        $resize = $this->getResizeSize($image);

        return $image->getSize()
            ->contain($resize->getWidth(), $resize->getHeight())
            ->alignPivotTo($resize, $this->position);
    }

    protected function getResizeSize(ImageInterface $image): SizeInterface
    {
        return (new Size($this->width, $this->height))
                ->resizeDown($image->getWidth(), $image->getHeight());
    }
}
