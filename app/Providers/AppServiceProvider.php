<?php

namespace App\Providers;

use App\Models\Frontend\Cart;
use Illuminate\Support\ServiceProvider;
use Auth;

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
    public function boot()
    {
        view()->share('totalQty', $this->getCartQty());
    }

    private function getCartQty()
    {
        if (Auth::check()) {
            return Cart::where('id_user', Auth::user()->id)->sum('qty');
        }
        return 0;
    }

}