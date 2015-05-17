<?php namespace App\Providers;

use App\Authenticate\AdminUserProvider;
use Illuminate\Support\ServiceProvider;
use Config\Auth;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//$this->registerAuthDrivers();
        
        
        
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
        
        
        
	}
    
    
    protected function registerAuthDrivers()
    {
        $this->app['auth']->extend('admin', function($app) {
                return new \Illuminate\Auth\Guard( new AdminUserProvider, $app['session.store'] );
            }
        );
    }

}

