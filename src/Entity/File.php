<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Entity;

class File implements EntityInterface
{
    /**
     * @var int
     */
    public $fileId;

    /**
     * @var User
     */
    public $account;

    /**
     * @var string
     */
    public $messageId;

    /**
     * @var string
     */
    public $filename;

    /**
     * @var int
     */
    public $filesize;

    /**
     * @var \DateTime
     */
    public $uploadTime;
}
