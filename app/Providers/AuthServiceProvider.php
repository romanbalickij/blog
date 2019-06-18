<?php

namespace App\Providers;


use App\Models;
use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate )
    {
        $this->registerPolicies($gate  );


        foreach ($this->getPermissions() as $permission) {

            $gate->define($permission->name, function ($user) use  ($permission) {

               return  $user->hasRole($permission->roles);
            });
        }
    }

    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
