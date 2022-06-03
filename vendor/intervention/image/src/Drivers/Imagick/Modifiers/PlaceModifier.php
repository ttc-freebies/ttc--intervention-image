<?php

namespace Intervention\Image\Drivers\Imagick\Modifiers;

use Imagick;
use Intervention\Image\Drivers\Imagick\Image;
use Intervention\Image\Geometry\Point;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\ModifierInterface;
use Intervention\Image\Traits\CanResolveDriverClass;

class PlaceModifier implements ModifierInterface
{
    use CanResolveDriverClass;

    public function __construct(
        protected $element,
        protected string $position,
        protected int $offset_x,
        protected int $offset_y
    ) {
        //
    }

    public function apply(ImageInterface $image): ImageInterface
    {
        $watermark = $this->decodeWatermark();
        $position = $this->getPosition($image, $watermark);

        foreach ($image as $frame) {
            $frame->getCore()->compositeImage(
                $watermark->getFrame()->getCore(),
                Imagick::COMPOSITE_DEFAULT,
                $position->getX(),
                $position->getY()
            );
        }

        return $image;
    }

    protected function decodeWatermark(): Image
    {
        return $this->resolveDriverClass('InputHandler')->handle($this->element);
    }

    protected function getPosition(Image $image, Image $watermark): Point
    {
        $image_size = $image->getSize()->alignPivot($this->position, $this->offset_x, $this->offset_y);
        $watermark_size = $watermark->getSize()->alignPivot($this->position);

        return $image_size->getRelativePositionTo($watermark_size);
    }
}
