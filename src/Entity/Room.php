<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Entity;

use Cake\Utility\Inflector;

class Room implements EntityInterface
{
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
    public $type;

    /**
     * @var string
     */
    public $role;

    /**
     * @var bool
     */
    public $sticky;

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

    /**
     * @var int
     */
    public $messageNum;

    /**
     * @var int
     */
    public $fileNum;

    /**
     * @var int
     */
    public $taskNum;

    /**
     * @var string
     */
    public $iconPath;

    /**
     * @var int
     */
    public $lastUpdateTime;

    /**
     * @var string
     */
    public $description;

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];
        foreach (get_object_vars($this) as $property => $value) {
            $key = Inflector::underscore($property);
            $array[$key] = $value;
        }

        return $array;
    }
}
