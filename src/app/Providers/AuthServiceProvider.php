<?php

namespace App\Providers;

use App\Policies\ContentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Psr\Log\LoggerInterface;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \stdClass::class => ContentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate, LoggerInterface $logger)
    {
        $this->registerPolicies();

        // 「自身であること」を user-access という名前で認可処理として登録
        $gate->define('user-access', new \App\Gate\UserAccess());
        // または \Gate::define('user-access'...)

        // 認可処理実行前に、認可試行をロギング
        $gate->before(function (\App\User $user, $ability) use ($logger) {
            $logger->info($ability, [
                'user_id' => $user->getAuthIdentifier(),
            ]);
        });
    }
}
