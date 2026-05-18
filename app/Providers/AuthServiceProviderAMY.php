<?php

namespace App\Providers;

use App\Models\CategoryXYZ;
use App\Models\TaskXYZ;
use App\Policies\CategoryPolicyXYZ;
use App\Policies\TaskPolicyXYZ;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProviderXYZ extends ServiceProvider
{
    /**
     * The model → policy map.
     */
    protected $policies = [
        TaskXYZ::class     => TaskPolicyXYZ::class,
        CategoryXYZ::class => CategoryPolicyXYZ::class,
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
