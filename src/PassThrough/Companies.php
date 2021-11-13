<?php

namespace Owner\KvkApi\PassThrough;

use Owner\KvkApi\Concerns\HasConnection;
use Owner\KvkApi\Resources;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;

/**
 * Owner\KvkApi\PassThrough\Companies
 */
class Companies
{
    use HasConnection;

    public function profile(string $query, int $page = 1): ?Resources\Companies
    {
        try {
            $url = vsprintf('profile/companies?%s', [http_build_query(['q' => $query, 'startPage' => $page])]);
            $response = $this->connection->request('GET', $url);

            if ($data = json_decode($response->getBody(), true)) {
                $collection = new Resources\Companies(
                    Arr::get($data, 'data.startPage'),
                    Arr::get($data, 'data.totalItems'),
                    Arr::get($data, 'data.itemsPerPage')
                );

                foreach (Arr::get($data, 'data.items') as $company) {
                    $collection->push(new Resources\Company($company));
                }

                return $collection;
            }
        } catch (GuzzleException $e) {
            //
        }

        return null;
    }

    public function search(string $query, int $page = 1): ?Resources\Companies
    {
        try {
            $url = vsprintf('search/companies?%s', [http_build_query(['q' => $query, 'startPage' => $page])]);
            $response = $this->connection->request('GET', $url);

            if ($data = json_decode($response->getBody(), true)) {
                $collection = new Resources\Companies(
                    Arr::get($data, 'data.startPage'),
                    Arr::get($data, 'data.totalItems'),
                    Arr::get($data, 'data.itemsPerPage')
                );

                foreach (Arr::get($data, 'data.items') as $company) {
                    if(isset($company['isMainBranch']) && $company['isMainBranch'] === true){
                        $collection->push(new Resources\Company($company));
                    }
                }

                return $collection;
            }
        } catch (GuzzleException $e) {
            //
        }

        return null;
    }
}
