<?php

namespace Intervention\Image\Drivers\Gd\Modifiers;

use Intervention\Image\Geometry\Resizer;
use Intervention\Image\Interfaces\FrameInterface;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\ModifierInterface;
use Intervention\Image\Interfaces\SizeInterface;
use Intervention\Image\Traits\CanResizeGeometrically;

class ResizeModifier implements ModifierInterface
{
    public function __construct(protected ?int $width = null, protected ?int $height = null)
    {
        //
    }

    public function apply(ImageInterface $image): ImageInterface
    {
        $resizeTo = $this->getAdjustedSize($image);

        foreach ($image as $frame) {
            $this->resizeFrame($frame, $resizeTo);
        }

        return $image;
    }

    protected function getAdjustedSize(ImageInterface $image): SizeInterface
    {
        return $image->getSize()->resize($this->width, $this->height);
    }

    protected function resizeFrame(FrameInterface $frame, SizeInterface $resizeTo): void
    {
        // create new image
        $modified = imagecreatetruecolor(
            $resizeTo->getWidth(),
            $resizeTo->getHeight()
        );

        // get current image
        $current = $frame->getCore();

        // preserve transparency
        $transIndex = imagecolortransparent($current);

        if ($transIndex != -1) {
            $rgba = imagecolorsforindex($modified, $transIndex);
            $transColor = imagecolorallocatealpha($modified, $rgba['red'], $rgba['green'], $rgba['blue'], 127);
            imagefill($modified, 0, 0, $transColor);
            imagecolortransparent($modified, $transColor);
        } else {
            imagealphablending($modified, false);
            imagesavealpha($modified, true);
        }

        // copy content from resource
        imagecopyresampled(
            $modified,
            $current,
            $resizeTo->getPivot()->getX(),
            $resizeTo->getPivot()->getY(),
            0,
            0,
            $resizeTo->getWidth(),
            $resizeTo->getHeight(),
            $frame->getSize()->getWidth(),
            $frame->getSize()->getHeight()
        );

        imagedestroy($current);

        // set new content as recource
        $frame->setCore($modified);
    }
}
