<?php
namespace App\Policies;

use App\Models\TaskAMY;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicyAMY
{
    use HandlesAuthorization;

    /**
     * Admin can do anything — this runs before all other policy methods.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true; // bypass all checks
        }
        return null; // fall through to specific methods
    }

    /** Any authenticated user can view the task list */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * A user can view a task if:
     * - They are the creator, OR
     * - The task is assigned to them, OR
     * - They are a team_member
     */
    public function view(User $user, TaskAMY $task): bool
    {
        return $user->id === $task->created_by
            || $user->id === $task->assigned_to
            || $user->isTeamMember();
    }

    /** Only team_members and admins can create tasks */
    public function create(User $user): bool
    {
        return $user->isTeamMember() || $user->isAdmin();
    }

    /**
     * A user can update a task if:
     * - They are the creator, OR
     * - The task is assigned to them (they can update status), OR
     * - They are a team_member
     */
    public function update(User $user, TaskAMY $task): bool
    {
        return $user->id === $task->created_by
            || $user->id === $task->assigned_to
            || $user->isTeamMember();
    }

    /** Only the creator or an admin can delete */
    public function delete(User $user, TaskAMY $task): bool
    {
        return $user->id === $task->created_by;
    }

    /** Only admin and team_member can assign tasks */
    public function assign(User $user, TaskAMY $task): bool
    {
        return $user->isTeamMember() || $user->isAdmin();
    }
}
