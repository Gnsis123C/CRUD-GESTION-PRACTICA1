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
        <section class="container-fluid" id="panel-listar">
            <div class="panel panel-info">
                <div class="panel-body">
                    <div id="panelListar">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="row" style="padding: 0 50px">
                                    <div class="col-md-12 col-lg-5 col-xl-5 box-s">
                                        <!-- HTML -->
                                        <div id="chartdiv"></div>
                                    </div>
                                    <div class="col-md-12 col-lg-1 col-xl-7 box-1" style="text-align: center">

                                    </div>
                                    <div class="col-md-12 col-lg-6 col-xl-6 box-s" style="text-align: center">
                                        <!-- HTML -->
                                        <div id="chartdiv2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Resources -->
        <script src="https://www.amcharts.com/lib/4/core.js"></script>
        <script src="https://www.amcharts.com/lib/4/charts.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
        <!-- Fecha -->
        <!-- Chart code -->
        <script>
            am4core.ready(function () {

                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end



                // Create chart instance
                var chart = am4core.create("chartdiv", am4charts.RadarChart);

                // Add data
                chart.data = [{
                        "category": "Research",
                        "value": 80,
                        "full": 100
                    }, {
                        "category": "Marketing",
                        "value": 35,
                        "full": 100
                    }, {
                        "category": "Distribution",
                        "value": 92,
                        "full": 100
                    }, {
                        "category": "Human Resources",
                        "value": 68,
                        "full": 100
                    }];

                // Make chart not full circle
                chart.startAngle = -90;
                chart.endAngle = 180;
                chart.innerRadius = am4core.percent(20);

                // Set number format
                chart.numberFormatter.numberFormat = "#.#'%'";

                // Create axes
                var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "category";
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.renderer.grid.template.strokeOpacity = 0;
                categoryAxis.renderer.labels.template.horizontalCenter = "right";
                categoryAxis.renderer.labels.template.fontWeight = 500;
                categoryAxis.renderer.labels.template.adapter.add("fill", function (fill, target) {
                    return (target.dataItem.index >= 0) ? chart.colors.getIndex(target.dataItem.index) : fill;
                });
                categoryAxis.renderer.minGridDistance = 10;

                var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
                valueAxis.renderer.grid.template.strokeOpacity = 0;
                valueAxis.min = 0;
                valueAxis.max = 100;
                valueAxis.strictMinMax = true;

                // Create series
                var series1 = chart.series.push(new am4charts.RadarColumnSeries());
                series1.dataFields.valueX = "full";
                series1.dataFields.categoryY = "category";
                series1.clustered = false;
                series1.columns.template.fill = new am4core.InterfaceColorSet().getFor("alternativeBackground");
                series1.columns.template.fillOpacity = 0.08;
                series1.columns.template.cornerRadiusTopLeft = 20;
                series1.columns.template.strokeWidth = 0;
                series1.columns.template.radarColumn.cornerRadius = 20;

                var series2 = chart.series.push(new am4charts.RadarColumnSeries());
                series2.dataFields.valueX = "value";
                series2.dataFields.categoryY = "category";
                series2.clustered = false;
                series2.columns.template.strokeWidth = 0;
                series2.columns.template.tooltipText = "{category}: [bold]{value}[/]";
                series2.columns.template.radarColumn.cornerRadius = 20;

                series2.columns.template.adapter.add("fill", function (fill, target) {
                    return chart.colors.getIndex(target.dataItem.index);
                });

                // Add cursor
                chart.cursor = new am4charts.RadarCursor();

            }); // end am4core.ready()
        </script>
        <script>
            am4core.ready(function () {
                am4core.useTheme(am4themes_animated);
                var chart = am4core.create("chartdiv2", am4charts.XYChart3D);
                // Themes end
                // Create axes
                // Add data
                chart.data = [
                    {
                        "nombre": "Ingreso",
                        "visits": 22
                    }, {
                        "nombre": "Egreso",
                        "visits": 22
                    }
                ];

                let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "nombre";
                categoryAxis.renderer.labels.template.rotation = 270;
                categoryAxis.renderer.labels.template.hideOversized = false;
                categoryAxis.renderer.minGridDistance = 20;
                categoryAxis.renderer.labels.template.horizontalCenter = "right";
                categoryAxis.renderer.labels.template.verticalCenter = "middle";
                categoryAxis.tooltip.label.rotation = 270;
                categoryAxis.tooltip.label.horizontalCenter = "right";
                categoryAxis.tooltip.label.verticalCenter = "middle";
                let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Ingresos y egresos de productos";
                valueAxis.title.fontWeight = "bold";

                // Create series
                var series = chart.series.push(new am4charts.ColumnSeries3D());
                series.dataFields.valueY = "visits";
                series.dataFields.categoryX = "nombre";
                series.name = "Visits";
                series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
                series.columns.template.fillOpacity = .8;

                var columnTemplate = series.columns.template;
                columnTemplate.strokeWidth = 2;
                columnTemplate.strokeOpacity = 1;
                columnTemplate.stroke = am4core.color("#FFFFFF");

                columnTemplate.adapter.add("fill", function (fill, target) {
                    return chart.colors.getIndex(target.dataItem.index);
                })

                columnTemplate.adapter.add("stroke", function (stroke, target) {
                    return chart.colors.getIndex(target.dataItem.index);
                })

                chart.cursor = new am4charts.XYCursor();
                chart.cursor.lineX.strokeOpacity = 0;
                chart.cursor.lineY.strokeOpacity = 0;
                // Create chart instance
            })

        </script>
    </body>
</html>