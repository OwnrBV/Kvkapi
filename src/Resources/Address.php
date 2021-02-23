<?php

namespace Owner\KvkApi\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

/**
 * Owner\KvkApi\Resources\Address
 */
class Address implements Arrayable
{
    /**
     * @var array
     */
    protected $payload;

    /**
     * Address constructor.
     *
     * @param array $payload
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    /**
     * Retrieves the street of this company
     *
     * @return string|null
     */
    public function street(): ?string
    {
        return Arr::get($this->payload, 'street');
    }

    /**
     * Retrieves the house number of this company
     *
     * @return string|null
     */
    public function houseNumber(): ?string
    {
        return Arr::get($this->payload, 'houseNumber');
    }

    /**
     * Retrieves the extra of this company
     *
     * @return string|null
     */
    public function extra(): ?string
    {
        return Arr::get($this->payload, 'houseNumberAddition');
    }

    /**
     * Retrieves the postal code of this company
     *
     * @return string|null
     */
    public function postalCode(): ?string
    {
        return Arr::get($this->payload, 'postalCode');
    }

    /**
     * Retrieves the city of this company
     *
     * @return string|null
     */
    public function city(): ?string
    {
        return Arr::get($this->payload, 'city');
    }

    /**
     * Retrieves the country of this company
     *
     * @return string|null
     */
    public function country(): ?string
    {
        return Arr::get($this->payload, 'country');
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'street' => $this->street(),
            'houseNumber' => $this->houseNumber(),
            'extra' => $this->extra(),
            'postalCode' => $this->postalCode(),
            'city' => $this->city(),
            'country' => $this->country(),
        ];
    }
}
