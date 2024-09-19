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

	print 	'<script src="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Render/jquery-1.12.4.js?'.$rnd.'"></script>'.PHP_EOL.
			'<script src="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Render/globals.js?'.$rnd.'"></script>'.PHP_EOL.
			'<script src="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Render/bootstrap-3.3.7-dist/js/bootstrap.min.js?'.$rnd.'"></script>'.PHP_EOL.
			//Hay que condicionar los siguientes links dependiendo si usan o no los controles!!!!
			'<script src="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Render/bootstrap-datepicker-1.6.4-dist/js/bootstrap-datepicker.min.js?'.$rnd.'"></script>'.PHP_EOL.
			'<script src="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Render/bootstrap-datepicker-1.6.4-dist/locales/bootstrap-datepicker.ar.min.js?'.$rnd.'" charset="UTF-8"></script>'.PHP_EOL.
			//Bootstrap-select
			'<script src="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Render/bootstrap-select-1.12.2-dist/js/bootstrap-select.min.js?'.$rnd.'"></script>'.PHP_EOL.
			'<script src="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Render/jquery-form-validator-2.3.26-dist/jquery.form-validator.min.js?'.$rnd.'"></script>'.PHP_EOL.
			//Mask
			'<script src="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Render/jquery-mask-plugin-1.14.11-dist/jquery.mask.min.js?'.$rnd.'"></script>'.PHP_EOL.
			//DataTable
			'<script src="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Render/DataTables/datatables.min.js?'.$rnd.'"></script>'.PHP_EOL.
			//bootbox.js (Alert)
			'<script src="http://'.$_SERVER["SERVER_NAME"].'/OPDS.Render/bootboxjs/bootbox.min.js?'.$rnd.'"></script>'.PHP_EOL;

	/*	Document.Ready */
	print 	'<script>
            	bootbox.setDefaults({locale: "es", closeButton: true});
				var globvar = [];
				jQuery(document).ready(function($) { 
					$(window).scroll(function() {
						if($(this).scrollTop() != 0) {
							$("#toTop").fadeIn();	
						} else {
							$("#toTop").fadeOut();
						}
					});
					
					$("#toTop").click(function() {
						$("body,html").animate({scrollTop:0},800);
					});	
				});
			</script>';
?>