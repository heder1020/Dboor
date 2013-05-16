<?php

/**
*
* @   Script Name :   webservice.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

class WebService {
	function isPost() {
		return strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post';
	}

	function isCallback() {
		return isset( $_GET['_a1_'] );
	}

	function load() {
	}

	function unload() {
	}

	function run() {
		$this->load(  );
		$this->unload(  );
		unset( $this );
	}

	function redirect($url) {
		$this->unload(  );
		unset( $this );
		header( 'location: ' . $url );
		exit( 0 );
	}
}

?>
