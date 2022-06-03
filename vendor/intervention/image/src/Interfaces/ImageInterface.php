<?php

namespace Intervention\Image\Interfaces;

use Intervention\Image\Collection;
use Intervention\Image\EncodedImage;
use Intervention\Image\Interfaces\FrameInterface;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\SizeInterface;

interface ImageInterface
{
    public function getIterator(): Collection;
    public function getFrames(): Collection;
    public function getFrame(int $key = 0): ?FrameInterface;
    public function addFrame(FrameInterface $frame): ImageInterface;
    public function setLoops(int $count): ImageInterface;
    public function getLoops(): int;
    public function getSize(): SizeInterface;
    public function isAnimated(): bool;
    public function modify(ModifierInterface $modifier): ImageInterface;
    public function encode(EncoderInterface $encoder): EncodedImage;
    public function toJpeg(int $quality = 75): EncodedImage;
    public function toGif(): EncodedImage;
    public function toPng(): EncodedImage;
    public function pickColors(int $x, int $y): Collection;
    public function pickColor(int $x, int $y, int $frame_key = 0): ?ColorInterface;
    public function greyscale(): ImageInterface;
    public function blur(int $amount = 5): ImageInterface;
    public function rotate(float $angle, $background = 'ffffff'): ImageInterface;
    public function place($element, string $position = 'top-left', int $offset_x = 0, int $offset_y = 0): ImageInterface;
    public function fill($color, ?int $x = null, ?int $y = null): ImageInterface;
    public function pixelate(int $size): ImageInterface;
    public function resize(?int $width = null, ?int $height = null): ImageInterface;
    public function resizeDown(?int $width = null, ?int $height = null): ImageInterface;
    public function scale(?int $width = null, ?int $height = null): ImageInterface;
    public function scaleDown(?int $width = null, ?int $height = null): ImageInterface;
    public function fit(int $width, int $height, string $position = 'center'): ImageInterface;
    public function fitDown(int $width, int $height, string $position = 'center'): ImageInterface;
    public function pad(int $width, int $height, $background = 'ffffff', string $position = 'center'): ImageInterface;
    public function padDown(int $width, int $height, $background = 'ffffff', string $position = 'center'): ImageInterface;
    public function getWidth(): int;
    public function getHeight(): int;
    public function destroy(): void;
}
