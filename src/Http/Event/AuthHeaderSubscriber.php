<?php

namespace Polidog\Chatwork\Http\Event;

use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Event\SubscriberInterface;

/**
 * Auth用のヘッダーを送る
 * @package Polidog\Chatwork\Http
 */
class AuthHeaderSubscriber implements SubscriberInterface
{
    private $token;

    public function __construct($token = null)
    {
        $this->token = $token;
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return [
            'before' => ['onBefore']
        ];
    }

    public function onBefore(BeforeEvent $event, $name)
    {
        $event->getRequest()->setHeader('X-ChatWorkToken', $this->token);
    }
}