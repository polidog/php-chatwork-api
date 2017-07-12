<?php

namespace Polidog\Chatwork\Entity\Factory;

use Cake\Utility\Inflector;
use Polidog\Chatwork\Entity\Room;

class RoomFactory extends AbstractFactory
{
    /**
     * @param array $data
     *
     * @return Room
     */
    public function entity(array $data = [])
    {
        $room = new Room();
        foreach ($data as $key => $value) {
            $property = Inflector::variable($key);
            $room->$property = $value;
        }

        return $room;
    }
}
