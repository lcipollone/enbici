// AJAX TRAER EMPRESAS x OPERATORIA

$(document).ready(function() {
    
    var gdEmpresas = null;
    var gdValores = null;

    var navListItems = $('ul.setup-panel li a'),
        allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function(e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this).closest('li');
        
        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });
    
    $('ul.setup-panel li.active a').trigger('click');
    
    // DEMO ONLY //
    $('#siguiente1').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $(this).remove();
    })    

    $('#siguiente2').on('click', function(e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $(this).remove();
    })   

    $('#siguiente3').on('click', function(e) {
        $('ul.setup-panel li:eq(3)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-4"]').trigger('click');
        $(this).remove();
    })  

    // DATEPICKER
    $('#fechaLiquidacion').datepicker({});

    // OPERATORIA
    $('#operatoria').append('<option value="-1"></option>');
    var ops = globvar.find(	function (item) {
								return item.key == "operatorias"; 
							}).value;

    for (var i = 0; i < ops.length; i++) {
    	$('#operatoria').append('<option value="' + ops[i].key + '">' + ops[i].label + '</option>');
    }

    //EMPRESA
    $('#btnSearchEmpresa').on('click', function(e){

        if ($.trim($('#searchEmpresa').val()).length == 0)
        {
            bootbox.alert({
                message: "Debe ingresar algún texto para traer empresas."
            });
            return;
        }

        var postForm = { 
            'method'    : 'getEmpresas',
            'nombre'    : [$('#searchEmpresa').val()]
        };

        //Deshabilitamos el formulario hasta que termine
        $("#liquidarValores").find("fieldset").prop("disabled", true);

        $.ajax({ 
                type        : 'POST', 
                url         : '../ws.request.php?' + Math.random(), 
                data        : postForm,
                dataType    : 'json',
                success     : function(data) {
                                if (!data.success) { 
                                    if (data.errors.length > 0) { 
                                        //$('.throw_error').fadeIn(1000).html(data.errors.name); 
                                        //console.log(data.errors.name);
                                        $('#messageModal').find('#errors').append(data.errors.join());
                                        $('#messageModal').modal('show');
                                    }
                                }
                                else {
                                        //console.log(data.posted.length);
                                        $('#empresa').selectpicker('destroy');
                                        $("#empresa").empty();
                                        if (data.posted){

                                            var valores = [];
                                            for (var i = 0; i < data.posted.length; i++) {
                                                valores[i] = [ data.posted[i].idempresa, data.posted[i].cuit, data.posted[i].nombre, data.posted[i].domicilio, data.posted[i].registronombre ];
                                            }

                                            var options = {
                                                            select: {
                                                                style: 'single'
                                                            },
                                                            iDisplayLength: 10,
                                                            //bPaginate: false,
                                                            bLengthChange: false,
                                                            info: false,
                                                            destroy: true,
                                                            data: valores,
                                                            columns: [
                                                                { title: "idempresa" },
                                                                { title: "Cuit" },
                                                                { title: "Nombre" },
                                                                { title: "Domicilio" },
                                                                { title: "Registro" }
                                                            ],
                                                            "columnDefs": [
                                                                {
                                                                    "targets": [ 0 ],
                                                                    "visible": false,
                                                                    "searchable": false
                                                                }
                                                            ]
                                                        };

                                            gdEmpresas = jsInicializarGrid('#gdEmpresas', options);
                                        }
                                    }
                            },
                error       : function(XMLHttpRequest, textStatus, errorThrown) {
                                //alert(XMLHttpRequest.responseText);
                                $('#messageModal').find('#errors').append(XMLHttpRequest.responseText);
                                $('#messageModal').modal('show');
                            },
            }).done(function(data){
                                $("#liquidarValores").find("fieldset").prop("disabled", false);
                            });
    })

    //onChange llama x ajax
    $('#operatoria').change(function() {
  		var postForm = { 
            'method'    : 'getEmpresas',
            'idOperatoria': [$('#operatoria').val()]
        };

        //Deshabilitamos el formulario hasta que termine
        $("#liquidarValores").find("fieldset").prop("disabled", true);
            postForm = { 
                'method'    : 'getValores',
                'idOperatoria': [$('#operatoria').val()]
            };

            $.ajax({ 
                type        : 'POST', 
                url         : '../ws.request.php?' + Math.random(), 
                data        : postForm,
                dataType    : 'json',
                success     : function(data) {
                                if (!data.success) { 
                                    if (data.errors.length > 0) { 
                                        $('#messageModal').find('#errors').append(data.errors.join());
                                        $('#messageModal').modal('show');
                                    }
                                }
                                else {
                                        var valores = [];
                                        for (var i = 0; i < data.posted.length; i++) {
                                            valores[i] = [ data.posted[i].IDVALOR, data.posted[i].NOMBRE, data.posted[i].CODIMP, data.posted[i].IMPORTE ];
                                        }

                                        var options = {
                                                        select: {
                                                            style: 'single'
                                                        },
                                                        iDisplayLength: 10,
                                                        //bPaginate: false,
                                                        bLengthChange: false,
                                                        info: false,
                                                        destroy: true,
                                                        data: valores,
                                                        columns: [
                                                            { title: "IdValor" },
                                                            { title: "Nombre" },
                                                            { title: "CodImp" },
                                                            { title: "Importe" }
                                                        ],
                                                        "columnDefs": [
                                                            {
                                                                "targets": [ 0 ],
                                                                "visible": false,
                                                                "searchable": false
                                                            }
                                                        ]
                                                    };

                                        gdValores = jsInicializarGrid('#gdValores', options);

                                        $('#gdValores tbody').on( 'click', 'tr', function () {
                                            var oData = gdValores.row( this ).data();
                                            if (oData.length == 0){
                                                return;
                                            }

                                            if (!isNaN(oData[3]) || oData[3] > 0){
                                                var val = oData[3];
                                                $('#importe').val(val);
                                                $('#cantidad').blur();
                                            }
                                        } );
                                    }
                            },
                error       : function(XMLHttpRequest, textStatus, errorThrown) {
                                //alert(XMLHttpRequest.responseText);
                                $('#messageModal').find('#errors').append(XMLHttpRequest.responseText);
                                $('#messageModal').modal('show');
                            },
            }).done(function(data){
                                $("#liquidarValores").find("fieldset").prop("disabled", false);
                            });

        event.preventDefault();
	});

    //EXPEDIENTE
    //$('#expediente').mask('00099-0000099/0099-099');

    $('#searchEmpresa').keydown(function(e){ 
        var code = e.which; // recommended to use e.which, it's normalized across browsers
        if(code==13){
            e.preventDefault();
            $('#btnSearchEmpresa').trigger('click');
        }        
    });

    //VALORES
    $('#cantidad').on('blur', function(e){
        var cantidad = $(this).val(); 
        var importe = $('#importe').val();
        if (cantidad != '' && !isNaN(cantidad) && !isNaN(importe)){
            importe = cantidad * importe;
            $('#importe').val(importe.toFixed(2));
        }
    });

    $('#agregarValor').on('click', function(e){
        if (gdValores == undefined){
            return;
        }
        var oData = gdValores.rows('.selected').data();
        var serie = $('#serie').val();
        var desde = $('#desde').val();
        var hasta = $('#hasta').val();
        var cantidad = $('#cantidad').val();
        var importe = $('#importe').val();

        if (oData.length == 0 || cantidad == "" || importe == "" || isNaN(importe) || parseFloat(importe) == 0)
            return;

        var detalle = 'PU: ' + oData[0][3] + ' - Cant.: ' + cantidad + ' - Importe: $' + importe;

        if (hasta != ''){
            detalle = 'Hasta: ' + hasta + ' - ' + detalle;
        }

        if (desde != ''){
            detalle = 'Desde: ' + desde + ' - ' + detalle;
        }

        if (serie != ''){
            detalle = 'Serie: ' + serie + ' - ' + detalle;
        }

        $('#valoresList').append('<li class="list-group-item detalle">' +
                                    '<div class="checkbox">' +
                                        '<label >' + oData[0][1] +
                                        '</label>' +
                                        '<br/>' +
                                        '<span>' + detalle +  '</span>' +
                                    '</div>' +
                                    '<div class="pull-right action-buttons">'+
                                        '<a href="#" onclick="borrarValor(event)" class="trash remove"><span class="glyphicon glyphicon-trash"></span></a>'+
                                    '</div>'+
                                '</li>');

        //Limpiar los controles y la seleccion de la grilla
        gdValores.rows().deselect();
        $('#serie').val('');
        $('#desde').val('');
        $('#hasta').val('');
        $('#cantidad').val('');
        $('#importe').val('');

    });

    //FORMAS DE PAGO
    var cbFormaPago = $('#formaPago').selectpicker();

    $('#agregarFormaPago').on('click', function(e){
        var formaPago = cbFormaPago.val();
        var importeFormaPago = $('#importeFormaPago').val();
        var formaPagoNroCheque = $('#formaPagoNroCheque').val();
        var formaPagoBanco = $('#formaPagoBanco').val();

        if (formaPago == "-1" || isNaN(importeFormaPago) || importeFormaPago == 0)
            return;
        if (formaPago == 2 && (formaPagoBanco == "" || formaPagoNroCheque == ""))
            return;

        var detalle = cbFormaPago.find("option[value="+ cbFormaPago.val() + "]").text();
        detalle += formaPago == 2 ? ' - Nro: ' + formaPagoNroCheque + ' (' + formaPagoBanco + ')' : '';

        $('#formasPagoList').append('<li class="list-group-item detalle">' +
                                        '<div class="checkbox">' +
                                            '<label > $' + importeFormaPago + 
                                            '</label><br/>' +
                                            '<span>' + detalle + '</span>' +
                                        '</div>'+
                                        '<div class="pull-right action-buttons">'+
                                            '<a id="23" href="#" onclick="borrarFormaPago(event)" class="trash remove"><span class="glyphicon glyphicon-trash"></span></a>'+
                                        '</div>' +
                                    '</li>');

        //Limpiar los controles
        //cbFormaPago.val('');
        $('#importeFormaPago').val('');
        $('#formaPagoNroCheque').val('');
        $('#formaPagoBanco').val('');
    });

    // Validaciones
    $.formUtils.addValidator({
      name : 'operatoria',
      validatorFunction : function(value, $el, config, language, $form) {
        return $('#operatoria').val() != -1;
      },
      errorMessage : 'Debe seleccionar una operatoria.',
      errorMessageKey: 'badEvenNumber'
    });

    $.formUtils.addValidator({
      name : 'empresa',
      validatorFunction : function(value, $el, config, language, $form) {
        return (gdEmpresas != undefined) && gdEmpresas.rows('.selected').count() > 0;
      },
      errorMessage : 'Debe seleccionar una empresa.',
      errorMessageKey: 'emptyEmpresa'
    });

    $.formUtils.addValidator({
      name : 'valores',
      validatorFunction : function(value, $el, config, language, $form) {
        return $('#valoresList').find('li.detalle').length > 0;
      },
      errorMessage : 'Debe agregar valores.',
      errorMessageKey: 'emptyValores'
    });

    $.formUtils.addValidator({
      name : 'formasPago',
      validatorFunction : function(value, $el, config, language, $form) {
        return $('#formasPagoList').find('li.detalle').length > 0;
      },
      errorMessage : 'Debe agregar formas de pago.',
      errorMessageKey: 'emptyFormasPago'
    });

    $.validate({
        validateHiddenInputs: true,
        lang : 'es',
        validateOnBlur : false, // disable validation when input looses focus
        errorMessagePosition : 'top', // Instead of 'inline' which is default
        scrollToTopOnError : false, // Set this property to true on longer forms
        modules : 'location, date, security, file',
        onModulesLoaded : function() {
            //$('#country').suggestCountry();
        }
    });

});