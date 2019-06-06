<?php

namespace App\Providers;

use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Project' => 'App\Policies\ProjectPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*
        Here we are giving an user administritive permission
        we should have a function to check either the user is admin or not
        for now the user 1 will have the administritive permission.
        we have to pass (Gate $gate) as parameter in boot
         */
        // $gate->before(function ($user) {
        //     return $user->id == 1 ? true : null;
        // });
        // $gate->before(function ($user) {
        //     if ($user->id == 1) {
        //         return true; //this is admin id
        //     }
        // });
    }
}
