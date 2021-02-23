<?php

namespace Owner\KvkApi;

use Owner\KvkApi\Concerns\HasConnection;

/**
 * Owner\KvkApi\Client
 */
class Client
{
    use HasConnection;

    /** @var  array */
    protected $config;

    public function companies(): PassThrough\Companies
    {
        return new PassThrough\Companies($this->connection);
    }
}
