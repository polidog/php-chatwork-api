<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Entity\Collection;

use Polidog\Chatwork\Entity\EntityInterface;
use Polidog\Chatwork\Exception\OutOfBoundsException;

interface CollectionInterface
{
    /**
     * @param EntityInterface $entity
     *
     * @return mixed
     */
    public function add(EntityInterface $entity);

    /**
     * @param $idx
     *
     * @return EntityInterface
     *
     * @throws OutOfBoundsException
     */
    public function get($idx);
}
