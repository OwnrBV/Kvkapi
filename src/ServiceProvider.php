<?php

namespace Owner\KvkApi;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;

/**
 * Owner\KvkApi\ServiceProvider
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/kvk.php', 'kvk');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config' => config_path(),
            ], 'config');
        }
    }

    public function register(): void
    {
        $this->app->singleton(Connection::class, static function () {
            return new class extends \GuzzleHttp\Client implements Connection
            {
                public function __construct()
                {
                    $middleware = Middleware::mapRequest(static function (RequestInterface $request) {
                        return $request->withUri(
                            Uri::withQueryValue($request->getUri(), 'user_key', config('kvk.api_key'))
                        );
                    });

                    parent::__construct([
                        'headers' => ['Content-Type' => 'application/json'],
                        'handler' => tap(HandlerStack::create())->push($middleware),
                        'base_uri' => 'https://api.kvk.nl/api/v2/' . (config('kvk.test_mode') ? 'test' : ''),
                        'verify'    => false,
                    ]);
                }
            };
        });
    }
}
