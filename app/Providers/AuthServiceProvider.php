<?php

namespace App\Providers;

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

        Gate::define('isAdmin', function($user) {
            return $user->role->name == 'Super Admin';
         });
        
         Gate::define('isWriter', function($user) {
             return $user->role->name == 'Writer';
         });
       
         Gate::define('isPublisher', function($user) {
             return $user->role->name == 'Publisher';
         }); 
 
         Gate::define('isGuest', function($user) {
             return $user->role->name == 'Guest';
         });

         Gate::before(function($user, $ability) {
            if ($user->hasPermission($ability)) {
                  return true;
            }
      });
      
    }
}
