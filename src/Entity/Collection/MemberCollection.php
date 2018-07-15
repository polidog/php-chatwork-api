<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Entity\Collection;

use Polidog\Chatwork\Entity\EntityInterface;
use Polidog\Chatwork\Entity\Member;

class MemberCollection extends EntityCollection
{
    public function add(EntityInterface $entity)
    {
        assert($entity instanceof Member);

        return parent::add($entity);
    }

    /**
     * @return array
     */
    public function getAdminIds()
    {
        return $this->_getIds('admin');
    }

    /**
     * @return array
     */
    public function getMemberIds()
    {
        return $this->_getIds('member');
    }

    /**
     * @return array
     */
    public function getReadonlyIds()
    {
        return $this->_getIds('readonly');
    }

    /**
     * @param string $type
     *
     * @return array
     */
    private function _getIds($type)
    {
        $ids = [];
        foreach ($this->entities as $entity) {
            if ($entity->role == $type) {
                $ids[] = $entity->account->accountId;
            }
        }

        return $ids;
    }
}
