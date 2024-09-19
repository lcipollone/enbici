<?php
	/*
		definición de variables
	*/
	define("SERVER","http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']);
	define("APP_ROOT","http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']."/Baltasar");

	/*
		referencias genéricas
	*/
	include_once(__DIR__.'/db.inc.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/OPDS.DB/mssqldb.php');	// --> si es un servidor mysql, se invoca al archivo 'mysqldb.php'
	include_once(__DIR__ . '/autoload.php');

	/*	ERROR REDIRECT 	*/
	function exception_handler($exception) {
	    /*if($exception instanceof MyException) {
	        echo "MyException error instance\n";

	    }*/
	    $error_message = 
	    				$exception->getMessage().'<br>'.
	    				'Archivo: '.$exception->getFile().'<br>'.
	    				'Línea: '.$exception->getLine().'<br>';
	    $_GET['error_message'] = $error_message;
	    $page_content = APP_ROOT.'/views/error.php?error_message='.urlencode($error_message).'';
	    unset($page_variables);
		$page_jscontent = '<script> jsShowErrors("'.$exception->getMessage().'"); </script>';
		require_once('./../master.php');
	}
	set_exception_handler('exception_handler');

?>