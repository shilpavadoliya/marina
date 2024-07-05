<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use App\Services\BrevoSmsService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(BrevoSmsService::class, function ($app) {
            return new BrevoSmsService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('BREVO_API_KEY'));
        $this->app->singleton(TransactionalEmailsApi::class, function () use ($config) {
            return new TransactionalEmailsApi(null, $config);
        });
    }
}
