<?php
namespace Polidog\Chatwork\Entity;

/**
 * Class Task
 */
class Task implements EntityInterface 
{
    /**
     * @var int 
     */
    public $taskId;

    /**
     * @var Room
     */
    public $room;

    /**
     * @var User
     */
    public $account;
    
    /**
     * @var User
     */
    public $assignedByAccount;

    /**
     * @var string
     */
    public $messageId;

    /**
     * @var string
     */
    public $body;

    /**
     * @var \DateTime
     */
    public $limitTime;

    /**
     * @var string
     */
    public $status;
    
}
