<?php
namespace Polidog\Chatwork\Entity\Factory;


use Polidog\Chatwork\Collection\CollectionInterface;
use Polidog\Chatwork\Entity\EntityInterface;

interface FactoryInterface 
{
    /**
     * @param array $data
     * @return EntityInterface
     */
    public function entity(array $data = []);

    /**
     * @param array $listUp
     * @return CollectionInterface
     */
    public function collection(array $listUp);
        
}