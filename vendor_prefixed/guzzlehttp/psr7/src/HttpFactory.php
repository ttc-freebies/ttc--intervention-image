<?php

declare(strict_types=1);

namespace Ttc\GuzzleHttp\Psr7;

use Ttc\Psr\Http\Message\RequestFactoryInterface;
use Ttc\Psr\Http\Message\RequestInterface;
use Ttc\Psr\Http\Message\ResponseFactoryInterface;
use Ttc\Psr\Http\Message\ResponseInterface;
use Ttc\Psr\Http\Message\ServerRequestFactoryInterface;
use Ttc\Psr\Http\Message\ServerRequestInterface;
use Ttc\Psr\Http\Message\StreamFactoryInterface;
use Ttc\Psr\Http\Message\StreamInterface;
use Ttc\Psr\Http\Message\UploadedFileFactoryInterface;
use Ttc\Psr\Http\Message\UploadedFileInterface;
use Ttc\Psr\Http\Message\UriFactoryInterface;
use Ttc\Psr\Http\Message\UriInterface;

/**
 * Implements all of the PSR-17 interfaces.
 *
 * Note: in consuming code it is recommended to require the implemented interfaces
 * and inject the instance of this class multiple times.
 */
final class HttpFactory implements
    \Ttc\Psr\Http\Message\RequestFactoryInterface,
    \Ttc\Psr\Http\Message\ResponseFactoryInterface,
    \Ttc\Psr\Http\Message\ServerRequestFactoryInterface,
    \Ttc\Psr\Http\Message\StreamFactoryInterface,
    \Ttc\Psr\Http\Message\UploadedFileFactoryInterface,
    \Ttc\Psr\Http\Message\UriFactoryInterface
{
    public function createUploadedFile(
        \Ttc\Psr\Http\Message\StreamInterface $stream,
        int $size = null,
        int $error = \UPLOAD_ERR_OK,
        string $clientFilename = null,
        string $clientMediaType = null
    ): \Ttc\Psr\Http\Message\UploadedFileInterface {
        if ($size === null) {
            $size = $stream->getSize();
        }

        return new \Ttc\GuzzleHttp\Psr7\UploadedFile($stream, $size, $error, $clientFilename, $clientMediaType);
    }

    public function createStream(string $content = ''): \Ttc\Psr\Http\Message\StreamInterface
    {
        return \Ttc\GuzzleHttp\Psr7\Utils::streamFor($content);
    }

    public function createStreamFromFile(string $file, string $mode = 'r'): \Ttc\Psr\Http\Message\StreamInterface
    {
        try {
            $resource = \Ttc\GuzzleHttp\Psr7\Utils::tryFopen($file, $mode);
        } catch (\RuntimeException $e) {
            if ('' === $mode || false === \in_array($mode[0], ['r', 'w', 'a', 'x', 'c'], true)) {
                throw new \InvalidArgumentException(sprintf('Invalid file opening mode "%s"', $mode), 0, $e);
            }

            throw $e;
        }

        return \Ttc\GuzzleHttp\Psr7\Utils::streamFor($resource);
    }

    public function createStreamFromResource($resource): \Ttc\Psr\Http\Message\StreamInterface
    {
        return \Ttc\GuzzleHttp\Psr7\Utils::streamFor($resource);
    }

    public function createServerRequest(string $method, $uri, array $serverParams = []): \Ttc\Psr\Http\Message\ServerRequestInterface
    {
        if (empty($method)) {
            if (!empty($serverParams['REQUEST_METHOD'])) {
                $method = $serverParams['REQUEST_METHOD'];
            } else {
                throw new \InvalidArgumentException('Cannot determine HTTP method');
            }
        }

        return new \Ttc\GuzzleHttp\Psr7\ServerRequest($method, $uri, [], null, '1.1', $serverParams);
    }

    public function createResponse(int $code = 200, string $reasonPhrase = ''): \Ttc\Psr\Http\Message\ResponseInterface
    {
        return new \Ttc\GuzzleHttp\Psr7\Response($code, [], null, '1.1', $reasonPhrase);
    }

    public function createRequest(string $method, $uri): \Ttc\Psr\Http\Message\RequestInterface
    {
        return new \Ttc\GuzzleHttp\Psr7\Request($method, $uri);
    }

    public function createUri(string $uri = ''): \Ttc\Psr\Http\Message\UriInterface
    {
        return new \Ttc\GuzzleHttp\Psr7\Uri($uri);
    }
}
