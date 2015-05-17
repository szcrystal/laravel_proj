<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use AdminAuth;

class Admin {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
        //$this->auth->model = 'App\Admin';
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
    	
        
        //echo $this->auth->model;
    
		if (AdminAuth::check()) {
        	echo "AdminAuth Authorized<br />";
            //return redirect('dashboard/create');
			return $next($request);
            //AdminAuth::logout();
            
		}
        else {
        	echo "bbb";
            return redirect('admin/login');
			
		}

		
	}

}

