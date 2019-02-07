<?php

namespace App\Providers;

use App\BlowfishEncrypter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        // encrypter上書き
        $this->app->singleton('encrypter', function ($app) {
            /* @var \Illuminate\Contracts\Foundation\Application $app */
            $config = $app->make('config')->get('app');

            if (Str::startsWith($key = $this->key($config), 'base64:')) {
                $key = base64_decode(substr($key, 7));
            }

            return new BlowfishEncrypter($key);
        });
    }

    protected function key(array $config)
    {
        return tap($config['key'], function ($key) {
            if (empty($key)) {
                throw new \RuntimeException('No application encryption key has been specified.');
            }
        });
    }
}
