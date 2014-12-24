<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 14/12/24
 * Time: 0:51
 */

namespace Polidog\Chatwork;

use GuzzleHttp\ClientInterface as HttpClientInterface;
use Polidog\Chatwork\Exception\NoSupportApiException;
use Polidog\Chatwork\Http\Event\AuthHeaderSubscriber;

final class Client implements ClientInterface 
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * HttpOptions
     * 
     * @var array
     */
    private $httpOptions = [
        'base_url' => ['https://api.chatwork.com/{version}/', ['version' => 'v1']],
        'defaults' => [
            'timeout' => 60,
            'debug' => false,
        ],
        'headers' => [
            'User-Agent' => 'php-chatwork-api v2',
            'Accept'     => 'application/json',
        ]
    ];
    
    /**
     * @param HttpClientInterface $httpClient
     * @param string $apiKey
     */
    public function __construct(
        $apiKey, 
        array $httpOptions = [],
        HttpClientInterface $httpClient = null)
    {
        
        $this->httpOptions = array_merge($this->httpOptions, $httpOptions);
        
        if (is_null($httpClient)) {
            $httpClient = new \GuzzleHttp\Client($this->httpOptions);
        }
        
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient;

        $emitter = $this->httpClient->getEmitter();
        $emitter->attach(new AuthHeaderSubscriber($apiKey));
        
    }

    /**
     * @param string $name
     * 
     * @return Api\Me|Api\My|Api\Contacts|Api\Rooms
     * @throws NoSupportApiException
     */
    public function api($name)
    {
        switch (strtolower($name)) {
            case 'me':
                $api = new Api\Me($this->httpClient);
                break;
            case 'my':
                $api = new Api\My($this->httpClient);
                break;
            case 'contacts':
                $api = new Api\Contacts($this->httpClient);
                break;
            case 'rooms':
                $api = new Api\Rooms($this->httpClient);
                break;
            default:
                throw new NoSupportApiException(sprintf('Undefined api instance called: "%s"', $name));
        }
        return $api;
    }


}