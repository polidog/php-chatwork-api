<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Entity\Factory\StatusFactory;
use Polidog\Chatwork\Entity\Factory\TaskFactory;

/**
 * Api /my.
 */
class My extends AbstractApi
{
    /**
     * ステータスを取得する.
     *
     * @return My\Status
     */
    public function status()
    {
        return new My\Status($this->client, new StatusFactory());
    }

    /**
     * タスクを取得する.
     *
     * @param array $options
     *
     * @return mixed
     */
    public function tasks(array $options = [])
    {
        return new My\Tasks($this->client, new TaskFactory());
    }
}
