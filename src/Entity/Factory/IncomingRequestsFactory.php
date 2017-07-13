<?php


namespace Polidog\Chatwork\Entity\Factory;


use Cake\Utility\Inflector;
use Polidog\Chatwork\Entity\IncomingRequest;

class IncomingRequestsFactory extends AbstractFactory
{
    /**
     * @param array $data
     * @return IncomingRequest
     */
    public function entity(array $data = [])
    {
        $incomingRequest = new IncomingRequest();
        foreach ($data as $key => $value) {
            $property = Inflector::variable($key);
            $incomingRequest->$property = $value;
        }

        return $incomingRequest;
    }
}
