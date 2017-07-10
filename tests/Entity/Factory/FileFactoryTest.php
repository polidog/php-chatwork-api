<?php
namespace Polidog\Chatwork\Entity\Factory;

use Polidog\Chatwork\Entity\File;
use Polidog\Chatwork\Entity\User;

class FileFactoryTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @test
     */
    public function エンティティを生成する()
    {
        $factory = new FileFactory();
        $entity = $factory->entity(json_decode('{
            "file_id":3,
            "account": {
                "account_id":123,
                "name":"Bob",
                "avatar_image_url": "https://example.com/ico_avatar.png"
            },
            "message_id": "22",
            "filename": "README.md",
            "filesize": 2232,
            "upload_time": 1384414750
        }',true));
        
        $this->assertInstanceOf(File::class, $entity);
        $this->assertInstanceOf(User::class, $entity->account);
        $this->assertEquals(3, $entity->fileId);
        $this->assertEquals("22", $entity->messageId);
        $this->assertEquals(2232, $entity->filesize);
        $this->assertEquals(1384414750, $entity->uploadTime);
        
    }
}
