<?php

namespace App\Providers;

use App\Models\CategoryAMY;
use App\Models\TaskAMY;
use App\Policies\CategoryPolicyAMY;
use App\Policies\TaskPolicyAMY;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProviderAMY extends ServiceProvider
{
    /**
     * The model → policy map.
     */
    protected $policies = [
        TaskAMY::class     => TaskPolicyAMY::class,
        CategoryAMY::class => CategoryPolicyAMY::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // -----------------------------------------------------------------
        // GATES
        // -----------------------------------------------------------------

        /** Gate: only admins can access admin panel */
        Gate::define('access-admin', fn ($user) => $user->isAdmin());

        /** Gate: admins and team_members can manage tasks */
        Gate::define('manage-tasks', fn ($user) => $user->isAdmin() || $user->isTeamMember());

        /** Gate: only admins can manage users */
        Gate::define('manage-users', fn ($user) => $user->isAdmin());

        /** Gate: admins and team_members can view reports */
        Gate::define('view-reports', fn ($user) => $user->isAdmin() || $user->isTeamMember());

        /** Gate: based on role, can change another user's role */
        Gate::define('change-role', fn ($user) => $user->isAdmin());
    }
}
