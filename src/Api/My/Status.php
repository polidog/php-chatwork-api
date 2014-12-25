<?php
namespace Polidog\Chatwork\Api\My;

use Polidog\Chatwork\Api\AbstractApi;

class Status extends AbstractApi
{
    public function show()
    {
        return $this->factory->entity(
            $this->client->get('my/status')    
        );
    }
}