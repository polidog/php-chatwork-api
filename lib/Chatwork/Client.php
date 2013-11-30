<?php
namespace Chatwork;

use Buzz\Client\Curl;
use Buzz\Client\ClientInterface;

use Chatwork\HttpClient\HttpClientInterface;
use Chatwork\HttpClient\HttpClient;

use Chatwork\Exception\InvalidArgumentException;

/**
 * Class Client
 *
 * @package Chatwork
 *
 * @property HttpClientInterface $httpClient
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

    public function __construct(HttpClientInterface $httpClient = null)
    {
        if (!is_null($httpClient)) {
            $this->httpClient = $httpClient;
        }
    }

    /**
     * APIオブジェクトを取得する
     * @param $name 呼び出す機能名
     * @return Api\Contacts|Api\Me|Api\My|Api\Rooms
     * @throws \InvalidArgumentException
     */
    public function api($name)
    {
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

    /**
     * 認証処理を行う
     * @param $apiKey
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function authenticate($apiKey)
    {
        if (is_null($apiKey)) {
            throw new \InvalidArgumentException('You need to specify authentication method!');
        }
        $this->getHttpClient()->authenticate($apiKey);
        return $this;
    }

    /**
     * HTTPクライアントを取得する
     * @return HttpClient\HttpClient
     */
    public function getHttpClient()
    {
        if (is_null($this->httpClient)) {
            $this->httpClient = new HttpClient($this->options);
        }
        return $this->httpClient;
    }

    /**
     * HTTPクライアントオブジェクトをセットする
     * @param HttpClientInterface $httpClient
     */
    public function setHttpClient(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * オプションを取得する
     * @param $key
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function getOption($key)
    {
        if (is_null($key)) {
            throw new InvalidArgumentException('Undefined option called: null');
        }

        if (!isset($this->options[$key])) {
            throw new InvalidArgumentException(sprintf('Undefined option called: "%s"', $key));
        }
        return $this->options[$key];
    }

    /**
     * オプションをセットする
     * @param $key
     * @param $value
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setOption($key, $value)
    {
        if (!isset($this->options[$key])) {
            throw new InvalidArgumentException(sprintf('Undefined option called: "%s"', $key));
        }
        $this->options[$key] = $value;
        return $this;
    }


}