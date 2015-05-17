<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Guard;
use Auth;
//use Hash;

class AdminAuthServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		Auth::extend('adminEloquent', function($app){
            // you can use Config::get() to retrieve the model class name from config file
            
            $myProvider = new EloquentUserProvider($app['hash'], '\App\Admin');
            //ファサード:Hashがあるので、コンテナ名'hash'もある。$app['hash']でコンテナ（hashインスタンス）を取る
            
            return new Guard($myProvider, $app['session.store']);
        });
        
        $this->app->singleton('auth.driver_admin', function($app){
            return Auth::driver('adminEloquent');
        });
	}

}
