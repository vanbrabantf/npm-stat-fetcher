<?php

namespace Vanbrabantf\NpmStatFetcher;

use GuzzleHttp\Client;

class NpmRegistryRepository
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $path
     * @return string
     */
    public function getResourceByPath(string $path): string
    {
        $resource = $this->client->get($path);

        return $resource->getBody()->getContents();
    }
}
