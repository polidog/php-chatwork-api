<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Client;

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

    public static function create(string $token, string $version, array $httpOptions = []): ClientInterface
    {
        $httpOptions = array_merge(self::$httpOptions, $httpOptions);

        return new Client(new \GuzzleHttp\Client($httpOptions), $token, $version);
    }
}
