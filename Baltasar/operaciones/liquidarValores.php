<?php
	require_once("./../application.php");
	/*try
	{*/
		$page_content = APP_ROOT.'/views/operaciones/liquidarValores.view.php';

		$page_breadcrumb =	'<ol class="breadcrumb brand-success">'.PHP_EOL.
								'<li>Operaciones</li>'.PHP_EOL.
	  							'<li class="active">Liquidar Valores</li>'.PHP_EOL.
							'</ol>';

		$page_variables = '<script>';

		// getOperatorias
		$result = Valores::getOperatorias();
		if (!isset($result)){
			throw new Exception('Faltan operatorias.');
		}
		$opts = '';
		
		foreach ($result as $row) {
	        $opts .= '{ "key": "' . $row['IdOperatoria'] . '" , "label": "' . $row['Nombre'] . '"}, ';
	    }

		$page_variables .= '	operatorias = {"key": "operatorias", "value": [' . $opts . ']};';

		$page_variables .= ' globvar.push(operatorias); ';

		// getEmpresas
		/*$result = Valores::getEmpresas();
		if (!isset($result)){
			throw new Exception('Faltan empresas.');
		}
		$opts = '';
		
		foreach ($result as $row) {
	        $opts .= '{ "key": "' . $row['IdEmpresa'] . '" , "label": "' . $row['Nombre'] . '"}, ';
	    }

		$page_variables .= '	operatorias = {"key": "operatorias", "value": [' . $opts . ']};';

		$page_variables .= ' globvar.push(operatorias); ';*/

		$page_variables .= '</script>';

		$page_jscontent = '<script src="'.APP_ROOT.'/resources/js/liquidarValores.js"></script>';

		$page_jscontent .= '<script>    
								function borrarValor(e){
									e.preventDefault();
									$(e.target).closest("li").remove();
									return false;
								}

								function borrarFormaPago(e){
									e.preventDefault();
									$(e.target).closest("li").remove();
									return false;
								}
							</script>';

		$page_csscontent = '<link rel="stylesheet" type="text/css" href="'.APP_ROOT.'/resources/css/liquidarValores.css"></link>';
	/*}
	catch(Exception $e) {
		$error_message = $e->getMessage();
		//$page_variables = '<script> error_messages = '.$error_message.'; </script>';
		unset($page_variables);
		$page_jscontent = '<script> jsShowErrors("'.$error_message.'"); </script>';
	}*/

	require_once('./../master.php');
?>