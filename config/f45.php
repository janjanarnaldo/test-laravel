<?php

$env = env('APP_ENV');

/**
* API Enviroment
*/
if($env == 'local' || $env == 'staging'){
	// $api = 'http://matrix-staging.f45.info/v1';
	$api = 'http://localhost/matrix/public_html/v1';
}else if($env == 'production'){
	$api = 'http://matrix.f45.info/v1';
}

/**
* Routes for F45 API
*/
return [
	
	/**
	* Auth
	*/
	'login' => $api.'/franchisees/login/',

	/**
	* Franchisees
	*/
	'franchisees' => $api.'/franchisees/',

	/**
	* Equipments
	*/
	'equipments' => $api.'/franchisees/equipments/',

	/**
	* Orders
	*/
	'orders' => $api.'/equipments/forms/order/',

	/**
	* Internal
	*/
	'manuals' => '/json/manuals.json',
	'order_form_fields' => '/json/order-form.json',
	/**
	 * Franchisee Details
	 */
	'franchisee_details' => $api. '/franchisees/edit/{id}/licenses'
];

?>