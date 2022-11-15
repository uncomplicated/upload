<?php

namespace Ggss\Upload;

use Illuminate\Support\ServiceProvider;

class UploadProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPublishing();
        $this->registerMigrations();
        $this->registerRoutes();
    }

    /**
     * Register the package's migrations.
     *
     * @return void
     */
    private function registerMigrations()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }

    private function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'upload-migrations');

            $this->publishes([
                __DIR__.'/../config' => config_path('media.php'),
            ], 'upload-config');
        }
    }

}
