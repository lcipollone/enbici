<?php
	require_once("./application.php");

	$errors = array();
	$form_data = array();
	$flagSuccess = false;

	try {
		switch ($_POST['method']) {
			case 'getEmpresas':
				$result = Valores::getEmpresas($_POST['nombre']);

				break;

			case 'getOperatorias':
				$result = Valores::getOperatorias();

				break;

			case 'getValores':
				$result = Valores::getValores($_POST['idOperatoria']);

				break;

			default:
				# code...
				break;
		}
		//echo "llega";
		$flagSuccess = true;
	} 
	catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}

	$form_data['success'] = $flagSuccess;

	if (isset($result)){
		$form_data['posted'] = $result;
	}

	if (isset($errors)){
		$form_data['errors']  = $errors;
	}

	echo json_encode($form_data);
?>