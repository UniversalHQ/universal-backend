<?php

namespace App\Providers;

use App\WarApi\WarApiClient;
use App\WarApi\WarApiService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class WarApiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WarApiService::class, function () {
            return new WarApiService(new WarApiClient(config('services.warApi.url')));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [WarApiService::class];
    }

}
