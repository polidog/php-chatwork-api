<?php
namespace Polidog\Chatwork\Entity;


class Member implements EntityInterface
{
    /**
     * @var string
     */
    public $role;

    /**
     * @var User
     */
    public $account;
}