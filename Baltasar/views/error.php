<?php
	require_once('./../application.php');
	echo 
	'<div class="form-error alert alert-danger">
		<strong>Ocurrió el siguiente error:</strong>
		<ul>
			<li>'.$_GET['error_message'].'</li>
		</ul>
	</div>';
?>