<?php

//===============================================
// Configuration
//===============================================

// local scope...
function foursquare_init() {

	// schema / defaults
	$config = array(
		"key" => "0000000",
		"secret" => "AAAAAAAAA",
		"client_auth" => 0
	);
	// register config
	if( function_exists("config") ) {
		config("foursquare", $config);
	} elseif( class_exists('Config') && method_exists(new Config(),'register')) {
		// backwards compatibility
		Config::register("foursquare", "key", $config['key']);
		Config::register("foursquare", "secret", $config['secret']);
		Config::register("foursquare", "client_auth", $config['client_auth']);
	}
}

foursquare_init();

?>
