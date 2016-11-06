<?php
return array(
	// which type of store to use.
	// valid options: 'json', 'database'
	//'store' => 'json',

	// if the json store is used, give the full path to the .json file
	// that the store writes to.
	//'path' => storage_path().'/settings.json',

	// If the database store is used, you can set which connection to use. if
	// set to null, the default connection will be used.
	//'connection' => null,

	/*
    |--------------------------------------------------------------------------
    | Application User Model
    |--------------------------------------------------------------------------
    |
    | This is the User model used by Entrust to create correct relations.
    | Update the User if it is in a different namespace.
    |
    */
    'user' => 'App\User',
    /*
    |--------------------------------------------------------------------------
    | Application Users Table
    |--------------------------------------------------------------------------
    |
    | This is the users table used by the application to save users to the
    | database.
    |
    */
    'users_table' => 'users',
);
