<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 05/01/19
 * Time: 20:21
 */

namespace AuthSetup;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class AuthSetupServiceProvider extends BaseServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/auth-setup.php' => config_path('auth-setup.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/../migrations/' => database_path('migrations')
        ], 'migrations');
        $this->loadMigrationsFrom(__DIR__.'/../migrations');

    }

    public function register()
    {

    }
}