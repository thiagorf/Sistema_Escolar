<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('adicionar-professor', function (User $user) {
            //dd($user->roles->has(0));
            if($user->roles->has(0)){
                if($user->roles->first()->role == 'Admin'){
                    return true;
                }
                return false;
            }
            return false; 
        });
        

        Gate::define('criar-curso', function (User $user) {
            if($user->roles->first()->role == 'Professor' || $user->roles->first()->role == 'Admin'){
                return true;
            }
            return false;
        });

        Gate::define('editar-curso', function (User $user) {
            if($user->roles->first()->role == 'Professor' || $user->roles->first()->role == 'Admin'){
                return true;
            }
            return false;
        });

        Gate::define('excluir-curso', function (User $user) {
            if($user->roles->first()->role == 'Professor' || $user->roles->first()->role == 'Admin'){
                return true;
            }
            return false;
        });
    }

      
}
