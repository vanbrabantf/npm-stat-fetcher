<?php

namespace Vanbrabantf\NpmStatFetcher;

use GuzzleHttp\Client;

class ClientFactory
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
