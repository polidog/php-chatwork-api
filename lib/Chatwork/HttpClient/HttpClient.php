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

/**
 * Chatwork HTTP Request
 */
class HttpClient implements HttpClientInterface
{

    protected $options = array(
        'timeout' => 10,
    );

    protected $client;
    protected $listeners;
    protected $lastResponse;
    protected $lastRequest;
    protected $headers = array();

    public function __construct($options = array(), ClientInterface $client = null)
    {

        $this->options = array_merge($this->options, $options);

        $client = $client ? : new Curl();
        $client->setTimeout($this->options['timeout']);
        $client->setVerifyPeer(false);

        $this->client = $client;
    }

    public function setHeaders($headers)
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    public function clearHeaders()
    {
        $this->headers = array();
    }

    public function get($path, array $parameters = array(), array $headers = array())
    {
        if (!empty($parameters)) {
            $path .= (false === strpos($path, '?') ? '?' : '&').http_build_query($parameters, '', '&');
        }
        return $this->request($path, $parameters, 'GET', $headers);
    }

    public function post($path, array $parameters = array(), array $headers = array())
    {
        return $this->request($path, $parameters, 'POST', $headers);
    }

    public function put($path, array $parameters = array(), array $headers = array())
    {
        return $this->request($path, $parameters, 'PUT', $headers);
    }

    public function delete($path, array $parameters = array(), array $headers = array())
    {
        return $this->request($path, $parameters, 'DELETE', $headers);
    }

    public function request($path, array $parameters = array(), $httpMethod = 'GET', array $headers = array())
    {
        $path = trim($this->options['base_url'] . $path, '/');
        $request = $this->createRequest($httpMethod, $path);
        $request->addHeaders($headers);
        if (count($parameters) > 0) {
            $request->setContent(json_encode($parameters, JSON_FORCE_OBJECT));
        }

        $this->executeListeners('preSend', $request);

        $response = $this->createResponse();
        try {
            $this->client->send($request, $response);
        } catch (\LogicException $e) {
            throw $e;
        } catch (\RuntimeException $e) {
            throw $e;
        }

        $this->lastRequest  = $request;
        $this->lastResponse = $response;

        $this->executeListeners('postSend', $request, $response);
        return $response;
    }

    public function setOption($name, $value)
    {
        $this->options[$name] = $value;
        return $this;
    }

    public function authenticate($apiKey)
    {
        $this->addListener(new TokenAuthListener($apiKey));
    }


    public function addListener(ListenerInterface $listener)
    {
        $this->listeners[get_class($listener)] = $listener;
    }

    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    public function getLastResponse()
    {
        return $this->lastResponse;
    }


    /**
     * @param string $httpMethod
     * @param string $url
     * @return \Bitbucket\HttpClient\Message\Request
     */
    protected function createRequest($httpMethod, $url)
    {
        $request = new Request($httpMethod);
        $request->setHeaders($this->headers);
        $request->fromUrl($url);
        return $request;
    }

    /**
     * @return \Bitbucket\HttpClient\Message\Response
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