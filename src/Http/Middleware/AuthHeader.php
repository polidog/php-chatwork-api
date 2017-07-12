<?php

namespace Polidog\Chatwork\Http\Middleware;

use Psr\Http\Message\RequestInterface;

class AuthHeader
{
    private $chatworkToken;

    /**
     * @param $chatworkToken
     */
    public function __construct($chatworkToken)
    {
        $this->chatworkToken = $chatworkToken;
    }

    public function __invoke(RequestInterface $request, array $options)
    {
        $request->withHeader('X-ChatWorkToken', $this->chatworkToken);
    }
}
