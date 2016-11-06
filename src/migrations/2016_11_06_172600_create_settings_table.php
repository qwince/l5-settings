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
            $table->timestamps();
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
