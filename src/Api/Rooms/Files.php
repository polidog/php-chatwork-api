<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Api\Rooms;

use Polidog\Chatwork\Client\ClientInterface;
use Polidog\Chatwork\Entity\Collection\CollectionInterface;
use Polidog\Chatwork\Entity\Factory\FileFactory;
use Polidog\Chatwork\Entity\File;

/**
 * Class Files.
 */
class Files
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var FileFactory
     */
    private $factory;

    /**
     * @var int
     */
    private $roomId;

    /**
     * Files constructor.
     *
     * @param ClientInterface $client
     * @param FileFactory     $factory
     * @param int             $roomId
     */
    public function __construct(ClientInterface $client, FileFactory $factory, int $roomId)
    {
        $this->client = $client;
        $this->factory = $factory;
        $this->roomId = $roomId;
    }

    /**
     * @param null $accountId
     *
     * @return CollectionInterface
     */
    public function show($accountId = null)
    {
        $options = [
        ];

        if (!is_null($accountId)) {
            $options['account_id'] = $accountId;
        }

        return $this->factory->collection(
            $this->client->get(
                "rooms/{$this->roomId}/files",
                $options
            )
        );
    }

    /**
     * @param int $id
     * @param bool $createDownloadUrl
     *
     * @return File
     */
    public function detail($id, $createDownloadUrl = null)
    {
        $options = [];
        if ($createDownloadUrl !== null) {
            $options['create_download_url'] = (bool)$createDownloadUrl;
        }

        return $this->factory->entity(
          $this->client->get(
              "rooms/{$this->roomId}/files/{$id}",
              $options
          )
        );
    }
}
