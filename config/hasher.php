<?php

return [

	/*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
	'enable' => env('ID_HASHING', true),

	/*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
	'column' => 'hash_id',

	/*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
	'padding' => 6,

	/*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
	'security' => [
		/*
	    |--------------------------------------------------------------------------
	    | 
	    |--------------------------------------------------------------------------
	    |
	    | 
	    |
	    */
		'ramdomize' => true,

		/*
	    |--------------------------------------------------------------------------
	    | 
	    |--------------------------------------------------------------------------
	    |
	    | 
	    |
	    */
		'padding' => 4,
	],

	/*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
	'event' => [
		/*
	    |--------------------------------------------------------------------------
	    | 
	    |--------------------------------------------------------------------------
	    |
	    | 
	    |
	    */
		'attach' => 'created',

		/*
	    |--------------------------------------------------------------------------
	    | 
	    |--------------------------------------------------------------------------
	    |
	    | 
	    |
	    */
		'save' => ['created', 'updated']
	]
];