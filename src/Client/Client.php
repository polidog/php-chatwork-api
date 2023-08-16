<?php

declare(strict_types=1);

namespace Polidog\Chatwork\Client;

use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Middleware;
use Polidog\Chatwork\Exception\ClientException;
use Psr\Http\Message\RequestInterface;

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
        string $chatworkToken,
        string $apiVersion,
        ?HttpClientInterface $httpClient = null
    ) {
        if ($httpClient === null) {
            $httpClient = ClientFactory::createHttpClient($chatworkToken);
        }
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
            'form_params' => $data,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function put(string $path, array $data = []): array
    {
        return $this->request('put', $path, [
            'form_params' => $data,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $path, array $query = []): array
    {
        return $this->request('delete', $path, [
            'query' => $query,
        ]);
    }

    private function request(string $method, string $path, array $options = []): array
    {
        $path = sprintf('/%s/%s', $this->apiVersion, $path);
        try {
            return json_decode($this->httpClient->request($method, $path, $options)->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (GuzzleException $e) {
            throw new ClientException(sprintf('request error. method = %s, path = %s', $method, $path), $e->getCode(), $e);
        } catch (\JsonException $e) {
            throw new ClientException(sprintf('json parse error. method = %s, path = %s', $method, $path), $e->getCode(), $e);
        }
    }
}
