<?php

namespace Polidog\Chatwork\Entity\Factory;

use Cake\Utility\Inflector;
use Polidog\Chatwork\Entity\User;

class UserFactory implements FactoryInterface
{
    /**
     * @param array $data
     * @return User
     */
    public function create(array $data = [])
    {
        $user = new User();
        foreach ($data as $key => $value) {
            $property = Inflector::variable($key);
            $user->$property = $value;
        }
        return $user;
    }
}