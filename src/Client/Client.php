<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Client;

use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Middleware;
use Polidog\Chatwork\Exception\ClientException;
use Psr\Http\Message\RequestInterface;
use Polidog\Chatwork\Client\ClientInterface;

final class Client implements ClientInterface
{
    /**
     * @var string
     */
    private $apiVersion;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @param string              $chatworkToken
     * @param HttpClientInterface $httpClient
     */
    public function __construct(
        HttpClientInterface $httpClient,
        string $chatworkToken,
        string $apiVersion
    ) {
        $httpClient->getConfig('handler')->push(Middleware::mapRequest(function (RequestInterface $request) use ($chatworkToken) {
            return $request->withHeader('X-ChatWorkToken', $chatworkToken);
        }));
        $this->apiVersion = $apiVersion;
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $path, array $query = []): array
    {
        return $this->request('get', $path, [
            'query' => $query,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function post(string $path, array $data = []): array
    {
        return $this->request('post', $path, [
            'form_params' => $data
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function put(string $path, array $data = []): array
    {
        return $this->request('put', $path, [
            'form_params' => $data
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $path, array $query = []): array
    {
        return $this->request('delete', $path, [
            'query' => $query
        ]);
    }

    private function request(string $method, string $path, array $options = []): array
    {
        $path = sprintf('/%s/%s', $this->apiVersion, $path);
        try {
            return json_decode($this->httpClient->request($method, $path, $options)->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new ClientException(sprintf('request error. method = %s, path = %s', $method, $path), $e->getCode(), $e);
        }
    }
}
