<?php
namespace Polidog\Chatwork\Api;

use Polidog\Chatwork\Entity\Factory\UserFactory;
use Polidog\Chatwork\Entity\User;

use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\ClientInterface;
use Phake;


class MeTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @test
     */
    public function callApi()
    {
        $data = json_decode('{
                  "account_id": 123,
                  "room_id": 322,
                  "name": "John Smith",
                  "chatwork_id": "tarochatworkid",
                  "organization_id": 101,
                  "organization_name": "Hello Company",
                  "department": "Marketing",
                  "title": "CMO",
                  "url": "http://mycompany.com",
                  "introduction": "Self Introduction",
                  "mail": "taro@example.com",
                  "tel_organization": "XXX-XXXX-XXXX",
                  "tel_extension": "YYY-YYYY-YYYY",
                  "tel_mobile": "ZZZ-ZZZZ-ZZZZ",
                  "skype": "myskype_id",
                  "facebook": "myfacebook_id",
                  "twitter": "mytwitter_id",
                  "avatar_image_url": "https://example.com/abc.png"
                }', true);
        
        
        $httpClient = Phake::mock(ClientInterface::class);
        $response = Phake::mock(ResponseInterface::class);
        $factory = Phake::mock(UserFactory::class);
        
        Phake::when($httpClient)->get('me')->thenReturn($response);
        Phake::when($response)->json()->thenReturn($data);
        Phake::when($factory)->entity($data)->thenReturn(new User());
        
        $me = new Me($httpClient, $factory);
        $me->show();
        
        Phake::verify($httpClient, Phake::times(1))->get('me');
        Phake::verify($response, Phake::times(1))->json();
        Phake::verify($factory, Phake::times(1))->entity($data);
    }
}