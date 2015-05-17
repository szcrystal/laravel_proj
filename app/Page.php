<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

    protected $table = "pages"; //不要か？　カスタム名を指定する場合と思う
    
	protected $fillable = ["title", "price", "type", "plan", "cont1", "cont2", "cont3", "imgLink"];

}
