<?php
namespace Polidog\Chatwork;

use Chatwork\Entity\EntityInterface;
use Polidog\Chatwork\Exception\NoSupportApiException;

/**
 * Interface ClientInterface
 * @package Chatwork
 */
interface ClientInterface 
{
    /**
     * @param $method
     * 
     * @return Api\Me
     * @throws NoSupportApiException
     */
    public function api($method);
    
}