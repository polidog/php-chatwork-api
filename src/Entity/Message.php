<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Entity;

class Message implements EntityInterface
{
    /**
     * @var string
     */
    public $messageId;

    /**
     * @var User
     */
    public $account;

    /**
     * @var string
     */
    public $body;

    /**
     * @var \DateTime
     */
    public $sendTime;

    /**
     * @var \DateTime
     */
    public $updateTime;
}
