<?php

namespace Owner\KvkApi\Resources;

use Owner\KvkApi\Collection;

/**
 * Owner\KvkApi\Resources\Companies
 */
class Companies extends Collection
{
    /**
     * @var int
     */
    public $pageSize;

    /**
     * @var int
     */
    public $page;

    /**
     * @var int
     */
    public $total;

    public function __construct(int $page, int $total, int $pageSize)
    {
        $this->page = $page;
        $this->total = $total;
        $this->pageSize = $pageSize;
    }

    /** {@inheritDoc} */
    public function current(): ?Company
    {
        return current($this->items);
    }

    /** {@inheritDoc} */
    public function push(Company $companies): Companies
    {
        $this->items[] = $companies;

        return $this;
    }
}
