<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
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
            $permissions = Cache::remember('permissions', 3600, function () {
                return Permission::with('userAccessGroups')->get();
            });
        }catch (\Exception $e) {
            return null;
        }

        Gate::before(function (User $user){
            if ($user->userAccessGroup->id == 1) return true;
        });

        foreach ($permissions as $permission){
            Gate::define($permission->permission, function (User $user) use($permission){
                return $permission->userAccessGroups->contains($user->userAccessGroup);
            });
        }

    }
}
