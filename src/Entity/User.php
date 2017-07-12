<?php

namespace Polidog\Chatwork\Entity;

/**
 * Class User.
 */
class User implements EntityInterface
{
    /**
     * account id.
     *
     * @var int
     */
    public $accountId;

    /**
     * @var int
     */
    public $roomId;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
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
    public $title;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $introduction;

    /**
     * @var string
     */
    public $mail;

    /**
     * @var string
     */
    public $telOrganization;

    /**
     * @var string
     */
    public $telExtension;

    /**
     * @var string
     */
    public $telMobile;

    /**
     * @var string
     */
    public $skype;

    /**
     * @var string
     */
    public $facebook;

    /**
     * @var string
     */
    public $twitter;

    /**
     * @var string
     */
    public $avatarImageUrl;
}
