<?php
if ( !defined( 'INSIDE' ) ) {
    die( "Hacking attempt" );
}
error_reporting( E_ALL );
date_default_timezone_set( 'Europe/Rome' );
$AppConfig = array(
     'db' => array(
         'host' => 'localhost',
        'user' => 'niko28',
        'password' => '',
        'database' => 'my_niko28' 
    ),
    'Game' => array(
         'speed' => '50',
        'attack' => '20',
        'capacity' => '10',
        'carry' => '10',
        'cranny' => '10',
        'market' => '10' 
    ),
    'page' => array(
         'ar_title' => 'TravWar',
        'en_title' => 'TravWar',
        'meta-tag' => '',
        'asset_version' => 'c4b7aaaadef' 
    ),
    'system' => array(
         'lang' => 'en',
        'facebook_url' => 'https://www.facebook.com/traviannews',
        'forum_url' => '',
        'social_url' => '#',
        'adminName' => 'Admin',
        'adminPassword' => 'pass',
        'admin_email' => 'admin@niko28.it',
        'email' => 'register@niko28.it',
        'installkey' => 'installgame',
        'calltatar' => 'intalltatar' 
    ),
    'game' => array(
         'truce' => false,
        'truce_text' => 'Truce: 30.12.11 11:00 - 01.01.12 11:00',
        'rockets' => false 
    ),
    'plus' => array(
         'packages' => array(
             array(
                 'name' => 'Package A',
                'gold' => 30,
                'cost' => 1.99,
                'currency' => 'EUR',
                'image' => 'package_a.jpg' 
            ),
            array(
                 'name' => 'Package B',
                'gold' => 100,
                'cost' => 4.99,
                'currency' => 'EUR',
                'image' => 'package_b.jpg' 
            ),
            array(
                 'name' => 'Package C',
                'gold' => 250,
                'cost' => 9.99,
                'currency' => 'EUR',
                'image' => 'package_c.jpg' 
            ),
            array(
                 'name' => 'Package D',
                'gold' => 600,
                'cost' => 19.99,
                'currency' => 'EUR',
                'image' => 'package_d.jpg' 
            ) 
        ),
        'payments' => array(
             'paypal' => array(
                 'testMode' => false,
                'name' => 'PayPal',
                'image' => 'paypal_solution_graphic-US.gif',
                'merchant_id' => 'yourmail@gmail.com',
                'currency' => 'EUR' 
            ) 
        ) 
    ) 
);
?>