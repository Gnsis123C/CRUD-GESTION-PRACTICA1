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
        <link href="<?= base_url() ?>static/datapicker/datepicker3.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>static/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
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
        <style>
            #chartdiv {
                width: 100%;
                height: 300px;
            }
            .box-s{
                -webkit-box-shadow: -7px 10px 22px -16px rgba(0,0,0,0.75);
                -moz-box-shadow: -7px 10px 22px -16px rgba(0,0,0,0.75);
                box-shadow: -7px 10px 22px -16px rgba(0,0,0,0.75);
                margin-bottom: 40px;
            }
        </style>
        <!-- Styles -->
        <style>
            #chartdiv2 {
                width: 100%;
                height: 300px;
            }

        </style>
    </head>
    <body>
        <div class="fakeloader" style="display: none;position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; background-color: rgb(255, 255, 255); z-index: 999;"></div>
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
        <section class="container-fluid" id="panel-listar">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row-fluid">
                        <div class="container-fluid">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <h2 class="text-primary" id="title-listar" style="font-size: 20px">
                                    <?= $title ?>
                                </h2>
                            </div>
                            <!--<div class="col-md-6 col-sm-12 col-xs-12"  style="padding-top: 1%" align="right">
                                <h2 class="text-primary" style="font-size: 20px"><a href="#" rel="action" id="pruebaBoton" data-json='{"action": "add","idtipoproc":""}' class="btn btn-success btn-sm sbox">
                                        <i class="glyphicon glyphicon-plus-sign"></i>
                                        Nuevo Registro
                                    </a>
                                </h2>
                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="panelListar">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <section class="">
                                    <div class="panel-body" id="">
                                        <div>
                                            <div class="">
                                                <form id="demo-form2"  autocomplete="off">
                                                    <label for="id-date-range-picker-1">Rango de fecha   </label>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </span>
                                                                <input class="form-control" placeholder="Ingresar rango" value="" type="text" name="fecha" id="fecha" required="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-md-12 col-lg-7 col-xl-7">
                                <section class="panel">
                                    <div class="panel-body" id="">
                                        <table class="table table-bordered" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                                            <thead id="thtabla">
                                            </thead>
                                            <tbody id="tbody">
                                                <tr><td id="colspam" colspan="4" align="center">Ningún dato</td></tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4">
                                                        Total:
                                                    </td>
                                                    <td align="center" id="ingreso_cantidad">
                                                        0
                                                    </td>
                                                    <td align="center" id="ingreso_stock">
                                                        0
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </section>
                            </div>
                            <div class="col-md-12 col-lg-5 col-xl-5">
                                <section class="panel">
                                    <div class="panel-body" id="">
                                        <table class="table table-bordered" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                                            <thead id="thtabla_egreso">
                                            </thead>
                                            <tbody id="tbody_egreso">
                                                <tr><td id="colspam_egreso" colspan="4" align="center">Ningún dato</td></tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4">
                                                        Total:
                                                    </td>
                                                    <td align="center" id="egreso_cantidad">
                                                        0
                                                    </td>
                                                    <td align="center" id="egreso_precio">
                                                        0
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </section>
                            </div>
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
        <script src="<?= base_url() ?>static/moment/moment.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/moment/locale/es.js" type="text/javascript"></script>

        <script src="<?= base_url() ?>static/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Resources -->
        <script>
            $(function () {
                var column = ['N°', 'N° Venta', 'Producto', 'Cantidad', 'Precio', 'Total'];
                var dibujarColumn = '<tr>';
                for (var i in column) {
                    dibujarColumn += '<th>' + column[i] + '</th>';
                }
                $('#colspam').attr('colspan', column.length);
                $('#thtabla').append('<tr><th style="text-align:center" colspan="' + column.length + '">Productos más vendidos</th></tr>' + dibujarColumn);
                /*EGRESO*/
                var column2 = ['N°', 'N° Compras', 'Producto', 'Cantidad', 'Costo', 'Total'];
                var dibujarColumn2 = '<tr>';
                for (var i in column2) {
                    dibujarColumn2 += '<th>' + column2[i] + '</th>';
                }
                $('#colspam_egreso').attr('colspan', column2.length);
                $('#thtabla_egreso').append('<tr><th style="text-align:center" colspan="' + column2.length + '">Productos más comprados</th></tr>' + dibujarColumn2);
                moment.locale('es');
                var tabla = {
                    arr: [],
                    arr2: [],
                    fi: '',
                    ff: '',
                    dibujar: function () {
                        var json = this.arr;
                        var existe = false;
                        var total = 0;
                        var stock = 0;
                        $('#panel-detalle').css('display', 'block');
                        $('#tbody tr').remove();
                        for (var i in json) {
                            var ins = json[i];
                            existe = true;
                            var html = '';
                            html += '<tr>';
                            html += '<td align="center">' + (i * 1 + 1) + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.idventa + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.nombre + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.cantidad + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.precio + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.total + '</td>';
                            html += '</tr>';
                            $('#tbody').append(html);
                            total += parseFloat(ins.total);
                        }
                        $('#ingreso_cantidad ').html('');
                        $('#ingreso_stock ').html('$ '+parseFloat(total).toFixed(2));
                        if (!existe) {
                            $('#tbody').append('<tr><td colspan="' + column.length + '" align="center">Ningún dato</td></tr>');
                            $('#ingreso_cantidad, #ingreso_stock ').html(0);
                        }


                    }, dibujar2: function () {
                        var json = this.arr2;
                        var existe = false;
                        var total = 0;
                        var cantidad = 0;
                        $('#panel-detalle').css('display', 'block');
                        $('#tbody_egreso tr').remove();
                        for (var i in json) {
                            var ins = json[i];
                            existe = true;
                            var html = '';
                            html += '<tr>';
                            html += '<td align="center">' + (i * 1 + 1) + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.idcompra + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.nombre + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.cantidad + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">$ ' + ins.precio + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">$ ' + ins.total + '</td>';
                            html += '</tr>';
                            $('#tbody_egreso').append(html);
                            total += parseFloat(ins.total);
                        }
                        $('#egreso_cantidad ').html('');
                        $('#egreso_precio').html('$ ' + parseFloat(total).toFixed(2));
                        if (!existe) {
                            $('#egreso_precio, #egreso_cantidad ').html(0);
                            $('#tbody_egreso').append('<tr><td colspan="' + column.length + '" align="center">Ningún dato</td></tr>');
                        }


                    },
                    llenarcombo: function () {
                        var json = this.arr;
                        $('#idcompra').find('option').remove();
                        for (var i in json.compra) {
                            var d = json.compra[i];
                            $('#idcompra').append('<option json=\'' + JSON.stringify(d) + '\'  value="' + d.idcompra + '" >PROVEEDOR: ' + d.nombres + ' ' + d.cedularuc + ' / ' + d.fecha + '</option>');
                        }
                    }
                }
                $('input[name=fecha]').daterangepicker({
                    'applyClass': 'btn-xs btn-success',
                    ranges: {
                        'Hoy': [moment(), moment()],
                        'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Los últimos 7 días': [moment().subtract(6, 'days'), moment()],
                        //'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
                        'Este mes': [moment().startOf('month'), moment().endOf('month')],
                        'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }, locale: {
                        format: 'YYYY/MM/DD',
                        cancelLabel: 'Limpiar',
                        applyLabel: 'Aceptar',
                        customRangeLabel: "Abrir Calendario"
                    },
                    startDate: moment(),
                    endDate: moment(),
                    "opens": "right",
                    "cancelClass": "btn-xs btn-danger"
                });
                var fechai = '';
                var fechaf = '';
                $('input[name=fecha]').on('apply.daterangepicker', function (ev, picker) {
                    fechai = picker.startDate.format('YYYY/MM/DD');
                    fechaf = picker.endDate.format('YYYY/MM/DD');
                    $.ajax({
                        'url': '<?= base_url() ?>reporte/mejorproductolist',
                        'type': 'POST',
                        'data': {fi: fechai, ff: fechaf},
                        'dataType': 'json',
                        'timeout': 15000,
                        beforeSend: function () {
                            $('#tbody tr').remove();
                            $('#tbody').append('<tr><td colspan="' + column.length + '" align="center"><i class="fa fa fa-refresh fa-spin"></i> Consultando...</td></tr>');
                            $('#tbody_egreso').append('<tr><td colspan="' + column2.length + '" align="center"><i class="fa fa fa-refresh fa-spin"></i> Consultando...</td></tr>');
                        },
                        success: function (data) {
                            tabla.fi = fechai;
                            tabla.ff = fechaf;
                            tabla.arr = data.venta;
                            tabla.arr2 = data.compra;
                            $('#guardarcomo').prop('disabled', false);
                            //document.getElementById("demo-form2").reset();
                            tabla.dibujar();
                            tabla.dibujar2();
                            $('#form-fecha').css('display', 'none');
                            $('#form-compra').css('display', 'block');
                            return true;
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status === 0) {
                                alert('No estás conectado, verifica tu conección.');
                            } else if (jqXHR.status == 404) {
                                alert('Respuesta, página no existe [504].');
                            } else if (jqXHR.status == 500) {
                                alert('Error interno del servidor [500].');
                            } else if (textStatus === 'parsererror') {
                                alert('Respuesta JSON erróneo.');
                            } else if (textStatus === 'timeout') {
                                alert('Error, tiempo de respuesta.');
                            } else if (textStatus === 'abort') {
                                alert('Respuesta ajax abortada.');
                            } else {
                                alert('Uncaught Error: ' + jqXHR.responseText);
                            }
                        }
                    });
                    return false;
                });
                $('input[name=fecha]').on('cancel.daterangepicker', function (ev, picker) {
                    location.reload();
                    return false;
                });
                $('#demo-form2').keypress(function (e) {
                    if (e.which == 13) {
                        return false;
                    }
                });
                $('#print').click(function () {
                    window.print();
                });
            })
        </script>
    </body>
</html>