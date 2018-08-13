<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Skitch' => 'App\Policies\SkitchPolicy',
        'App\Workspace' => 'App\Policies\WorkspacePolicy',
        'App\Post'  => 'App\Policies\PostPolicy',
        'App\Thread'  => 'App\Policies\ThreadPolicy',
        'App\Comment'  => 'App\Policies\CommentPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function($user){

            if ($user->username == 'mahmoud.hadi') {
                return true ; 
            }
        });
    }
}
