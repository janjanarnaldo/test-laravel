<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use URL;
use Session;

class OrdersController extends Controller{
    /**
    * create page
    */
    public function create(){
        $data['fields'] = array();
        $data['values'] = array();
        $id = Session::get('user')['franchisee_id'];

        // Get order fields
        $response = \Curl::to(URL::to('/').config('f45.order_form_fields'))
        ->get();

        if($response){

            $result = json_decode($response);

            if($result)
               $data['fields'] = $result->fields;
        }

        // Get franchisee details
        $to = str_replace( '{id}', $id, config('f45.franchisee_details') );

        $response = \Curl::to($to)->get();

        if($response){

            $result = json_decode($response);

            if($result)
               $data['franchisee_details'] = $result->data;

            // Fill values
            $data['values']['company_legal_name'] = $data['franchisee_details']->company_name;
            $data['values']['contact_person'] = $data['franchisee_details']->key_person_name;
            $data['values']['tax_id'] = $data['franchisee_details']->abn;
            $data['values']['phone_no'] = Session::get('franchisee')->phone;

        }

        $data['franchisee'] = \Session::get('franchisee');

        // Fill values
        $data['values']['equipment_delivery_address'] = $data['franchisee']->location;
        $data['values']['estimated_studio_opening_date'] = date( 'j F Y' , strtotime($data['franchisee']->expected_opening_on) );

        return view('orders.create', $data);
    }

    /**
    * insert form
    */
    public function insert(){

        $success = false;

        $data = \Input::all();

        $id = \Session::get('user')['franchisee_id'];

        unset($data['_token']);

        //send save
        $submit = \Curl::to(config('f45.orders').$id)
        ->withData($data)
        ->asJson(true)
        ->post();
        
        if($submit['success']){
            $success = true;
        }

        $values['data'] = $data;
        
        return response()->json([
            'success' => $success,
            'errors' => $submit['errors']
        ]);

    }

    /**
    * Success Page
    */
    public function success(){
        return view('orders.success');
    }
}

?>
