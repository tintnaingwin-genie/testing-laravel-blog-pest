<?php

namespace App\Policies;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPostPolicy
{
    use HandlesAuthorization;

    public function manage(User $user, ?BlogPost $post = null): bool
    {
        return $user->is_admin;
    }
}
