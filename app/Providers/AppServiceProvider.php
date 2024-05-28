<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Silber\Bouncer\BouncerFacade as Bouncer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

//        Bouncer::define('admin', function ($user) {
//            return $user->isAdmin();
//        });
//
//        Bouncer::define('user', function ($user) {
//            return $user->isUser();
//        });
//
//        Bouncer::define('manager', function ($user) {
//            return $user->isManager();
//        });

        Bouncer::define('delete-users', function ($user) {
            return !$user->isAdmin();
        });


        // Definišemo dozvolu za ažuriranje korisnika
        Bouncer::allow('admin')->to(['edit-users', 'update-users', 'delete-users', 'create-managers']);

//        Bouncer::allow('admin')->to(['add-parking-lot', 'edit-parking-lot', 'add-user', 'manage-user', 'view-statistics']);
//        Bouncer::allow('user')->to(['reserve-parking', 'view-reservations', 'view-parking-lots', 'view-profile', 'cancel-reservation']);
//        Bouncer::allow('manager')->to(['view-statistics', 'edit-parking-lot', 'view-reservations', 'manage-employees']);
    }
}
