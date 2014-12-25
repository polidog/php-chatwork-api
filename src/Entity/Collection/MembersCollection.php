<?php
namespace Polidog\Chatwork\Entity\Collection;

class MembersCollection extends EntityCollection  
{
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
     * @return array
     */
    private function _getIds($type)
    {
        $ids = [];
        foreach ($this->entities as $entity) {
            if($entity->role == $type) {
                $ids[] = $entity->account->accountId;
            }
        }
        return $ids;
    }
}