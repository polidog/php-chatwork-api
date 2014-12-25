<?php
namespace Polidog\Chatwork\Entity\Factory;


use Cake\Utility\Inflector;
use Polidog\Chatwork\Entity\EntityInterface;
use Polidog\Chatwork\Entity\Message;

class MessageFactory extends AbstractFactory 
{
    /**
     * @param array $data
     * @return Message
     */
    public function entity(array $data = [])
    {
        // @todo ここでnewするのなんとかしたい・・・
        $userFactory = new UserFactory();
        $message = new Message();
        
        $message->account = $userFactory->entity($data['account']);
        unset($data['account']);
        
        foreach ($data as $key => $value) {
            $property = Inflector::variable($key);
            $message->$property = $value;
        }
        return $message;
    }

}