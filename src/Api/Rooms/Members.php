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
     * @param CollectionInterface $users
     */
    public function update(CollectionInterface $members)
    {
        $options = [
            'body' => [
                'members_admin_ids' => [],
                'members_member_ids' => [],
                'members_readonly_ids' => []
            ]
        ];
        
        foreach ($members as $member) {
            if ($member->role == 'admin') {
                $options['body']['members_admin_ids'][] = $member->user->accountId;
            }
            if ($member->role == 'member') {
                $options['body']['members_member_ids'][] = $member->user->accountId;
            }
            if ($member->role == 'readonly') {
                $options['body']['members_readonly_ids'][] = $member->user->accountId;
            }
        }
        
        foreach (['members_admin_ids','members_member_ids','members_readonly_ids'] as $key) {
            if (!empty($options['body'][$key])) {
                $options['body'][$key] = implode(',', $options['body'][$key]);
            } else {
                unset($options['body'][$key]);
            }
        }

        $this->client->put(['rooms/{roomId}/members',['roomId' => $this->roomId]], $options);
    }
}