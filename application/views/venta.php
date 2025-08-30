<?php $this->load->view('data/sesion'); ?>
<?php $this->load->view('data/typehtml') ?>
<html lang="<?php $this->load->view('data/lang') ?>">
    <head>
        <meta charset="utf-8">
        <title><?= $this->session->userdata('empresa')[0]->nombre ?> | <?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?= base_url() ?>static/img/icono_1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php $this->load->view('data/css') ?>
        <link href="<?= base_url() ?>static/jquery.bootstrap-touchspin/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>static/datapicker/datepicker3.css" rel="stylesheet" type="text/css"/>
        <style>
            #tdetalle > tr > td.middle{
                vertical-align: middle;
            }
            .double-bounce1, .double-bounce2 {
                width: 100%;
                height: 100%;
                border-radius: 50%;
                background-color: black;
                opacity: 0.6;
                position: absolute;
                top: 0;
                left: 0;
                -webkit-animation: bounce 2.0s infinite ease-in-out;
                animation: bounce 1.2s infinite ease-in-out;
            }
            .data-title:before {
                content: attr(data-menutitle);
                display: block;
                position: absolute;
                top: 0;
                right: 0;
                left: 0;
                background-image: linear-gradient(to bottom,#fff 0,#f8f8f8 100%);
                padding: 2px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 9px;
                font-weight: bold;
                text-align: right;
            }
            .data-title :first-child {
                margin-top: 11px;
            }
            .panel-info>.panel-heading,#tabla > thead {
                background-image: linear-gradient(to bottom,#fff 0,#f8f8f8 100%);
                border: 1px solid transparent;
                border-color: #e7e7e7;
            }
            .panel-info {
                border-color: #e7e7e7;
            }
            .select-checkbox{
                background-image: linear-gradient(to bottom,#fff 0,#fff 100%);
                cursor: pointer
            }
            body{
                background-image: linear-gradient(to bottom,#f7f7f7 0,#f7f7f7 100%);
                font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
                font-size: 13px;
                line-height: 1.42857143;
                color: #333;
                background-color: #fff;
            }
            body > div > div.row-fluid > div > ul > li > a{
                color: #000;
                text-decoration: none;
            }
            body > div > div.row-fluid > div > ul > li > a:hover{
                color: #003eff;
            }
            .active_{
                font-weight: bold;
            }
            #tdetalle > tr > td > div > div > ul > li > a.dropdown-2-disabled {
                color: #bbb;
                cursor: no-drop;
                background-color: #fff;
            }
            #tdetalle > tr > td > div > div > ul > li > a.dropdown-2-disabled:enabled {
                color: #bbb;
                background-color: #fff;
                background: #fff;
            }
            .btn-default {
                text-shadow: rgb(255, 255, 255) 0px 1px 0px;
                background-image: none;
                background-repeat: repeat-x;
                border-color: rgb(204, 204, 204);
            }
            .form-control-feedback {
                position: absolute;
                top: 0px;
                right: 0;
                z-index: 2;
                display: block;
                width: 34px;
                height: 34px;
                line-height: 34px;
                text-align: center;
                pointer-events: none;
            }
        </style>
    </head>
    <body>
        <header>
            <?php $this->load->view('data/nav'); ?>
        </header>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <ul class="breadcrumb" style="background: #fff;">
                        <li>
                            <a href="<?= base_url() ?>">Inicio</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <section class="container" id="panel-listar">
            <div class="ibox-content" id="panelListar">
                <div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6 col-xl-8">
                            <section class="panel panel-default">
                                <header style="border-radius: 0px" class="panel-heading">
                                    <h2 class="panel-title">Cabecera <?= $title ?></h2>
                                </header>
                                <div style="border-radius: 0px" class="panel-body">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-6 col-xl-6">
                                                <select id="idcliente" class="form-control">
                                                    <option value="">Seleccionar Cliente</option>
                                                    <?php foreach ($idclienteproveedor as $x): if ($x->tipo == '1') {//clientes ?>
                                                            <option value="<?= $x->idclienteproveedor ?>"><?= $x->cedularuc ?> - <?= $x->nombre ?> <?= $x->apellido ?> </option>
                                                        <?php } endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-12 col-lg-6 col-xl-6">
                                                <input placeholder="Ingresar Fecha" type="text" value="<?= $fecha ?>" id="fecha" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <section class="panel panel-default">
                                <header style="border-radius: 0px" class="panel-heading">
                                    <p class="panel-subtitle">Detalle <?= $title ?></p>
                                </header>
                                <div style="border-radius: 0px" class="panel-body">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-3 col-xl-4 form-group">
                                                <label class="control-label">Producto</label>
                                                <select id="idinventario" data-plugin-selectTwo class="form-control">
                                                    <option valor="0" idproducto="" cantidad="0" restante="0" value="">Seleccionar Producto</option>
                                                    <?php
                                                    for ($i = 0; $i < count($idproducto); $i++) {
                                                        if ($idproducto[$i]['estado'] == '1' && $idproducto[$i]['cantidad'] != 0) {
                                                            ?>
                                                            <option valor="<?= $idproducto[$i]['precio'] ?>" idproducto="<?= $idproducto[$i]['idproducto'] ?>" cantidad="<?= $idproducto[$i]['cantidad'] == null ? 0 : $idproducto[$i]['cantidad'] ?>" restante="<?= $idproducto[$i]['stock'] == null ? 0 : $idproducto[$i]['stock'] ?>" value="<?= $idproducto[$i]['idproducto'] ?>"><?= $idproducto[$i]['nombre'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-12 col-lg-3 col-xl-3 form-group">
                                                <label class="control-label">Cantidad</label>
                                                <input type="text" class="form-control" id="cantidad">
                                            </div>
                                            <div class="col-md-12 col-lg-3 col-xl-3 form-group">
                                                <label class="control-label">Precio</label>
                                                <input type="text" class="form-control" id="valor">
                                            </div>
                                            <div class="col-md-12 col-lg-3 col-xl-3 form-group">
                                                <label class="control-label">Agregar</label>
                                                <button id="guardar" class=" btn btn-primary btn-block"><i class="fa fa-plus"></i> Agregar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">

                                        <table class="table table-bordered mb-none">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Acción</th>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Valor</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_detalle">
                                                <tr>
                                                    <td colspan="6" align="center">No hay datos a mostrar</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td style="vertical-align: middle" colspan="5" align="center"><b>Total</b></td>
                                                    <td align="center"><h4 id="total_cv">0</h4></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </section>
                            <button type="button" id="guardarpla" class="pull-right mb-xs mt-xs mr-xs btn btn-lg btn-default">
                                <i class="fa fa-save"></i> Guardar Venta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <br>
        <br>
        <footer style="">
            <?php $this->load->view('data/footer'); ?>
        </footer>
        <?php $this->load->view('data/js'); ?>
        <script src="<?= base_url() ?>static/plugin/cedulayruc.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/jquery.bootstrap-touchspin/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/datapicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/locales/bootstrap-datepicker.es.min.js" type="text/javascript"></script>
        <!-- Fecha -->
        <script>
            $(function () {
                $('#fecha').datepicker({
                    language: "es",
                    format: "yyyy-mm-dd",
                    startDate: "2017-01-01",
                    endDate: "2030-01-01",
                    firstDay: 1,
                    numberOfMonths: 1,
                    daysOfWeekDisabled: "0,6",
                });
                $("#cantidad").TouchSpin({
                    buttondown_class: 'btn btn-white',
                    buttonup_class: 'btn btn-white',
                    min: 0,
                    max: 100000,
                    step: 1,
                    decimals: 0,
                    boostat: 5,
                    maxboostedstep: 10,
                    postfix: 'N°',
                    verticalbuttons: true
                });
                $("#valor").TouchSpin({
                    buttondown_class: 'btn btn-white',
                    buttonup_class: 'btn btn-white',
                    min: 0.01,
                    max: 100000,
                    step: 0.1,
                    decimals: 2,
                    boostat: 5,
                    maxboostedstep: 10,
                    postfix: '$',
                    verticalbuttons: true
                });
                var planificacion = {
                    idclienteproveedor: 0,
                    observacion: '',
                    fecha: '',
                    detplanificacion: [],
                    idlote: 1
                }

                var tabla = {
                    listDetalle: [],
                    existe: function (detalle) {
                        for (var i in this.listDetalle) {
                            if (this.listDetalle[i].idinventario === detalle.idinventario) {
                                if (this.listDetalle[i].idtipo === detalle.idtipo) {
                                    this.listDetalle[i].cantidad = parseInt(this.listDetalle[i].cantidad) + parseInt(detalle.cantidad);
                                    this.listDetalle[i].valor = parseFloat(detalle.valor);
                                    var restante = (parseInt(this.listDetalle[i].restante) - (detalle.cantidad));
                                    $('#cantidad').trigger("touchspin.updatesettings", {max: (restante)});
                                    $('#cantidad').attr('placeholder', 'Max: ' + (restante));
                                    $('#cantidad').val('');
                                    this.listDetalle[i].restante = restante;
                                    (this.listDetalle[i].idinventarioLabel).attr('restante', restante);
                                    return true;
                                }
                            }
                        }
                        var restante = (parseInt(detalle.restante) - (detalle.cantidad));
                        $('#cantidad').trigger("touchspin.updatesettings", {max: (restante)});
                        $('#cantidad').attr('placeholder', 'Max: ' + (restante));
                        $('#cantidad').val('');
                        detalle.restante = restante;
                        (detalle.idinventarioLabel).attr('restante', restante);
                        return false;
                    },
                    add: function (detalle) {
                        if (!this.existe(detalle)) {
                            this.listDetalle.push(detalle);
                        }
                    },
                    id: function () {
                        return parseInt(this.listDetalle.length) + 1;
                    },
                    listardetalle: function () {
                        //tbody_cabecera
                        var total_cv = 0;
                        $('#tbody_detalle tr').remove();
                        for (var i in this.listDetalle) {
                            var ins = this.listDetalle[i];
                            var html = '';
                            html += '<tr>';
                            html += '<td align="center">' + (parseInt(i) + 1) + '</td>';
                            html += "<td align='center'><button type='button' class='btn btn-danger deletes btn-sm' value='" + ins.id + "'><i class='fa fa-trash-o'></i></button></td>";
                            html += '<td align="center">' + ins.idinventarioText + '</td>';
                            //html += '<td align="center">' + (ins.tipo == 'H' ? tabla.buscarherramienta(ins.idrecurso) : tabla.buscarpersonal(ins.idrecurso)) + '</td>';
                            html += '<td align="center">' + ins.cantidad + '</td>';
                            html += '<td align="center">' + ins.valor + '</td>';
                            html += '<td align="center">' + (parseFloat(ins.cantidad) * parseFloat(ins.valor)).toFixed(2) + '</td>';
                            html += '</tr>';
                            total_cv = total_cv + (parseFloat(ins.cantidad) * parseFloat(ins.valor));
                            $('#tbody_detalle').append(html);
                        }
                        if (this.listDetalle.length > 0) {
                            $('#guardar').prop('disabled', false);
                            $('#total_cv').html(total_cv.toFixed(2));
                        } else {
                            //$('#guardar').prop('disabled', true)
                            $('#tbody_detalle').append('<tr><td colspan="7" align="center">Ningún dato</td></tr>');
                            $('#total_cv').html(0);
                        }

                    },
                    elim: function (id) {
                        for (var i in this.listDetalle) {
                            if (this.listDetalle[i].id == id) {
                                var restante = (parseInt(this.listDetalle[i].restante) + parseInt(this.listDetalle[i].cantidad));
                                $('#cantidad').trigger("touchspin.updatesettings", {max: (restante)});
                                $('#cantidad').attr('placeholder', 'Max: ' + (restante));
                                $('#cantidad').val('');
                                this.listDetalle[i].restante = restante;
                                (this.listDetalle[i].idinventarioLabel).attr('restante', restante);
                                this.listDetalle.splice(i, 1);
                                this.listardetalle();
                                return true;
                            }
                        }
                    },
                    guardar: function () {
                        return $.ajax({
                            url: '<?= base_url() ?>venta/crear',
                            type: 'POST',
                            data: {id: '0', 'action': 'add', 'planificacion': JSON.stringify(planificacion)},
                            dataType: 'JSON',
                            beforeSend: function () {
                                $('.row').find('input, textarea, button, select').prop('disabled', true);
                                $('#guardarpla').html('<i class="fa fa-refresh fa-spin"></i> Espere');
                            }
                        });
                    }
                }
                $('#tbody_detalle').on('click', 'button.deletes', function () {
                    var id = $(this).val();
                    //alert($(this).val());
                    if (confirm('¿Desea eliminar?')) {
                        if (!tabla.elim(id)) {
                            alert('Error al eliminar');
                        }
                    }
                });
                $('#guardar').click(function () {
                    //if (tabla.listDetalle.length > 0) {
                    var cantidad = $('#cantidad').val();
                    var valor = $('#valor').val();
                    var iddevolucion = '1';
                    var idinventario = $('#idinventario').val();
                    var iddevolucionText = '';
                    var idinventarioText = $('#idinventario option:selected').text();
                    var idinventarioLabel = $('#idinventario option:selected');
                    var restante = $('#idinventario option:selected').attr('restante');//$('#cantidad').trigger("touchspin.updatesettings", {max: (cant)});
                    var idinv = $('#idinventario option:selected').attr('idinventario');
                    if (!isNaN(parseInt(cantidad))) {
                        if (idinventario != '' && iddevolucion != '') {
                            var data = {
                                'cantidad': cantidad,
                                'id': tabla.id(),
                                'idtipo': iddevolucion,
                                'idinventario': idinventario,
                                'valor': valor,
                                'iddevolucionText': iddevolucionText,
                                'idinventarioText': idinventarioText,
                                'restante': restante,
                                'idinventarioLabel': idinventarioLabel,
                                'idinv': idinv
                            }
                            tabla.add(data);
                            tabla.listardetalle();
                        } else {
                            alert('Error!!'
                                    + 'Debe ingresar un invent.');
                        }
                    } else {
                        alert('Error!!' + 'Cantidad posee un error');
                    }
                });
                $('#idinventario').change(function () {
                    var restante = $('#idinventario option:selected').attr('restante');
                    $('#cantidad').attr('placeholder', 'Max: ' + (typeof (restante) == 'undefined' ? 0 : restante));
                    $('#cantidad').trigger("touchspin.updatesettings", {max: (typeof (restante) == 'undefined' ? 0 : restante)});

                    var valor = $('#idinventario option:selected').attr('valor');
                    $('#valor').trigger("touchspin.updatesettings", {max: (valor)});
                    $('#valor').attr('placeholder', 'Max: $ ' + (valor));

                    $('#valor').val(valor);
                })
                $('#guardarpla').click(function () {
                    //if (tabla.listDetalle.length > 0) {
                    var fecha = $('#fecha').val();
                    if (fecha != '') {
                        if (tabla.id() > 1) {
                            planificacion.fecha = fecha;
                            planificacion.idclienteproveedor = $('#idcliente').val();
                            planificacion.detplanificacion = tabla.listDetalle;
                            if(planificacion.idclienteproveedor!=''){
                                tabla.guardar().done(function (data) {
                                $('.row').find('input, textarea, button, select').prop('disabled', false);
                                $('#guardarpla').html('<i class="fa fa-save"></i> Guardar Compra');
                                alert('Salvado!!' + 'Tus datos fueron guardados');
                                if (confirm('¿Desea descargar en pdf la venta?')) {
                                    window.location = '<?= base_url() ?>venta/factura?idventa=' + data.idventa + '&fecha=' + $('#fecha').val();
                                } else {
                                    location.reload();
                                }
                                //location.reload();
                                return;
                            }).fail(function () {
                                alert('Error!!' + 'Tus datos no fueron guardados');
                            });
                            }else{
                            alert('Error, falta de elegir un cliente')
                            }
                            
                        } else {
                            alert('Error!!' + 'Falta Detalle');
                        }
                    } else {
                        alert('Error!!' + 'Falta fecha');
                    }
                })
            }
            )
        </script>
    </body>
</html>