<?php

/**
*
* @   Script Name :   wordsfilter.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

if ( !defined( 'INSIDE' ) ) {
    die( "Hacking attempt" );
}

class FilterWordsModel extends ModelBase {
	function FilterWords($text = '', $replace = '***') {
		$patterns = array( '/([A-Z0-9._%+-]+)@([A-Z0-9.-]+)\.([A-Z]{2,4})(\((.+?)\))?/i', '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i' );
		$badwor = $this->provider->fetchResultSet( 'SELECT * FROM `g_words`' );

		while ($badwor->next(  )) {
			$patterns[] = sprintf( '/(?<!\pL)(%s)(?!\pL)/u', $badwor->row['word'] );
		}

		return preg_replace( $patterns, $replace, $text );
	}
}

?>
