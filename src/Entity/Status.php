<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 14/12/24
 * Time: 18:54
 */

namespace Polidog\Chatwork\Entity;

/**
 * Class Status
 * @package Polidog\Chatwork\Entity
 * 
 * @see http://developer.chatwork.com/ja/endpoint_my.html#GET-my-status
 */
class Status implements EntityInterface
{
    /**
     * @var int
     */
    public $unreadRoomNum;

    /**
     * @var int
     */
    public $mentionRoomNum;

    /**
     * @var int
     */
    public $mytaskRoomNum;

    /**
     * @var int
     */
    public $unreadNum;

    /**
     * @var int
     */
    public $mentionNum;

    /**
     * @var int
     */
    public $mytaskNum;
}