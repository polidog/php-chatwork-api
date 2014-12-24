<?php
namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Collection\CollectionInterface;

/**
 * Class Members
 * @package Polidog\Chatwork\Api\Rooms
 */
class Members extends AbstractRoomApi 
{
    /**
     * @return \Polidog\Chatwork\Collection\CollectionInterface
     */
    public function show()
    {
        return $this->factory->collection(
            $this->client->get(
                ['rooms/{roomId}/members',['roomId' => $this->roomId]]
            )->json()
        );
    }

    /**
     * @param CollectionInterface $adminUsers
     * @param CollectionInterface $memberUsers
     * @param CollectionInterface $readonlyUsers
     */
    public function update(
        CollectionInterface $adminUsers, 
        CollectionInterface $memberUsers = null,
        CollectionInterface $readonlyUsers = null
    )
    {
        $options = [
            'body' => [
                'members_admin_ids' => [],
                'members_member_ids' => [],
                'members_readonly_ids' => []
            ]
        ];
        foreach($adminUsers as $user) {
            if (!empty($user->accountId)) {
                $options['body']['members_admin_ids'][] = $user->accountId;    
            }
        }

        foreach($memberUsers as $user) {
            if (!empty($user->accountId)) {
                $options['body']['members_member_ids'][] = $user->accountId;
            }
        }
        
        foreach($readonlyUsers as $user) {
            if (!empty($user->accountId)) {
                $options['body']['members_readonly_ids'][] = $user->accountId;
            }
        }
        
        $this->client->put(['rooms/{roomId}/members',['roomId' => $this->roomId]], $options);
        
    }
}