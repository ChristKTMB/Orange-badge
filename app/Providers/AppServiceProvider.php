<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        //
        
        Blade::if('interim', function (int $userId) {
            $user = User::find($userId);
            if (count($user->interimaires) > 0) {

                return true;
            }else {
                return false;
            }
        });
        
    }
}
