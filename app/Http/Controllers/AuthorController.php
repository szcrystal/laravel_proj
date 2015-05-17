<?php namespace App\Http\Controllers;

use App\Page;
use App\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AuthorController extends Controller {

	protected $page;
    
    
    public function __construct(Page $page) {
    	
        $this->middleware('admin');
        
        $this->page = $page;
    }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
    	echo "author";
        //$pages = $this -> page -> all();
        $pages = $this -> page->paginate(3); //paginateを入れることで all()が自動取得される。
		return view('dashboard.index') -> with(compact('pages'));
	}
    
//    public function getLogin() {
//    	echo "author pagess";
//    	//return view('dashboard.login');
//    }
    
    public function postLogin() {
    	
    }
    
    public function getCreate() {
    	return view('dashboard.dataform');
    }
    
    public function postCreate(Request $request) {
    
    	$rules = [
            'title' => 'required|min:3',
        ];
        $this->validate($request, $rules);
        

    	$data = $request->all(); //requestから配列として$dataにする
        $this->page->fill($data); //モデルにセット
        $this->page->save(); //モデルからsave
        
        $id = $this->page->id;
        
    	return redirect()->to('dashboard/edit/'."$id");
    }
    
	public function getEdit($id) {
    	$article = $this->page->find($id);
        return view('dashboard.dataform', compact('article'));
    }
    
    public function postEdit(Request $request, $id) {
    	$article = $this->page->find($id);
        $data = $request->all();
        $article->fill($data);
        $article->save();
        
        return redirect()->back();
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
    
	

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
