<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

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
            DB::connection()->getPdo();
        }catch (\Exception $e) {
            return null;
        }

        if(!Schema::hasTable('permissions')) return null;

        $permissions = Permission::all();

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
