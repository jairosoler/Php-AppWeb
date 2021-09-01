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
       

        $this->app->singleton(Client::class, function() {
            
        $baseUrl = env('API_ENDPOINT');
            
            return new Client([
                'base_uri' => $baseUrl,
                'timeout' => 30.0,
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
