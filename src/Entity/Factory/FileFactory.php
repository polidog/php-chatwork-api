<?php
namespace Polidog\Chatwork\Entity\Factory;

use Cake\Utility\Inflector;
use Polidog\Chatwork\Entity\EntityInterface;
use Polidog\Chatwork\Entity\File;

class FileFactory  extends AbstractFactory
{

    /**
     * @param array $data
     * @return File
     */
    public function entity(array $data = [])
    {
        $userFactory = new UserFactory();
        $file = new File();
        $file->account = $userFactory->entity($data['account']);
        unset($data['account']);
        
        foreach ($data as $key => $value) {
            $property = Inflector::variable($key);
            $file->$property = $value;
        }
        return $file;
    }

}