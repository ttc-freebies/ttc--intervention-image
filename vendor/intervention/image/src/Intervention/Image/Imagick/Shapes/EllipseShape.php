<?php

namespace Ttc\Freebies\Intervention\Image\Imagick\Shapes;

use Ttc\Freebies\Intervention\Image\AbstractShape;
use Ttc\Freebies\Intervention\Image\Image;
use Ttc\Freebies\Intervention\Image\Imagick\Color;

class EllipseShape extends \Ttc\Freebies\Intervention\Image\AbstractShape
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
    public function applyToImage(\Ttc\Freebies\Intervention\Image\Image $image, $x = 0, $y = 0)
    {
        $circle = new \ImagickDraw;

        // set background
        $bgcolor = new \Ttc\Freebies\Intervention\Image\Imagick\Color($this->background);
        $circle->setFillColor($bgcolor->getPixel());

        // set border
        if ($this->hasBorder()) {
            $border_color = new \Ttc\Freebies\Intervention\Image\Imagick\Color($this->border_color);
            $circle->setStrokeWidth($this->border_width);
            $circle->setStrokeColor($border_color->getPixel());
        }

        $circle->ellipse($x, $y, $this->width / 2, $this->height / 2, 0, 360);

        $image->getCore()->drawImage($circle);

        return true;
    }
}
