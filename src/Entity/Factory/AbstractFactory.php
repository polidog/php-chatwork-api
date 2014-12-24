<?php
namespace Polidog\Chatwork\Entity\Factory;

use Polidog\Chatwork\Collection\EntityCollection;

abstract class AbstractFactory implements FactoryInterface 
{
    /**
     * @param array $listUp
     * @return EntityCollection
     */
    public function collection(array $listUp)
    {
        $collection = new EntityCollection();
        foreach ($listUp as $value) {
            $collection->add($this->entity($value));
        }
        return $collection;
    }    
}