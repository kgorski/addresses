<?php

namespace App\Providers;

use App\Services\AddressService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Initializes Elasticsearch client
        $this->app->singleton(
            'Elasticsearch\Client',
            function ($app) {
                return \Elasticsearch\ClientBuilder::fromConfig(
                    [
                        'hosts' => explode(',', env('ELASTICSEARCH_HOSTS')),
                    ]
                );
            }
        );

        // Initializes address service
        $this->app->bind(
            'Services\AddressService',
            function ($app) {
                //return new AddressService($app->make('Elasticsearch\Client'));
                return new AddressService($app['Elasticsearch\Client']);
            }
        );
    }
}
