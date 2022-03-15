<?php

namespace Ttc\Intervention\Image\Imagick\Shapes;

use Ttc\Intervention\Image\AbstractShape;
use Ttc\Intervention\Image\Image;
use Ttc\Intervention\Image\Imagick\Color;

class EllipseShape extends \Ttc\Intervention\Image\AbstractShape
{
    /**
     * Width of ellipse in pixels
     *
     * @var int
     */
    public $width = 100;

    /**
     * Height of ellipse in pixels
     *
     * @var int
     */
    public $height = 100;

    /**
     * Create new ellipse instance
     *
     * @param int $width
     * @param int $height
     */
    public function __construct($width = null, $height = null)
    {
        $this->width = is_numeric($width) ? intval($width) : $this->width;
        $this->height = is_numeric($height) ? intval($height) : $this->height;
    }

    /**
     * Draw ellipse instance on given image
     *
     * @param  Image   $image
     * @param  int     $x
     * @param  int     $y
     * @return boolean
     */
    public function applyToImage(\Ttc\Intervention\Image\Image $image, $x = 0, $y = 0)
    {
        $circle = new \ImagickDraw;

        // set background
        $bgcolor = new \Ttc\Intervention\Image\Imagick\Color($this->background);
        $circle->setFillColor($bgcolor->getPixel());

        // set border
        if ($this->hasBorder()) {
            $border_color = new \Ttc\Intervention\Image\Imagick\Color($this->border_color);
            $circle->setStrokeWidth($this->border_width);
            $circle->setStrokeColor($border_color->getPixel());
        }

        $circle->ellipse($x, $y, $this->width / 2, $this->height / 2, 0, 360);

        $image->getCore()->drawImage($circle);

        return true;
    }
}
