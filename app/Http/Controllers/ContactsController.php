<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactsController extends Controller{

	/**
	* index page
	*/
	public function index(){
        return view('contacts.index');
	}
}

?>