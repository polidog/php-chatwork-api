<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Entity\Factory;

use Cake\Utility\Inflector;
use Polidog\Chatwork\Entity\Status;

class StatusFactory extends AbstractFactory
{
    /**
     * @param array $data
     *
     * @return Status
     */
    public function entity(array $data = [])
    {
        $status = new Status();
        foreach ($data as $key => $value) {
            $property = Inflector::variable($key);
            $status->$property = $value;
        }

        return $status;
    }
}
