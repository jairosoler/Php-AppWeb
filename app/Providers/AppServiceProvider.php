<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $baseUrl = env('API_ENDPOINT');

        $this->app->singleton(Client::class, function() {

            return new Client([
                'base_uri' => 'http://54.163.147.33:8080/',
                //'base_uri' => 'https://jsonplaceholder.typicode.com',
                'timeout' => 2.0,
            ]);

        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}