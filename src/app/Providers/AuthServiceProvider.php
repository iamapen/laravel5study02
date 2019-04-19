<?php

namespace App\Providers;

use App\Auth\UserTokenProvider;
use App\DataProvider\Database\UserToken;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 独自認証ドライバの登録
        $this->app['auth']->provider(
            'cache_eloquent',
            function (Application $app, array $config) {
                return new \App\Auth\CacheUserProvider(
                    $app['hash'],
                    $config['model'],
                    $app['cache']->driver()
                );
            }
        );

        // 独自認証ドライバを user_token として登録
        $this->app['auth']->provider(
            'user_token',
            function (Application $app) {
                return new UserTokenProvider(new UserToken($app['db']));
            }
        );
    }
}
