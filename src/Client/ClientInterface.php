<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Client;

use Polidog\Chatwork\Exception\ClientException;

/**
 * Interface ClientInterface.
 */
interface ClientInterface
{
    /**
     * @param string $path
     * @param array  $query
     *
     * @return array
     *
     * @throws ClientException
     */
    public function get(string $path, array $query = []): array;

    /**
     * @param string $path
     * @param array  $data
     *
     * @return array
     *
     * @throws ClientException
     */
    public function post(string $path, array $data = []): array;

    /**
     * @param string $path
     * @param array  $data
     *
     * @return array
     *
     * @throws ClientException
     */
    public function put(string $path, array $data = []): array;

    /**
     * @param string $path
     * @param array  $query
     *
     * @return array
     *
     * @throws ClientException
     */
    public function delete(string $path, array $query = []): array;

}
