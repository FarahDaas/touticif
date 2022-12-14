<?php

namespace App\Providers;

use App\cart;
use App\produit;
use App\wishlist;
use App\categorie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer(['*'], function ($view) {
        /**debut cart welcome page**/
        $session_id=Session::get('session_id');
        $cart_icon=cart::where('session_id','=',$session_id)->get();
        $product_cart=produit::all();
        /**fin cart welcome page**/


        /**wishlist table**/
        $wishlist=wishlist::where('session_id','=',$session_id)->get();
        /**fin wishlist table**/

            $view->with('wishlist', $wishlist);
            $view->with('product_cart', $product_cart);
            $view->with('cart_icon', $cart_icon);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
