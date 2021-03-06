<?php
/*
* File:     LaravelServiceProvider.php
* Category: Provider
* Author:   M. Goldenbaum
* Created:  19.01.17 22:21
* Updated:  -
*
* Description:
*  -
*/

namespace Webklex\GitHook\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/git-hook.php' => config_path('git-hook.php'),
        ]);

        $this->mergeConfigFrom(realpath(__DIR__.'/../../config/git-hook.php'), 'git-hook');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'git-hook');

        require __DIR__.'/../Http/routes.php';
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('git-hook', function ($app) {
            return new GitHookApp;
        });

    }
}