<?php
// FIX - force include the Remote API lib if not available...
require_once( getPath("api/helpers/remote_api.php") );

/* LinkedIn for KISSCMS */
class Foursquare extends Remote_API {
	
	private $api;
	private $oauth;
	private $config;
	private $creds;
	private $cache;
	
	function  __construct() {
		// main URL
		$this->api = "https://api.foursquare.com/v2/";
		
		// load all the necessery subclasses
		$this->oauth = new Foursquare_OAuth();
		
		$this->config = $GLOBALS['config']['foursquare'];
		// get/update the creds
		$this->creds = $this->oauth->creds();
		
	}
	
	function request($method='GET', $service="", $params=array() ){
		
		$url = $this->api . $service;
		// add access token
		$params["oauth_token"] = $this->creds["access_token"];
		
		$request = $this->oauth->request($url, $method, $params);
		
		// decode json string as a php object
		$results = json_decode($request);
		// check if the response if valid
		$valid = ( !empty($results['meta']['code']) && $results['meta']['code'] == 200 );
		
		
		var_dump($results);
		
		// log errors...
		
		// just return the repsonse (or the whole response to display error messages
		return ($valid) ? $request['response'] : $request;
		
	}
	
	// REST alias methods
	function  get( $service="", $params=array() ){
		
		// check cache before....
		//...
		$results = $this->request('GET', $service, $params );
		
		return $results;
		
	}
	
	
	function  post( $service="", $params=array() ){
		
		$results = $this->request('POST', $service, $params );
		
		return $results;
		
	}
	
	function  put( $service="", $params=array() ){
		
		$results = $this->request('PUT', $service, $params );
		
		return $results;
		
	}
	
	function  delete( $service="", $params=array() ){
		
		$results = $this->request('DELETE', $service, $params );
		
		return $results;
		
	}
	
}

?>