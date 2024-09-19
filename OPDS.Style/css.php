<?php
	// ESTA FUNCION TIENE QUE ESTAR EN OTRO LADO PARA USARLA DESDE js.php
	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	$rnd = generateRandomString();

	print 	'<link rel="stylesheet" type="text/css" href="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Render/bootstrap-3.3.7-dist/css/bootstrap.min.css?'.$rnd.'"></link>'.PHP_EOL.
		 	'<link rel="stylesheet" type="text/css" href="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Render/bootstrap-datepicker-1.6.4-dist/css/bootstrap-datepicker.css"></link>'.PHP_EOL.
			'<link rel="stylesheet" type="text/css" href="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Render/bootstrap-select-1.12.2-dist/css/bootstrap-select.min.css?'.$rnd.'"></link>'.PHP_EOL.
			'<link rel="stylesheet" type="text/css" href="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Render/DataTables/datatables.css?'.$rnd.'"></link>'.PHP_EOL;

	//Style drupal
	//print '<link rel="stylesheet" type="text/css" href="http://drupal.opds.gba.gov.ar/sites/all/themes/bootstrap-business/css/style.css?'.$rnd.'"></link>'.PHP_EOL;
	print '<link rel="stylesheet" type="text/css" href="http://drupal.opds.gba.gov.ar/modules/system/system.base.css?'.$rnd.'"></link>'.PHP_EOL;
	print '<link rel="stylesheet" type="text/css" href="http://drupal.opds.gba.gov.ar/modules/system/system.theme.css?'.$rnd.'"></link>'.PHP_EOL.
			'<link rel="stylesheet" type="text/css" href="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Style/master.css?'.$rnd.'"></link>'.PHP_EOL;
?>