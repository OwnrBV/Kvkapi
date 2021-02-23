<?php

namespace Owner\KvkApi;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Iterator;

/**
 * Owner\KvkApi\Collection
 */
abstract class Collection implements Arrayable, ArrayAccess, Iterator
{
    /** @var array */
    protected $items = [];

    public function all(): array
    {
        return $this->items;
    }

    public function next(): void
    {
        next($this->items);
    }

    public function key(): ?int
    {
        return key($this->items);
    }

    public function valid(): bool
    {
        return array_key_exists(key($this->items), $this->items);
    }

    public function rewind(): void
    {
        reset($this->items);
    }

    public function count(): int
    {
        return \count($this->items);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->items[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    public function toArray(): array
    {
        return collect($this->items)->toArray();
    }
}
