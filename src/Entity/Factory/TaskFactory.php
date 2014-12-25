<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 14/12/24
 * Time: 19:05
 */

namespace Polidog\Chatwork\Entity\Factory;

use Cake\Utility\Inflector;
use Polidog\Chatwork\Entity\EntityInterface;
use Polidog\Chatwork\Entity\Task;

class TaskFactory extends AbstractFactory
{
    /**
     * @param array $data
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
            if ($property == 'room') {
                $task->$property = $roomFactory->entity($value); 
            } else if ($property == 'assignedByAccount' || $property == 'account') {
                $task->$property = $userFactory->entity($value);
            } else {
                $task->$property = $value;
            }
        }
        
        return $task;
    }

}