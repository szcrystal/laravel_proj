<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('price');
            $table->string('type');
            $table->string('plan');
            $table->string('cont1');
            $table->string('cont2');
            $table -> string('cont3');
            $table -> string('imgLink');
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages');
	}

}
