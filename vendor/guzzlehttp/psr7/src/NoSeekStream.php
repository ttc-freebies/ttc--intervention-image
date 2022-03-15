<?php

declare(strict_types=1);

namespace Ttc\GuzzleHttp\Psr7;

use Ttc\Psr\Http\Message\StreamInterface;

/**
 * Stream decorator that prevents a stream from being seeked.
 */
final class NoSeekStream implements \Ttc\Psr\Http\Message\StreamInterface
{
    use \Ttc\GuzzleHttp\Psr7\StreamDecoratorTrait;

    public function seek($offset, $whence = SEEK_SET): void
    {
        throw new \RuntimeException('Cannot seek a NoSeekStream');
    }

    public function isSeekable(): bool
    {
        return false;
    }
}
