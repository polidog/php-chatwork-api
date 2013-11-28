<?php
namespace Chatwork;

use Buzz\Client\Curl;
use Buzz\Client\ClientInterface;

use Chatwork\HttpClient\HttpClientInterface;
use Chatwork\HttpClient\HttpClient;

/**
 * Class Client
 *
 * @package Chatwork
 */
class Client
{

    private $options = array(
        'base_url'  => 'https://api.chatwork.com/v1/',
        'user_argent'   => 'php-chatwork-api',
        'timeout'   => 60,
        'api_limit' => 5000,
    );

    private $httpClient;

    public function __construct(HttpClientInterface $httpClient = null) {
        if (!is_null($httpClient)) {
            $this->httpClient = $httpClient;
        }
    }

    public function api($name) {
        switch (strtolower($name)) {
            case 'me':
                $api = new Api\Me($this);
                break;
            case 'my':
                $api = new Api\My($this);
                break;
            case 'contacts':
                $api = new Api\Contacts($this);
                break;
            case 'rooms':
                $api = new Api\Rooms($this);
                break;
            default:
                throw new \InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $name));
        }

        return $api;
    }

    public function authenticate($apiKey) {
        if (is_null($apiKey)) {
            throw new \InvalidArgumentException('You need to specify authentication method!');
        }
        $this->getHttpClient()->authenticate($apiKey);
        return $this;
    }

    /**
     * get http client method
     * @return HttpClient\HttpClient
     */
    public function getHttpClient() {
        if (is_null($this->httpClient)) {
            $this->httpClient = new HttpClient($this->options);
        }
        return $this->httpClient;
    }

    public function setHttpClient(HttpClientInterface $httpClient) {
        $this->httpClient = $httpClient;
    }

    public function clearHeaders() {
        $this->getHttpClient()->clearHeaders();
        return $this;
    }

    public function setHttpHeaders(array $headers) {
        $this->getHttpClient()->setHeaders($headers);
        return $this;
    }

    public function getOption($key) {
        if (is_null($key)) {
            throw new InvalidArgumentException('Undefined option called: null');
        }

        if (!isset($this->options[$key])) {
            throw new InvalidArgumentException(sprintf('Undefined option called: "%s"', $key));
        }
        return $this->options[$key];
    }

    public function setOption($key, $value) {
        if (!isset($this->options[$key])) {
            throw new InvalidArgumentException(sprintf('Undefined option called: "%s"', $key));
        }
        $this->options[$key] = $value;
        return $this;
    }


}