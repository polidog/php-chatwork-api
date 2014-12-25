<?php
namespace Polidog\Chatwork\Entity\Factory;

use Polidog\Chatwork\Entity\Collection\EntityCollection;

abstract class AbstractFactory implements FactoryInterface 
{
    protected $collectionName = EntityCollection::class;
    
    /**
     * @param array $listUp
     * @return EntityCollection
     */
    public function collection(array $listUp)
    {
        $collection = new $this->collectionName();
        foreach ($listUp as $value) {
            $collection->add($this->entity($value));
        }
        return $collection;
    }    
}