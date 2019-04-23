<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//su dung LoaisanPham
use App\TypeProducts;

use App\Cart;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    //view share
    public function boot()
    {
        view()->composer('header',function($view){
            $loai_sp=TypeProducts::all();        

            $view->with('lsp',$loai_sp);
            
        });
        view()->composer('header',function($view){
            if(Session('cart')){
                $oldCart=Session::get('cart');
                $cart=new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
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
