<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 14/12/24
 * Time: 19:05.
 */

namespace Polidog\Chatwork\Entity\Factory;

use Cake\Utility\Inflector;
use Polidog\Chatwork\Entity\Task;

class TaskFactory extends AbstractFactory
{
    /**
     * @param array $data
     *
     * @return Task
     */
    public function entity(array $data = [])
    {
        // @todo あとでroomオブジェクトの生成方法とかを見直す
        $roomFactory = new RoomFactory();
        $userFactory = new UserFactory();

        $task = new Task();
        foreach ($data as $key => $value) {
            $property = Inflector::variable($key);
            if ('room' == $property) {
                $task->$property = $roomFactory->entity($value);
            } elseif ('assignedByAccount' == $property || 'account' == $property) {
                $task->$property = $userFactory->entity($value);
            } else {
                $task->$property = $value;
            }
        }

        return $task;
    }
}
