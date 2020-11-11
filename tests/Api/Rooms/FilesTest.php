<?php

namespace Polidog\Chatwork\Api\Rooms;

use PHPUnit\Framework\TestCase;
use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Collection\EntityCollection;
use Polidog\Chatwork\Entity\Factory\FileFactory;
use Polidog\Chatwork\Entity\Factory\RoomFactory;
use Polidog\Chatwork\Entity\File;

class FilesTest extends TestCase
{
    /**
     * @dataProvider providerFiles
     */
    public function testShow($apiResult)
    {
        $roomId = 1;
        $client = $this->prophesize(ClientInterface::class);
        $client->get("rooms/{$roomId}/files",[])
            ->willReturn($apiResult);

        $factory = new FileFactory();
        $api = new Files($client->reveal(), $factory, $roomId);
        $files = $api->show();
        $this->assertInstanceOf(EntityCollection::class, $files);
        foreach ($files as $file) {
            $this->assertInstanceOf(File::class, $file);
        }
    }

    /**
     * @dataProvider providerFile
     * @param array $apiResult
     */
    public function testDetail($apiResult)
    {
        $fileId = 1;
        $roomId = 1;
        $client = $this->prophesize(ClientInterface::class);
        $client->get("rooms/{$roomId}/files/{$fileId}", [
            'create_download_url' => 0
        ])
            ->willReturn($apiResult);

        $factory = new FileFactory();
        $api = new Files($client->reveal(), $factory, $roomId);
        $file = $api->detail($fileId);
        $this->assertInstanceOf(File::class, $file);
    }

    public function providerFiles()
    {
        $data = json_decode('[
  {
    "file_id": 3,
    "account": {
      "account_id": 123,
      "name": "Bob",
      "avatar_image_url": "https://dummyimage.com/600x400/000/fff.png"
    },
    "message_id": "22",
    "filename": "README.md",
    "filesize": 2232,
    "upload_time": 1384414750
  }
]', true);
        return [
            [$data]
        ];
    }

    public function providerFile()
    {
        $data = json_decode('{
  "file_id":3,
  "account": {
    "account_id":123,
    "name":"Bob",
    "avatar_image_url": "https://dummyimage.com/600x400/000/fff.png"
  },
  "message_id": "22",
  "filename": "README.md",
  "filesize": 2232,
  "upload_time": 1384414750
}', true);
        return [
            [$data]
        ];
    }

}
