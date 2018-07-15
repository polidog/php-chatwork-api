<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Entity\Factory;

use Cake\Utility\Inflector;
use Polidog\Chatwork\Entity\User;

class UserFactory extends AbstractFactory
{
    /**
     * @param array $data
     *
     * @return User
     */
    public function entity(array $data = [])
    {
        $user = new User();
        foreach ($data as $key => $value) {
            $property = Inflector::variable($key);
            $user->$property = $value;
        }

        return $user;
    }
}
