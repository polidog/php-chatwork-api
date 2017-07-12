<?php

namespace Polidog\Chatwork\Http\Event;

use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Message\RequestInterface;
use Phake;

class AuthHeaderSubscriberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function イベントはbeforeイベントのみ対応していてonBeforeメソッドが実行される()
    {
        $expect = [
            'before' => ['onBefore'],
        ];

        $subscriber = new AuthHeaderSubscriber('abc');
        $actual = $subscriber->getEvents();

        $this->assertEquals($expect, $actual);
    }

    /**
     * @test
     */
    public function ヘッダーをセットすることができる()
    {
        $event = Phake::mock(BeforeEvent::class);
        $request = Phake::mock(RequestInterface::class);

        Phake::when($event)->getRequest()
            ->thenReturn($request);

        $subscriber = new AuthHeaderSubscriber('token-string');
        $subscriber->onBefore($event, 'test');

        Phake::verify($event, Phake::times(1))
            ->getRequest();

        Phake::verify($request, Phake::times(1))
            ->setHeader('X-ChatWorkToken', 'token-string');
    }
}
