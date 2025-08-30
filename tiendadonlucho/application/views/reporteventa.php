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
        <link href="<?= base_url() ?>static/select2-3.5.3/select2.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>static/select2-3.5.3/select2-bootstrap.css" rel="stylesheet" type="text/css"/>
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


                                                    <label for="id-date-range-picker-1">   <?= (isset($_GET['fi']) ? ' | Mostrando.. ' . ($_GET['fi'] . ' - ' . $_GET['ff']) : '') ?></label>
                                                    <div class="form-group row">
                                                        <div class="col-md-7">
                                                            <div class="input-group">
                                                                <div class="input-group-btn">
                                                                    <select id="anio" class="form-control" multiple="">
                                                                        <?php for ($i = 1995; $i < 2050; $i++) { ?>
                                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="input-group-btn">
                                                                    <select id="mes" class="form-control" multiple="">
                                                                        <option value="1">Enero</option>
                                                                        <option value="2">Febrero</option>
                                                                        <option value="3">Marzo</option>
                                                                        <option value="4">Abril</option>
                                                                        <option value="5">Mayo</option>
                                                                        <option value="6">Junio</option>
                                                                        <option value="7">Julio</option>
                                                                        <option value="8">Agosto</option>
                                                                        <option value="9">Septiembre</option>
                                                                        <option value="10">Octubre</option>
                                                                        <option value="11">Noviembre</option>
                                                                        <option value="12">Diciembre</option>
                                                                    </select>
                                                                </div>

                                                                <div class="input-group-btn">
                                                                    <button type="button" id="buscar" class="btn btn-default"><i class="fa fa-search"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <?php if (isset($_GET['anio']) && isset($_GET['mes'])) { ?>
                                <div class="col-md-12 col-lg-6 col-xl-12">
                                    <div id="chartdiv"></div>
                                </div>
                            <?php } ?>

                            <div class="col-md-12 col-lg-6 col-xl-12">
                                <section class="">
                                    <div class="" id="">
                                        <table class="table table-bordered" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                                            <thead id="thtabla">
                                            </thead>
                                            <tbody id="tbody">
                                                <tr><td id="colspam" colspan="4" align="center">Ningún dato</td></tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5">
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
        <section class="container-fluid" style="display: none" id="panel-form">
            <div class="col-md-8 col-md-offset-2">
                <?php $this->load->view('data/form/' . $nameform); ?>
            </div>
        </section>
        <?php $this->load->view('data/js'); ?>
        <script src="<?= base_url() ?>static/plugin/cedulayruc.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/jquery.bootstrap-touchspin/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/datapicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/locales/bootstrap-datepicker.es.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/moment/moment.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/moment/locale/es.js" type="text/javascript"></script>

        <script src="<?= base_url() ?>static/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/select2-3.5.3/select2.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/select2-3.5.3/select2_locale_es.js" type="text/javascript"></script>
        <!-- Resources -->
        <!-- Resources -->
        <script src="https://www.amcharts.com/lib/4/core.js"></script>
        <script src="https://www.amcharts.com/lib/4/charts.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
        <?php if (isset($_GET['anio']) && isset($_GET['mes'])) { ?>
            <script>
                am4core.ready(function () {

    // Themes begin
                    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
                    var chart = am4core.create("chartdiv", am4charts.XYChart);

    // Export
                    chart.exporting.menu = new am4core.ExportMenu();

    // Data for both series
                    var data = <?= json_encode($sql2) ?>;

                    /* Create axes */
                    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                    categoryAxis.dataFields.category = "year";
                    categoryAxis.renderer.minGridDistance = 30;

                    /* Create value axis */
                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

                    /* Create series */
                    var columnSeries = chart.series.push(new am4charts.ColumnSeries());
                    columnSeries.name = "Valor total del año";
                    columnSeries.dataFields.valueY = "income";
                    columnSeries.dataFields.categoryX = "year";

                    columnSeries.columns.template.tooltipText = "[#fff font-size: 15px]{name} en {categoryX}:\n[/][#fff font-size: 20px]$ {valueY}[/] [#fff]{additional}[/]"
                    columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
                    columnSeries.columns.template.propertyFields.stroke = "stroke";
                    columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
                    columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
                    columnSeries.tooltip.label.textAlign = "middle";

                    var lineSeries = chart.series.push(new am4charts.LineSeries());
                    lineSeries.name = "Expenses";
                    lineSeries.dataFields.valueY = "expenses";
                    lineSeries.dataFields.categoryX = "year";

                    lineSeries.stroke = am4core.color("#fdd400");
                    lineSeries.strokeWidth = 3;
                    lineSeries.propertyFields.strokeDasharray = "lineDash";
                    lineSeries.tooltip.label.textAlign = "middle";

                    var bullet = lineSeries.bullets.push(new am4charts.Bullet());
                    bullet.fill = am4core.color("#fdd400"); // tooltips grab fill from parent by default
                    //bullet.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff]{additional}[/]"
                    bullet.tooltipText = ""
                    var circle = bullet.createChild(am4core.Circle);
                    circle.radius = 4;
                    circle.fill = am4core.color("#fff");
                    circle.strokeWidth = 3;

                    chart.data = data;

                }); // end am4core.ready()
            </script>
        <?php } ?>

        <script>
            $(function () {
<?php
$arraymes;
$str = '';
if (isset($_GET['anio']) && isset($_GET['mes'])) {
    $meses = [0, 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    $arraymes = explode(',', $_GET['mes']);
    for ($j = 0; $j < count($arraymes); $j++) {
        $str .= ' ' . $meses[$arraymes[$j]] . (($j + 1) == count($arraymes) ? '' : ', ');
    }
}
?>
                $("#anio").select2({
                    maximumSelectionSize: 3,
                    placeholder: 'Escoger año',
                    separator: ','
                });
                $("#mes").select2({
                    maximumSelectionSize: 2,
                    placeholder: 'Escoger mes',
                    separator: ','
                });
                var column = ['N°', 'Producto', 'Año', 'Mes','Día', 'Cantidad', 'Precio'];
                var dibujarColumn = '<tr>';
                for (var i in column) {
                    dibujarColumn += '<th>' + column[i] + '</th>';
                }
                $('#colspam').attr('colspan', column.length);
<?php
if (isset($_GET['anio']) && isset($_GET['mes'])) {
    ?>
                    $('#thtabla').append('<tr><th style="text-align:center" colspan="' + column.length + '">Ingreso de productos de los años: <?= $_GET['anio'] . ' de los meses: ' . $str ?></th></tr>' + dibujarColumn);
    <?php
}else{
    ?>
            $('#thtabla').append('<tr><th style="text-align:center" colspan="' + column.length + '">Ingreso de productos</th></tr>' + dibujarColumn);
        <?php
}
?>

                /*EGRESO*/
                var column2 = ['N°', 'Fecha', 'Cantidad', 'Precio'];
                var dibujarColumn2 = '<tr>';
                for (var i in column2) {
                    dibujarColumn2 += '<th>' + column2[i] + '</th>';
                }
                $('#colspam_egreso').attr('colspan', column2.length);
                $('#thtabla_egreso').append('<tr><th style="text-align:center" colspan="' + column2.length + '">Egreso de productos</th></tr>' + dibujarColumn2);
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
                            html += '<td align="center">' + (i * 1 + 1) + '</td>';//moment().format('MMMM Do YYYY, h:mm:ss a');
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.nombre + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.anio + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">' + moment().format('MMMM') + '</td>';
							html += '<td align="center" style="background-color:#fcfcfc">' + moment().format('dddd') + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.cantidad + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.precio + '</td>';
                            total = total + parseInt(ins.cantidad);
                            stock = stock + parseFloat(ins.precio);
                            html += '</tr>';
                            $('#tbody').append(html);
                        }
                        $('#ingreso_cantidad ').html(total);
                        $('#ingreso_stock ').html(stock);
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
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.fecha + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.cantidad + '</td>';
                            html += '<td align="center" style="background-color:#fcfcfc">' + ins.precio + '</td>';
                            total = total + parseFloat(ins.precio);
                            cantidad = cantidad + parseInt(ins.cantidad);
                            html += '</tr>';
                            $('#tbody_egreso').append(html);
                        }
                        $('#egreso_cantidad ').html(cantidad);
                        $('#egreso_precio').html(total);
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
                    "autoApply": true,
                    startDate: moment(),
                    endDate: moment(),
                    "opens": "right",
                    "cancelClass": "btn-xs btn-danger"
                });
                $('input[name=fecha]').val('');
                var fechai = '';
                var fechaf = '';
<?php if (isset($_GET['anio']) && isset($_GET['mes'])) { ?>
                    tabla.arr = <?= json_encode($sql) ?>;
                    tabla.dibujar();
<?php } ?>
                $('input[name=fecha]').on('apply.daterangepicker', function (ev, picker) {
                    fechai = picker.startDate.format('YYYY/MM/DD');
                    fechaf = picker.endDate.format('YYYY/MM/DD');
                    window.location = '<?= base_url() ?>reporte?action=<?= $action ?>&fi=' + fechai + '&ff=' + fechaf
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
                $('#buscar').click(function () {
                    var anio = ($('#anio').val());
                    var mes = $('#mes').val();
                    window.location = '<?= base_url() ?>reporte?action=<?= $action ?>&anio=' + anio + '&mes=' + mes;
                });
            })
        </script>
    </body>
</html>