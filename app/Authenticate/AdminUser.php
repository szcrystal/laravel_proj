<?php namespace App\Authenticate;
 
//use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Facade;
 
/**
 * Class AdminUser
 * @package App\Authenticate
 */


class AdminUser extends Facade {
    protected static function getFacadeAccessor() { 
    	return 'auth.driver_admin'; 
    }
}

