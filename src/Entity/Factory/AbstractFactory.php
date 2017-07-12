<?php

namespace Polidog\Chatwork\Entity\Factory;

use Polidog\Chatwork\Entity\Collection\EntityCollection;

abstract class AbstractFactory implements FactoryInterface
{
    protected $collectionName = EntityCollection::class;

    /**
     * @param array $listUp
     *
     * @return EntityCollection
     */
    public function collection($listUp = null)
    {
        $collection = new $this->collectionName();
        if (!is_array($listUp)) {
            return $collection;
        }

        foreach ($listUp as $value) {
            $collection->add($this->entity($value));
        }

        return $collection;
    }
}
