<?php


namespace Polidog\Chatwork\Entity;


class IncomingRequest implements EntityInterface
{
    /**
     * @var integer
     */
    public $requestId;

    /**
     * @var integer
     */
    public $accountId;

    /**
     * @var string
     */
    public $message;

    /**
     * @var string
     */
    public $name;

    /**
     * @var integer
     */
    public $chatworkId;

    /**
     * @var integer
     */
    public $organizationId;

    /**
     * @var string
     */
    public $organizationName;

    /**
     * @var string
     */
    public $department;

    /**
     * @var string
     */
    public $avatarImageUrl;
}
