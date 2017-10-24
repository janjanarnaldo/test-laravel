<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Session;

class AuthController extends Controller{

	/**
	* Login user
	* 
	* Method: POST
	*/
	public function login(){
		$input = \Input::all();

	$response = \Curl::to(config('f45.login'))
        ->withData([
        	'email' => $input['email'],
        	'password'=> $input['password']
        ])
        ->asJson(true)
        ->post();

        if($response['success']){

        	if($this->franchisee($response['data']['franchisee_id'])){
        		//set session
        		Session::put('user', $response['data']);

        		//redirect to dashboard
        		return Redirect::to('dashboard');
        	}else{
        		$response['errors'] = "Location is not yet approved.";
        	}
        
        	
        }

        return Redirect::back()->withErrors($response['errors']);
	}

	/**
	* Franchisee
	*
	* @param $id (int)
	*/
	public function franchisee($id){
		$response = \Curl::to(config('f45.franchisees').$id)
        ->get();

        if($response){
        	//set session
        	$result = json_decode($response);

        	$data = $result->data;

        	//checks if location is approved from checklist subitems
        	if(strpos($data->status_checklist_subitems, '"1":["0"')){
        		Session::put('franchisee', $data);
        		return true;
        	}
        }

        return false;
	}

	/**
	* Logout user
	* 
	* Method: GET
	*/
	public function logout(){
		Session::forget('user');
		return Redirect::to('/');
	}
}

?>