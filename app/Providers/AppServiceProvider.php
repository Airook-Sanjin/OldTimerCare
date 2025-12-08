<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        View::composer('*', function ($view) {
        $user = Auth::user();
        $isEmployee = $user ? DB::table('Employee')->where('UserID', $user->UserID)->first() : null;
        $isPatient  = $user ? DB::table('Patient')->where('UserID', $user->UserID)->first() : null;
        $isFamily   = $user ? DB::table('FamilyMember')->where('UserID', $user->UserID)->first() : null;

        $view->with(['isEmployee'=> $isEmployee,
    'isPatient'=> $isPatient,
'isFamily'=> $isFamily]);
    });
    }
}
