<?php namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use AdminAuth;

use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AdminController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		//$this->middleware('guest', ['except' => 'getLogout']);
	}
    
    public function getLogin() {
    	//echo $this-auth('model');
    	return view('dashboard.login');
    }
    
    public function store(Request $request) {
//        $rules = [
//            'name' => 'required|min:3',
//            'password' => 'required',
//            //'published_at' => 'required|date',
//        ];
//        
//        $this->validate($request, $rules);
// 
//        //Article::create($request->all());
// 
//        return redirect('admin/login');
    }
    
    public function postLogin(Request $request) {
    	$rules = [
            'name' => 'required|min:3',
            'password' => 'required',
            //'published_at' => 'required|date',
        ];
        
        $this->validate($request, $rules); //errorなら自動で$errorが返されてリダイレクト、通過で自動で次の処理へ
        
        $data = $request->all();
        //print_r($data);
        
        if (AdminAuth::attempt(['name' => $data['name'], 'password' => $data['password']]))
        {
        	echo "ddd";
        	return redirect('dashboard');
        }
        else {
        	echo "No varidate";
            $inVarid = true;
            return redirect('admin/login')->withErrors('ユーザー名かパスワードが違います。');
	    }
        
                //return redirect('admin/login');
    	//}
        	
    }
    
    public function getLogout() {
    	AdminAuth::logout();
        return redirect('/');
    }

}

