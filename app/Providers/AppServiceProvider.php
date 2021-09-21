<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use View;
use App\Models\Message;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
  public function register(){}
  public function boot(){
	Schema::defaultStringLength(191);
	 view()->composer('*', function ($view){
         view()->composer('*', function($view){
           if (Auth::check()) {
	    $my_id = Auth::id();
            $users = message::where('is_read', 0)->where('user_id', $my_id)->count();
            $view->with('users', $users );
           }else {
            $view->with('users', 0);
            }
          });
	  view()->composer('*', function($view){
          if (Auth::check()) {
	    $my_id = Auth::id();
            $message = message::where('is_read', 0)->where(['user_id' => $my_id])->get();
            $view->with('message', $message );
          }
       });
      });
    }
}