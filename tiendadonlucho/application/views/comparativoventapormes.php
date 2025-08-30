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
        <!-- Resources -->
        <script src="https://www.amcharts.com/lib/4/core.js"></script>
        <script src="https://www.amcharts.com/lib/4/charts.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
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
            #chartdiv {
                width: 100%;
                height: 500px;
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
                                                    <label for="id-date-range-picker-1">Ingresar año y mes   </label>
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <select class="form-control" id="anio">
                                                                <?php for($i=2018;$i<2050;$i++){ ?>
                                                                    <option value="<?= $i ?>"  <?= ((isset($_GET['anio'])?$_GET['anio']:date ("Y"))==$i?'selected':'') ?>><?= $i ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="form-control" id="mes">
                                                                <option <?= ((isset($_GET['mes'])?$_GET['mes']:'1')==1?'selected':'') ?> value="1">Enero</option>
                                                                <option <?= ((isset($_GET['mes'])?$_GET['mes']:'1')==2?'selected':'') ?> value="2">Febrero</option>
                                                                <option <?= ((isset($_GET['mes'])?$_GET['mes']:'1')==3?'selected':'') ?> value="3">Marzo</option>
                                                                <option <?= ((isset($_GET['mes'])?$_GET['mes']:'1')==4?'selected':'') ?> value="4">Abril</option>
                                                                <option <?= ((isset($_GET['mes'])?$_GET['mes']:'1')==5?'selected':'') ?> value="5">Mayo</option>
                                                                <option <?= ((isset($_GET['mes'])?$_GET['mes']:'1')==6?'selected':'') ?> value="6">Junio</option>
                                                                <option <?= ((isset($_GET['mes'])?$_GET['mes']:'1')==7?'selected':'') ?> value="7">Julio</option>
                                                                <option <?= ((isset($_GET['mes'])?$_GET['mes']:'1')==8?'selected':'') ?> value="8">Agosto</option>
                                                                <option <?= ((isset($_GET['mes'])?$_GET['mes']:'1')==9?'selected':'') ?> value="9">Septiembre</option>
                                                                <option <?= ((isset($_GET['mes'])?$_GET['mes']:'1')==10?'selected':'') ?> value="10">Octubre</option>
                                                                <option <?= ((isset($_GET['mes'])?$_GET['mes']:'1')==11?'selected':'') ?> value="11">Noviembre</option>
                                                                <option <?= ((isset($_GET['mes'])?$_GET['mes']:'1')==12?'selected':'') ?> value="12">Diciembre</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-md-12 col-lg-5 col-xl-5">
                                <div id="chartdiv"></div>
                            </div>
                            <div class="col-md-12 col-lg-7 col-xl-7">
                                <section class="panel">
                                    <div class="panel-body" id="">
                                        <table class="table table-bordered" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                                            <thead id="thtabla">
                                            <?php
                                            $total = 0;
                                            $dat = array();
                                            $exist = false;
                                            if($data_resp['resp']){
                                                $dat = $data_resp['dat'];
                                                $exist = (count($dat)==0?false:true);
                                            }

                                            ?>
                                            <?php ?>
                                            <?php ?>
                                            <tr>
                                                <th style="text-align:center" colspan="6">Comparativos de productos</th>
                                            </tr>
                                            <tr>
                                                <th style="width: 40%;max-width: 40%">Producto</th>
                                                <th style="width: 15%;max-width: 15%">Cantidad</th>
                                                <th style="width: 15%;max-width: 15%">Precio</th>
                                                <th style="width: 15%;max-width: 15%">Total</th>
                                                <th style="width: 15%;max-width: 15%">Número de productos</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody">
                                            <?php if(!$exist){ ?>
                                                <tr><td id="colspam" colspan="6" align="center">Ningún dato</td></tr>
                                            <?php }else{ ?>
                                                <?php foreach ($dat as $x){ ?>
                                                    <tr>
                                                        <td>
                                                            <?= $x->nombre ?>
                                                        </td>
                                                        <td>
                                                            Cant. <?= $x->cantidad ?>
                                                        </td>
                                                        <td>
                                                            $ <?= $x->precio ?>
                                                        </td>
                                                        <td>
                                                            $ <?= $x->total ?>
                                                        </td>
                                                        <td>
                                                            <?= $x->numero ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                            </tbody>
                                            <!-- Chart code -->
                                            <script>
                                                var datArray = <?= json_encode($dat) ?>;
                                                var chartArray = [];
                                                for(var i in datArray){
                                                    chartArray.push({
                                                        "nombre":datArray[i].nombre,
                                                        "total":datArray[i].total
                                                    })
                                                }
                                                am4core.ready(function() {

// Themes begin
                                                    am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
                                                    var chart = am4core.create("chartdiv", am4charts.PieChart);

// Add data
                                                    chart.data = chartArray;

// Add and configure Series
                                                    chart.innerRadius = am4core.percent(50);

                                                    var pieSeries = chart.series.push(new am4charts.PieSeries());
                                                    pieSeries.dataFields.value = "total";
                                                    pieSeries.dataFields.category = "nombre";
                                                    pieSeries.slices.template.stroke = am4core.color("#fff");
                                                    pieSeries.slices.template.strokeWidth = 2;
                                                    pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
                                                    pieSeries.hiddenState.properties.opacity = 1;
                                                    pieSeries.hiddenState.properties.endAngle = -90;
                                                    pieSeries.hiddenState.properties.startAngle = -90;

                                                }); // end am4core.ready()
                                            </script>
                                            <tfoot>
                                            <?php if(!$exist){ ?>
                                                <tr>
                                                    <td colspan="3">
                                                        Total:
                                                    </td>
                                                    <td id="ingreso_cantidad" align="center">
                                                        0
                                                    </td>
                                                    <td id="ingreso_stock" align="center">
                                                        0
                                                    </td>
                                                </tr>
                                            <?php }else{ ?>

                                            <?php } ?>
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
            $(function(){
                $('#anio').change(function(){
                    var anio = $(this).val();
                    var mes = <?= (isset($_GET['mes'])?$_GET['mes']:1) ?>;
                    window.location = '<?= base_url() ?>'+'reporte/comparativoventapormes?anio='+anio+'&mes='+mes
                });
                $('#mes').change(function(){
                    var mes = $(this).val();
                    var anio = <?= (isset($_GET['anio'])?$_GET['anio']:date ("Y")) ?>;
                    window.location = '<?= base_url() ?>'+'reporte/comparativoventapormes?anio='+anio+'&mes='+mes
                });
            })
        </script>
    </body>
</html>