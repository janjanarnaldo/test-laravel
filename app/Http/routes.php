<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
* Base URL
*/
Route::get('/', function(){

	if(Session::get('user')){
		return Redirect::to('dashboard');
	} else if(isset($_COOKIE['playbooklogin'])) {
        $_COOKIE['playbooklogin'] = json_decode($_COOKIE['playbooklogin'], true);

        //set session
        Session::put('user', $_COOKIE['playbooklogin']);

        $response = \Curl::to(config('f45.franchisees').Session::get('user')['franchisee_id'])->get();

        if($response){
        	//set session
        	$result = json_decode($response);

        	$data = $result->data;

        	//checks if location is approved from checklist subitems
        	if(strpos($data->status_checklist_subitems, '"1":["0"')){
        		Session::put('franchisee', $data);
        	}
        }

        //redirect to dashboard
        return Redirect::to('dashboard');
    }

	return view('login');
});

/**
* Pages
*/
Route::group(['middleware' => 'session'], function () {
	Route::get('dashboard', ['uses'=> 'EquipmentsController@index']);
	Route::get('contact', ['uses' => 'ContactsController@index']);
	Route::get('manuals', ['uses'=> 'ManualsController@index']);
	Route::get('complaints', ['uses'=> 'ComplaintsController@index']);
	Route::get('order', ['uses'=> 'OrdersController@create']);
	Route::get('order/success', ['uses'=> 'OrdersController@success']);
	Route::post('order', ['uses' => 'OrdersController@insert']);
});

/**
* Auth Routes
*/
Route::post('login', ['uses' => 'AuthController@login']);
Route::get('logout', ['uses'=> 'AuthController@logout']);
Route::get('login', function(){
	return Redirect::to('/');
});