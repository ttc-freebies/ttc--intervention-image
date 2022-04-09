<?php

namespace Ttc\Freebies\Intervention\Image\Imagick\Shapes;

use Ttc\Freebies\Intervention\Image\AbstractShape;
use Ttc\Freebies\Intervention\Image\Image;
use Ttc\Freebies\Intervention\Image\Imagick\Color;

class PolygonShape extends \Ttc\Freebies\Intervention\Image\AbstractShape
{
    /**
     * Array of points of polygon
     *
     * @var array
     */
    public $points;

    /**
     * Create new polygon instance
     *
     * @param array $points
     */
    public function __construct($points)
    {
        $this->points = $this->formatPoints($points);
    }

    /**
     * Draw polygon on given image
     *
     * @param  Image   $image
     * @param  int     $x
     * @param  int     $y
     * @return boolean
     */
    public function applyToImage(\Ttc\Freebies\Intervention\Image\Image $image, $x = 0, $y = 0)
    {
        $polygon = new \ImagickDraw;

        // set background
        $bgcolor = new \Ttc\Freebies\Intervention\Image\Imagick\Color($this->background);
        $polygon->setFillColor($bgcolor->getPixel());

        // set border
        if ($this->hasBorder()) {
            $border_color = new \Ttc\Freebies\Intervention\Image\Imagick\Color($this->border_color);
            $polygon->setStrokeWidth($this->border_width);
            $polygon->setStrokeColor($border_color->getPixel());
        }

        $polygon->polygon($this->points);

        $image->getCore()->drawImage($polygon);

        return true;
    }

    /**
     * Format polygon points to Imagick format
     *
     * @param  Array $points
     * @return Array
     */
    private function formatPoints($points)
    {
        $ipoints = [];
        $count = 1;

        foreach ($points as $key => $value) {
            if ($count%2 === 0) {
                $y = $value;
                $ipoints[] = ['x' => $x, 'y' => $y];
            } else {
                $x = $value;
            }
            $count++;
        }

        return $ipoints;
    }
}
