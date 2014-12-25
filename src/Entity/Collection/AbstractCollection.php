<?php
namespace Polidog\Chatwork\Entity\Collection;

use Polidog\Chatwork\Entity\EntityInterface;
use Polidog\Chatwork\Exception\OutOfBoundsException;

abstract class AbstractCollection implements \IteratorAggregate, \Countable, CollectionInterface 
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
     * {@inheritdoc}
     */
    public function add(EntityInterface $entity)
    {
        $this->entities[] = $entity;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function get($idx)
    {
        if (!array_key_exists($idx, $this->entities)) {
            throw new OutOfBoundsException('index not found, index:'.$idx);
        }
        return $this->entities[$idx];
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