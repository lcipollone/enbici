<?php 
	// Funcionalidad de la aplicación
?>
<html  lang="en">
	<head>
		<meta charset="utf-8">
		<title>OPDS - Baltasar</title>
		<link rel="shortcut icon" href="http://drupal.opds.gba.gov.ar/sites/default/files/favicon_2.ico" type="image/vnd.microsoft.icon">
	    <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->

	    <!-- LINKS a Resources\*.css -->
		<?php 
			require_once(SERVER.'/OPDS.Style/css.php');

			if (isset($page_csscontent)){
				echo $page_csscontent;
			}
		?>
	</head>
	<body>
		<header id="header" role="banner" class="clearfix hidden-xs">
		    <div class="container">
		        <!-- #header-inside -->
		        <div id="header-inside" class="clearfix">
		            <div class="container">
		                <div class="col-md-12">               
		                	<div id="logo" class="">
		                		<a href="/" title="Inicio" rel="inicio"> 
		                			<img src ="http://drupal.opds.gba.gov.ar/sites/all/themes/bootstrap-business/logo_gba.svg" alt="Inicio">
		             			</a>
		                	</div>
		                </div>
		            </div>
		        </div>
		        <!-- EOF: #header-inside -->
		    </div>
		</header>
		<!-- Modal para errores-->
		<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <span aria-hidden="true">&times;</span>
		                </button>
		                <h5 class="modal-title">Error!!</h5>
		            </div>

		            <div class="modal-body">
		                <!-- The messages container -->
		                <div id="errors" class="alert alert-danger"></div>
		            </div>

		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		            </div>
		        </div>
		    </div>
		</div>

		<!-- Modal para alert/warnings -->
		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		  <div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content">
		      ...
		    </div>
		  </div>
		</div>

		<div class="main-navigator">
			<?php 
				include(APP_ROOT.'/views/menu/menu.view.php');
			?>
		</div>
		<div class="container-fluid">
			<?php 
				if (isset($page_breadcrumb))
					echo $page_breadcrumb;

				if (isset($page_content))
					include($page_content);
			?>
		</div>
		<div>
			<?php 
				include(APP_ROOT.'/views/footer.php');
			?>
		</div>
		<!-- LINKS a Resources\*.js -->
		<?php
			require_once(SERVER.'/OPDS.Render/js.php');

			if (isset($page_variables))
				echo $page_variables;
			
			if (isset($page_jscontent)){
				echo $page_jscontent;
			}
		?>
	</body>
</html>