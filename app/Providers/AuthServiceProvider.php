<?php

namespace App\Providers;

use App\Models\Permission;
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
     * Register any authentication / authorization Services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        try {
            $permissions = Permission::all();
        }catch (\Exception) {
            return null;
        }

        Gate::before(function ($user){
            if ($user->userAccessGroup->id == 1){
                return true;
            }
        });

        foreach ($permissions as $permission){
            Gate::define($permission->permission, function ($user) use($permission){
                return $permission->userAccessGroups->contains($user->userAccessGroup);
            });
        }

    }
}
