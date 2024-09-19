<div class="container">
	<form class="form-horizontal" id="liquidarValores">
		<fieldset >
			<div class="row form-group">
		        <div class="col-xs-12">
		            <ul class="nav nav-pills nav-justified thumbnail setup-panel">
		                <li class="active"><a href="#step-1">
		                    <h4 class="list-group-item-heading">Operatoria</h4>
		                </a></li>
		                <li class="disabled"><a href="#step-2">
		                    <h4 class="list-group-item-heading">Valores</h4>
		                </a></li>
		                <li class="disabled"><a href="#step-3">
		                    <h4 class="list-group-item-heading">Forma de Pago</h4>
		                </a></li>
		                <li class="disabled"><a href="#step-4">
		                    <h4 class="list-group-item-heading">Confirmación</h4>
		                </a></li>
		            </ul>
		        </div>
			</div>
			<div class="row setup-content" id="step-1">
		        <div class="col-xs-12">
		            <div class="col-md-12 well text-center">
		                <div class="form-group">
		                	<label for="operatoria" class="control-label col-md-1">Operatoria</label>
			                <div class="col-md-3">
			                    <select class="form-control input-sm" id="operatoria" name="operatoria" placeholder="Operatoria" data-validation="operatoria" data-validation-error-msg="Debe seleccionar una Operatoria.">
			                    </select>
			                </div>
			                <div class="col-md-6">
			                	<input id="searchEmpresa" type="text" class="form-control input-sm" placeholder="Buscar Empresa" data-validation="empresa" data-validation-error-msg="Debe seleccionar una Empresa." />
			                </div>
			                <div class="col-md-2">
								<button id="btnSearchEmpresa" type="button" class="btn btn-primary btn-sm">Traer Empresas</button>
			                </div>
			            </div>

			            <div class="form-group">
			            	<div class="col-xs-12">
			            		<table id="gdEmpresas" class="mdl-data-table compact" width="100%"></table> <!-- mdl-data-table -->
			            	</div>
			            </div>

			            <hr />

			            <button id="siguiente1" class="btn btn-primary btn-lg pull-right btn-sm">Siguiente</button>
		            </div>
		        </div>
		    </div>
		    
		    <div class="row setup-content" id="step-2">
	            <div class="col-md-12 well">
	                <div class="form-group">
		                <!--<label for="fechaLiquidacion" class="control-label col-xs-2">Fecha de Liquidación</label>
		                <div class="col-xs-4">
							<input id="fechaLiquidacion" type="text" class="form-control" data-validation="required" data-validation-error-msg="Debe ingresar una fecha de liquidación.">
		                </div> -->
		                
		                <label for="expediente" class="control-label col-xs-2">Expediente</label>
		                <div class="col-xs-8">
		                	<div class="col-xs-2">
		                		<input id="expediente" name="expediente" type="text" class="form-control input-sm">
		                	</div>
		                	<div class="col-xs-1">
		                    	<label for="expediente3" class="control-label">-</label>
		                    </div>
		                    <div class="col-md-2">
		                    	<input id="expediente2" type="text" class="form-control input-sm">
		                    </div>
		                    <div class="col-md-1">
		                    	<label for="expediente3" class="control-label">/</label>
		                    </div>
		                    <div class="col-md-2">
		                    	<input id="expediente3" type="text" class="form-control input-sm">
		                    </div>
		                    <div class="col-md-2">
		                    	<label for="expediente3" class="control-label">-</label>
		                    </div>
		                    <div class="col-md-1">
		                    	<input id="expediente4" type="text" class="form-control input-sm">
		                    </div>
		                </div>
		            </div>
		            <hr />

		            <div class="form-group">
		            	<div class="col-md-6">
            				<table id="gdValores" class="mdl-data-table" width="100%"></table>
            			</div>
            			<div class="col-md-6">
            				<ul class="list-group" id="valoresList">
		                        <li class="list-group-item active list-group-item-info">
		                            <div class="checkbox">
		                                    Valores seleccionados
		                            </div>
		                        </li>
	                        </ul>
							<!--<div class="panel panel-default">
								<div class="panel-heading">Resumen</div>
								<div class="panel-body">Panel Content</div>
								
							</div>-->
            			</div>
            			<div class="clearfix">            				
            			</div>
            			<div class="col-md-6">
            				<br/>
	            			<div class="col-md-2">
								<label for="serie">Serie</label><input id="serie" name="serie" type="text" class="form-control input-sm" data-validation="valores" data-validation-error-msg="Debe agregar Valores." >
							</div>
							<div class="col-md-2">
								<label for="serie">Desde</label><input id="desde" name="desde" type="text" class="form-control input-sm" >
							</div>
							<div class="col-md-2">
								<label for="serie">Hasta</label><input id="hasta" name="hasta" type="text" class="form-control input-sm" >
							</div>
							<div class="col-md-2">
								<label for="serie">Cantidad</label><input id="cantidad" name="cantidad" type="text" class="form-control input-sm" >
							</div>
							<div class="col-md-4">
								<label for="serie">Importe</label><input id="importe" name="importe" type="text" class="form-control input-sm" >
								<br/>
								<button id="agregarValor" type="button" class="align-bottom btn btn-primary btn-sm pull-right">Agregar</button>
							</div>
						</div>
            		</div>
					<hr />
        			<button id="siguiente2" class="btn btn-primary btn-lg pull-right btn-sm">Siguiente</button>
	            </div>
		    </div>
		    <div class="row setup-content" id="step-3">
	            <div class="col-md-12 well">
	            	<div class="col-md-6">
        				<label for="formaPago" class="control-label pull-left">Forma de Pago</label>
        				<select class="form-control selectpicker" id="formaPago" name="formaPago" placeholder="Seleccione una opción..." >
        				       	<option value="1">PESOS</option>
		                    	<option value="2">CHEQUE</option>
		                    	<option value="3">CANJE DE VALORES</option>
		                </select>
		                <br/>
            			<label for="formaPagoImporte" class="control-label pull-left">Importe</label><input id="importeFormaPago" name="importeFormaPago" type="text" class="form-control input-sm" data-validation="formasPago" data-validation-error-msg="Debe agregar Formas de Pago.">
            			<label for="formaPagoNroCheque" class="control-label pull-left">Número de Cheque</label>
            			<input id="formaPagoNroCheque" name="importe" type="text" class="form-control input-sm" >
            			<label for="formaPagoBanco" class="control-label pull-left">Banco</label>
            			<input id="formaPagoBanco" name="importe" type="text" class="form-control input-sm" >
            			<br/>
            			<button id="agregarFormaPago" type="button" class="align-bottom btn btn-primary btn-sm pull-right">Agregar</button>
        			</div>
        			<div class="col-md-6"> 
        				<ul class="list-group" id="formasPagoList">
	                        <li class="list-group-item active list-group-item-info">
	                            <div class="checkbox">
	                                    Formas de Pago
	                            </div>
	                        </li>
                        </ul>           				
        			</div>
        			<div class="clearfix">            				
            		</div>
        			<hr />
		            <button id="siguiente3" class="btn btn-primary btn-lg pull-right btn-sm">Siguiente</button>
	            </div>
		    </div>
		    <div class="row setup-content" id="step-4">
		        <div class="col-xs-12">
		            <div class="col-md-12 well">
		                <div class="form-group">
			                <label for="formaPago" class="control-label col-xs-2">Forma de Pago</label>
			                <div class="col-xs-6">
			                    <select class="form-control selectpicker" id="formaPago" placeholder="Seleccione una opción...">
			                    	<option value="1">PESOS</option>
			                    	<option value="2">CHEQUE</option>
			                    	<option value="3">CANJE DE VALORES</option>
			                    </select>
			                </div>
			                <!--<div class="col-xs-6">
			                    <input class="form-control" id="empresa" placeholder="Empresa">
			                </div> -->

			            </div>
			            <hr />
			          	<input type="submit" id="guardar" class="btn btn-success pull-right btn-sm">
		            </div>
		        </div>
		    </div>
		</fieldset>
	</form>
</div>
<?php
	if (isset($formulario))
		echo $formulario;
?>