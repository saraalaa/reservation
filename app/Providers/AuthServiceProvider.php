<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is_backoffice', function ($user){
            return $user->type == 'backoffice';
        });

        Gate::define('is_doctor', function ($user){
            return $user->type == 'doctor';
        });

        Gate::define('is_user', function ($user){
            return $user->type == 'user';
        });
    }
}
