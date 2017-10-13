<?php

namespace Vanbrabantf\NpmStatFetcher\Builders;

use GuzzleHttp\Client;

class ClientBuilder
{
    /**
     * @return Client
     */
    public static function build()
    {
        return new Client([
            'base_uri' => 'https://api.npmjs.org/',
        ]);
    }
}
