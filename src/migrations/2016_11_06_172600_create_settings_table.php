<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;

class CreateSettingsTable extends Migration
{
	public function __construct()
	{
		$this->tablename = Config::get('settings.table');
		$this->user_table = Config::get('settings.users_table');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create($this->tablename, function(Blueprint $table){
			$table->increments('id');
			$table->string('key')->index();
			$table->string('value');
			$table->string('description')->nullable();
			$table->boolean('active')->default(true);
			$table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on($this->user_table);
            $table->unique(['key', 'user_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::drop($this->tablename);
	}
}
