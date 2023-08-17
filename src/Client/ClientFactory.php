<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Client;

use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;

final class ClientFactory
{
    /**
     * HttpOptions.
     *
     * @var array
     */
    private static $httpOptions = [
        'base_uri' => 'https://api.chatwork.com/',
        'defaults' => [
            'timeout' => 60,
            'debug' => false,
        ],
        'headers' => [
            'User-Agent' => 'php-chatwork-api v2',
            'Accept' => 'application/json',
        ],
    ];

    public static function createHttpClient(string $chatworkToken, array $middlewares = []): \GuzzleHttp\Client
    {
        $stack = new HandlerStack();
        $stack->setHandler(new CurlHandler());
        $stack->push(Middleware::mapRequest(static fn (RequestInterface $request) => $request->withHeader('X-ChatWorkToken', $chatworkToken)));
        foreach ($middlewares as $middleware) {
            $stack->push($middleware);
        }

        $options = array_merge(self::$httpOptions, ['handler' => $stack]);
        return new \GuzzleHttp\Client($options);
    }
}
