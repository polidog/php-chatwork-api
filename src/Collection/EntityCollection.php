<?php
namespace Polidog\Chatwork\Collection;

use Polidog\Chatwork\Entity\EntityInterface;

/**
 * Class EntityCollection
 * @package Polidog\Chatwork\Collection
 */
class EntityCollection implements \IteratorAggregate, \Countable, CollectionInterface 
{
    protected $entities = array();

    /**
     * @param array $entities
     */
    public function __construct(array $entities = [])
    {
        $this->entities = $entities;
    }

    /**
     * @param EntityInterface $entity
     * @return $this
     */
    public function add(EntityInterface $entity)
    {
        $this->entities[] = $entity;
        return $this;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->entities);
    }
    
    public function count()
    {
        return count($this->entities);
    }
}