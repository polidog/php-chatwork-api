<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 14/12/24
 * Time: 0:51.
 */

namespace Polidog\Chatwork;

use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Polidog\Chatwork\Entity\Factory\RoomFactory;
use Polidog\Chatwork\Entity\Factory\UserFactory;
use Polidog\Chatwork\Exception\NoSupportApiException;
use Psr\Http\Message\RequestInterface;

final class Client implements ClientInterface
{
    const API_VERSION = 'v2';

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * HttpOptions.
     *
     * @var array
     */
    private $httpOptions = [
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

    /**
     * @param string                   $chatworkToken
     * @param array                    $httpOptions
     * @param HttpClientInterface|null $httpClient
     */
    public function __construct(
        $chatworkToken,
        array $httpOptions = [],
        HttpClientInterface $httpClient = null
    ) {
        $this->httpOptions = array_merge($this->httpOptions, $httpOptions);
        if ($httpClient === null) {
            if (!isset($this->httpOptions['handler']) || false === $this->httpOptions['handler'] instanceof HandlerStack) {
                $this->httpOptions['handler'] = HandlerStack::create();
                $this->httpOptions['handler']->push(Middleware::mapRequest(function (RequestInterface $request) use ($chatworkToken) {
                    return $request->withHeader('X-ChatWorkToken', $chatworkToken);
                }));
            }
            $httpClient = new \GuzzleHttp\Client($this->httpOptions);
        }

        $this->httpClient = $httpClient;
    }

    /**
     * @param string $name
     *
     * @return Api\Me|Api\My|Api\Contacts|Api\Rooms
     *
     * @throws NoSupportApiException
     */
    public function api($name)
    {
        switch (strtolower($name)) {
            case 'me':
                $api = new Api\Me($this, new UserFactory());
                break;
            case 'my':
                $api = new Api\My($this);
                break;
            case 'contacts':
                $api = new Api\Contacts($this, new UserFactory());
                break;
            case 'rooms':
                $api = new Api\Rooms($this, new RoomFactory());
                break;
            default:
                throw new NoSupportApiException(sprintf('Undefined api instance called: "%s"', $name));
        }

        return $api;
    }

    /**
     * {@inheritdoc}
     */
    public function request($method, $uri, array $options = [])
    {
        // TODO Error Handling.
        $uri = sprintf('/%s/%s', self::API_VERSION, $uri);

        return json_decode($this->httpClient->request($method, $uri, $options)->getBody()->getContents(), true);
    }
}
