<?php

namespace App\Providers;

use App\Role\RoleChecker;
use App\Role\UserRole;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //-- Before allow admin to access all zones
        Gate::before(function (User $user)
        {
            if (RoleChecker::check($user, UserRole::ROLE_ADMIN))
                return true;
        });

        //-- used in GearFilter to display / hide some gear in index
        Gate::define('see-admin-only-data', function ($user) {
            if (RoleChecker::check($user, UserRole::ROLE_ADMIN))
            {
                return true;
            }
        });

        Gate::define('see-userprofile-private-data', function (User $user, User $profile) {
            if (RoleChecker::check($user, UserRole::ROLE_ADMIN))
            {
                return true;
            }
            else
            {
                return $user->id === $profile->id;
            }
        });

        Gate::define('edit-userprofile-hidden-data', function ($user) {
            if (RoleChecker::check($user, UserRole::ROLE_ADMIN))
            {
                return true;
            }
        });

    }
}
