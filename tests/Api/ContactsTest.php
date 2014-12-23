<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 14/12/24
 * Time: 5:50
 */

namespace Api;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Phake;
use Polidog\Chatwork\Api\Contacts;

class ContactsTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @test
     */
    public function callApiContacts()
    {
        $httpClient = Phake::mock(ClientInterface::class);
        $response = Phake::mock(ResponseInterface::class);
        Phake::when($httpClient)->get('contacts')->thenReturn($response);
        Phake::when($response)->json()->thenReturn([]);

        $me = new Contacts($httpClient);
        $me->show();

        Phake::verify($httpClient, Phake::times(1))->get('contacts');
        Phake::verify($response, Phake::times(1))->json();        
    }
}