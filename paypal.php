<?php
require( '.' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'boot.php' );
require_once( MODEL_PATH . 'payment.php' );
class GPage extends WebService
{
    function load( )
    {
        $AppConfig = $GLOBALS['AppConfig'];
        if ( $this->isPost() ) {
            $usedPackage = NULL;
            foreach ( $AppConfig['plus']['packages'] as $package ) {
                if ( $package['name'] == $_POST['PayPal'] ) {
                    $usedPackage = $package;
                }
            }
            $merchant_id = $AppConfig['plus']['payments']['paypal']['merchant_id'];
            $usedPayment = NULL;
            foreach ( $AppConfig['plus']['payments'] as $payment ) {
                if ( $payment['merchant_id'] == $merchant_id ) {
                    $usedPayment = $payment;
                }
            }
            $sub_dom = 'sandbox';
            $req     = 'cmd=_notify-validate';
            foreach ( $_POST as $key => $value ) {
                $value = urlencode( stripslashes( $value ) );
                $req .= "&$key=$value";
            }
            $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
            $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $header .= "Content-Length: " . strlen( $req ) . "\r\n\r\n";
            $fp               = fsockopen( 'ssl://www.paypal.com', 443, $errno, $errstr, 30 );
            $item_name        = $_POST['item_name'];
            $item_number      = $_POST['item_number'];
            $payment_status   = $_POST['payment_status'];
            $payment_amount   = $_POST['mc_gross'];
            $payment_currency = $_POST['mc_currency'];
            $txn_id           = $_POST['txn_id'];
            $receiver_email   = $_POST['receiver_email'];
            $payer_email      = $_POST['payer_email'];
            if ( !$fp ) {
            } else {
                fputs( $fp, $header . $req );
                while ( !feof( $fp ) ) {
                    $res = fgets( $fp, 1024 );
                    if ( strcmp( $res, "VERIFIED" ) == 0 ) {
                        if ( strtoupper( $payment_status ) == 'COMPLETED' ) {
                            if ( $usedPackage != NULL && $usedPayment != NULL ) {
                                $OID        = base64_decode( $_POST['option_selection1'] );
                                $goldNumber = $usedPackage['gold'];
                                $m          = new PaymentModel();
                                $m->incrementPlayerGold( $playerId, $goldNumber );
                                $m->dispose();
                            }
                        }
                    }
                }
                fclose( $fp );
            }
        }
    }
}
$p = new GPage();
$p->run();