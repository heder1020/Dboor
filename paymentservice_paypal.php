<?php

/**
*
* @   Script Name :   paymentservice_paypal.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

define( 'INSIDE', true );
require( '.' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'boot.php' );
require_once( MODEL_PATH . 'payment.php' );
require_once( LIB_PATH . 'paypal.class.php' );
class GPage extends WebService {
	function load() {
		$AppConfig = $GLOBALS['AppConfig'];
		$p = new paypal_class(  );
		$m = new PaymentModel(  );

		if (( !isset( $_GET['action'] ) || empty( $_GET['action'] ) )) {
			$_GET['action'] = 'process';
		}

		switch ($_GET['action']) {
		case 'process': {
			}
		}

	}
}

$p = new GPage(  );
$p->run(  );
?>
