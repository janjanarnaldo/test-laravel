<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use URL;

class ManualsController extends Controller{

	/**
	* index page
	*/
	public function index(){
        $data['manuals'] = array();

        $response = \Curl::to(URL::to('/').config('f45.manuals'))
        ->get();

        if($response){
        	$result = json_decode($response);

        	$data['manuals'] = $result->manual;
        }

       	return view('manuals.index', $data);
	}
}

?>