<?php
namespace Chatwork\HttpClient;


use Buzz\Client\ClientInterface;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use Buzz\Listener\ListenerInterface;
use Buzz\Listener\BasicAuthListener;

use Buzz\Client\Curl;

use Chatwork\HttpClient\Message\Request;
use Chatwork\HttpClient\Message\Response;

use Chatwork\HttpClient\Listener\TokenAuthListener;

use Chatwork\Exception\OutOfBoundsException;

/**
 * Chatwork HTTP Request
 */
class HttpClient implements HttpClientInterface
{

    protected $options = [
        'timeout' => 10,
    ];

    protected $client;
    protected $listeners;
    protected $lastResponse;
    protected $lastRequest;
    protected $headers = [];

    /**
     * コンストラクタ
     * @param array $options
     * @param ClientInterface $client
     */
    public function __construct(array $options = [], ClientInterface $client = null)
    {

        $this->options = array_merge($this->options, $options);

        $client = $client ? : new Curl();
        $client->setTimeout($this->options['timeout']);
        $client->setVerifyPeer(false);

        $this->client = $client;
    }

    /**
     * ヘッダーをセットする
     * @param $headers
     *
     * @return $this
     */
    public function setHeaders($headers)
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    /**
     * ヘッダーをクリアする
     * @return $this
     */
    public function clearHeaders()
    {
        $this->headers = [];
        return $this;
    }

    /**
     * GETリクエストを送る
     * @param $path
     * @param array $parameters
     * @param array $headers
     *
     * @return \Chatwork\HttpClient\Message\Response
     */
    public function get($path, array $parameters = [], array $headers = [])
    {
        if (!empty($parameters)) {
            $path .= (false === strpos($path, '?') ? '?' : '&').http_build_query($parameters, '', '&');
        }
        return $this->request($path, $parameters, 'GET', $headers);
    }

    /**
     * POSTリクエストを送る
     * @param $path
     * @param array $parameters
     * @param array $headers
     *
     * @return Response
     */
    public function post($path, array $parameters = [], array $headers = [])
    {
        return $this->request($path, $parameters, 'POST', $headers);
    }

    /**
     * PUTリクエストを送る
     * @param $path
     * @param array $parameters
     * @param array $headers
     *
     * @return Response
     */
    public function put($path, array $parameters = [], array $headers = [])
    {
        return $this->request($path, $parameters, 'PUT', $headers);
    }

    /**
     * DELETEリクエストを送る
     * @param $path
     * @param array $parameters
     * @param array $headers
     *
     * @return Response
     */
    public function delete($path, array $parameters = [], array $headers = [])
    {
        return $this->request($path, $parameters, 'DELETE', $headers);
    }

    /**
     * HTTPリクエストを送る
     * @param $path
     * @param array $parameters
     * @param string $httpMethod
     * @param array $headers
     *
     * @return Response
     * @throws \Exception
     * @throws \Chatwork\Exception\OutOfBoundsException
     */
    public function request($path, array $parameters = [], $httpMethod = 'GET', array $headers = [])
    {

        if (empty($this->options['base_url'])) {
            throw new OutOfBoundsException('option parameter base_url not found');
        }

        $path = trim($this->options['base_url'] . $path, '/');
        $request = $this->createRequest($httpMethod, $path);
        $request->addHeaders($headers);
        if (count($parameters) > 0) {
            $request->setContent(json_encode($parameters, JSON_FORCE_OBJECT));
        }

        $this->executeListeners('preSend', $request);

        $response = $this->createResponse();
        $this->client->send($request, $response);

        $this->lastRequest  = $request;
        $this->lastResponse = $response;

        $this->executeListeners('postSend', $request, $response);
        return $response;
    }

    /**
     * オプションをセットする
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function setOption($name, $value)
    {
        $this->options[$name] = $value;
        return $this;
    }

    /**
     * 認証用のリスナーをセットする
     * @param $apiKey
     */
    public function authenticate($apiKey)
    {
        $this->addListener(new TokenAuthListener($apiKey));
    }

    /**
     * リスナーをセットする
     * @param ListenerInterface $listener
     */
    public function addListener(ListenerInterface $listener)
    {
        $this->listeners[get_class($listener)] = $listener;
    }

    /**
     * 最後のリクエスト情報を取得する
     * @return mixed
     */
    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    /**
     * 最後のレスポンス情報を取得する
     * @return mixed
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }


    /**
     * @param string $httpMethod
     * @param string $url
     * @return \Chatwork\HttpClient\Message\Request
     */
    protected function createRequest($httpMethod, $url)
    {
        $request = new Request($httpMethod);
        $request->setHeaders($this->headers);
        $request->fromUrl($url);
        return $request;
    }

    /**
     * @return \Chatwork\HttpClient\Message\Response
     */
    protected function createResponse()
    {
        return new Response();
    }

    protected function hasListeners()
    {
        return (0 < count($this->listeners));
    }

    protected function executeListeners($method)
    {
        $args = func_get_args();
        array_shift($args);
        if ($this->hasListeners()) {
            foreach ($this->listeners as $listener) {
                call_user_func_array(array($listener, $method), $args);
            }
        }
    }

}