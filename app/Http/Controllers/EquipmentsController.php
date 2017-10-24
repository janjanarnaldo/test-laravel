<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class EquipmentsController extends Controller{

	/**
	* index page
	*/
	public function index(){
		$data['equipments'] = array();

		$id = Session::get('user')['franchisee_id'];
		
		$response = \Curl::to(config('f45.equipments').$id)
        ->get();

        if($response){
        	$result = json_decode($response);

        	$data['equipments'] = $result->data;
        }

        return view('equipments.index', $data);
	}
}

?>