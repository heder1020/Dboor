<?php

/**
*
* @   Script Name :   widget.php
* @   Author      :   NIKO28
* @   Skype       :   nicolo3767
* @   Project     :   DBOOR Full Decoded
*
**/

class Widget extends WebService {
	var $viewFile = null;
	var $layoutViewFile = NULL;

	function printContent() {
		require( VIEW_PATH . $this->viewFile );
	}

	function preRender() {
	}

	function run() {
		$this->load(  );
		$this->preRender(  );

		if ($this->layoutViewFile != NULL) {
			require( VIEW_PATH . $this->layoutViewFile );
		}
		else {
			if ($this->viewFile != NULL) {
				require( VIEW_PATH . $this->viewFile );
			}
		}

		$this->unload(  );
		unset( $this );
	}
}

?>
