<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Entity;

class IncomingRequest implements EntityInterface
{
    /**
     * @var int
     */
    public $requestId;

    /**
     * @var int
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
     * @var int
     */
    public $chatworkId;

    /**
     * @var int
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
