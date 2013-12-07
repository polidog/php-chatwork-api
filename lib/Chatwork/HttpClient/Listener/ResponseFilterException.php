<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2013/12/07
 * Time: 15:18
 */

namespace Chatwork\HttpClient\Listener;
use Buzz\Listener\ListenerInterface;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use Chatwork\Exception\InvalidApiException;
use Chatwork\Exception\InvalidApiTokenException;

class ResponseFilterException implements ListenerInterface
{

    public function preSend(RequestInterface $request)
    {
    }

    public function postSend(RequestInterface $request, MessageInterface $response)
    {
        $content = $response->getContent();
        if (isset($content["errors"])) {
            throw new InvalidApiException();
        }
    }
} 