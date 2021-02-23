<?php

namespace Owner\KvkApi\Concerns;

use Owner\KvkApi\Connection;

/**
 * Owner\KvkApi\Concerns\HasConnection
 */
trait HasConnection
{
    /** @var  \Owner\KvkApi\Connection */
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}
