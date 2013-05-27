<?php

/**
*
* @   Script Name :   map.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

if ( !defined( 'INSIDE' ) ) {
    die( "Hacking attempt" );
}

class MapModel extends ModelBase {
	function getVillagesMatrix($matrixStr) {
		return $this->provider->fetchResultSet( 'SELECT
				v.id,
				v.rel_x, v.rel_y, v.field_maps_id,
				v.image_num, v.tribe_id, v.player_id, v.alliance_id,
				v.player_name, v.village_name, v.alliance_name,
				v.people_count, v.is_oasis
			FROM
				p_villages v
			WHERE
				v.id IN (%s)', array( $matrixStr ) );
	}

	function getContractsAllianceId($allianceId) {
		return $this->provider->fetchScalar( 'SELECT a.contracts_alliance_id FROM p_alliances a WHERE a.id=%s', array( $allianceId ) );
	}
}

?>
