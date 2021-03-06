<?php
// FIX - to include the base OAuth lib not in alphabetical order
require_once( getPath("oauth/helpers/kiss_oauth.php") );

/* Foursquare for KISSCMS */
class Foursquare_OAuth extends KISS_OAuth_v2 {

	function  __construct( $api="foursquare", $url="https://foursquare.com/oauth2" ) {

		$this->url = array(
			'authorize' 		=> $url ."/authenticate",
			'access_token' 		=> $url ."/access_token",
		);

		parent::__construct( $api, $url );

	}

	// - Access a token given a code (GET method)
	function access_token( $params, $request=array() ){

		$request = array(
			"params" => array("grant_type" => "authorization_code")
		);

		parent::access_token($params, $request);

	}

	function save( $response ){

		// erase the existing cache
		//$foursquare = new Foursquare();
		//$foursquare->deleteCache();

		// save to the user session (decode string and produce an array)
		$_SESSION['oauth']['foursquare'] = (array) json_decode($response);

	}

	// Foursquare doesn't send an expiry key... need to customize the check
	function checkToken(){
		//
		return ( empty($_SESSION['oauth'][$this->api]['access_token']) );
	}

}

?>
