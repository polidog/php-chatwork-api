<?php
namespace Polidog\Chatwork\Entity\Factory;


use Polidog\Chatwork\Entity\Collection\CollectionInterface;
use Polidog\Chatwork\Entity\EntityInterface;

interface FactoryInterface 
{
    /**
     * @param array $data
     * @return EntityInterface
     */
    public function entity(array $data = []);

    /**
     * @param array|null $listUp
     * @return CollectionInterface
     */
    public function collection($listUp);
        
}