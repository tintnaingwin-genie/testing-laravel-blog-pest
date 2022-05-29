<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Policies\BlogPostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        BlogPost::class => BlogPostPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
