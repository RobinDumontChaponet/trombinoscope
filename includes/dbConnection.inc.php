<?php

function connect ($dns) {
	try {
		$connection = new PDO( $dns, 'dumont28u_appli', 'APPLIwepek7ombawpegyean', array(
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		return $connection;
	} catch ( Exception $e ) {
		echo "Connection à MySQL impossible : ", $e->getMessage();
	}
}

?>