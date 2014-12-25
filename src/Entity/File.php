<?php
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
     * @var int
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