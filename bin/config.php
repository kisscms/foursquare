<?php


//===============================================
// Configuration
//===============================================

if( class_exists('Config') && method_exists(new Config(),'register')){ 

	// Register variables
	Config::register("foursquare", "key", "0000000");
	Config::register("foursquare", "secret", "AAAAAAAAA");
	Config::register("foursquare", "client_auth", 0);

}

?>