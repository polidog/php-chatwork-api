<?php
namespace Polidog\Chatwork\Api;


class Rooms extends AbstractApi
{
    const ACTION_TYPE_LEAVE = 'leave';
    const ACTION_TYPE_DELETE = 'delete';
    
    
    /**
     * 自分のチャット一覧の取得
     * @param int $id
     *
     * @return array
     */
    public function show($id = null)
    {
        if (is_null($id)) {
            return $this->client->get('rooms')->json();
        }
        return $this->client->get(['rooms/{id}',['id' => $id]])->json();
    }

    /**
     * グループチャットを新規作成
     * @param $name
     * @param $members_admin_ids
     * @param array $options
     *
     * @return mixed
     */
    public function create($name, $members_admin_ids, $options = array())
    {
        $options['name'] = $name;
        $options['members_admin_ids'] = $members_admin_ids;
        return $this->client->post('rooms',[
            'body' => $options
        ])->json();
    }

    /**
     * チャットの名前、アイコンをアップデート
     * @param $id room id
     * @param array $options
     *
     * @return array
     */
    public function update($id, $options = array())
    {
        return $this->client->put(
            [
                'rooms/{id}',['id' => $id]
            ],
            [
                'body' => $options
            ]
        )->json();
    }

    /**
     * グループチャットを退席/削除する
     * @param int $id room id
     * @param string $actionType
     * 
     * @return array
     */
    public function remove($id, $actionType)
    {
        return $this->client->delete(
            [
                'rooms/{id}',['id' => $id]
            ],
            [
                'query' => [
                    'action_type' => $actionType
                ]
            ]);
    }
  
}