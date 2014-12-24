<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 14/12/24
 * Time: 5:50
 */

namespace Polidog\Chatwork\Api;

use GuzzleHttp\Message\ResponseInterface;
use Polidog\Chatwork\Api\Contacts;
use Polidog\Chatwork\Collection\EntityCollection;
use Polidog\Chatwork\Entity\Factory\UserFactory;

use GuzzleHttp\ClientInterface;
use Phake;


class ContactsTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @test
     */
    public function callApiContacts()
    {
        $httpClient = Phake::mock(ClientInterface::class);
        $userFactory = Phake::mock(UserFactory::class);
        $response = Phake::mock(ResponseInterface::class);
        
        Phake::when($httpClient)->get('contacts')->thenReturn($response);
        Phake::when($userFactory)->collection([])->thenReturn(new EntityCollection());
        Phake::when($response)->json()->thenReturn([]);
        
        $contacts = new Contacts($httpClient, $userFactory);
        $contacts->show();
        
        Phake::verify($httpClient,Phake::times(1))->get('contacts');
        Phake::verify($userFactory,Phake::times(1))->collection($this->isType('array'));
        Phake::verify($response, Phake::times(1))->json();
    }
}