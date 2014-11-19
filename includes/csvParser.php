<?php
/**
 * csv2array function.
 * 
 * @access public
 * @param mixed $src
 * @param mixed $lineNb
 * @return void
 */
function csv2array ($src, $lineNb) {
	$handle=fopen('data/csv/'.$src,'r');
	$i=0;
	$lineNb=(is_numeric($lineNb) && $lineNb>0)?$lineNb:0;
	$array = array();
	while(($line = fgetcsv($handle)) && ($i<$lineNb || $lineNb==0)) {
		$row= array();
		foreach($line as $value)
			$row[]=$value;
		$array[]=$row;
		$i++;
	}
	fclose($handle);
	return $array;
}
?> 