<?php

// FIX - force include the base class
require_once( getPath("api/helpers/rest_service.php") );

// load the data of a file or user...
class Foursquare_Data extends REST_Service {
	
	function __construct($controller_path,$web_folder,$default_controller,$default_function)  {
		
		// main objects
		$this->api['foursquare'] = new Foursquare();
		
		// continue to the default setup
		parent::__construct($controller_path,$web_folder,$default_controller,$default_function);
		
	}
	
	function index( $params ) {
		// get the path 
		$path =  str_replace(WEB_FOLDER."index.php/data/", "", $_SERVER['PHP_SELF']);
		// pop the first pair in the params (if array)
		if( is_array($params) ) array_shift( $params );
		
		$method = $_SERVER['REQUEST_METHOD'];
		
		$this->data = $this->api['foursquare']->{$method}( $path, $params );
		
		$this->render();
		
	}
	
}

?>
