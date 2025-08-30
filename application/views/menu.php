<?php $this->load->view('data/sesion'); ?>
<?php $this->load->view('data/typehtml') ?>
<html lang="<?php $this->load->view('data/lang') ?>">
    <head>
        <meta charset="utf-8">
        <title><?= $this->session->userdata('empresa')[0]->nombre ?> | <?= $title ?></title>
        <link rel="shortcut icon" href="<?= base_url() ?>static/img/icono_1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?= base_url() ?>static/jQuery-contextMenu-master/dist/jquery.contextMenu.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>static/loading/loading.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>static/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>static/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>static/fakeLoader.js-master/fakeLoader.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>static/bootstrap/estilo.css" rel="stylesheet" type="text/css"/>
        <style>
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
                text-align: center;
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
            #menu .icon {
                margin: 12px;
                text-align: center;
                float: left;
                width: 150px;
                height: 180px;
            }
        </style>
    </head>
    <body>
        <div class="fakeloader" style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; background-color: rgb(255, 255, 255); z-index: 999;"></div>
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
            <div class="row-fluid">
                <div class="container-fluid">
                    <?php
                    $existe = false;
                    foreach ($datos as $x):
                        if ($x->dias_transcurridos < 10 && $x->stock != 0) {
                            ?>
                            <?php $existe = true; ?>

                        <?php } endforeach; ?>
                    <?php if ($existe) { ?>
                        <?php if (count($datos) > 0) { ?>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="alert alert-warning alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Precaución</strong> existen inventarios que están a punto de ¡caducar!<button type="button" class="btn btn-link" data-toggle="modal" data-target="#productoacaducar">Ver</button>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } 
                    $existe = false;
                    ?>

                    <?php if (count($caducados) > 0) { ?>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Cuidado!</strong> Tienes inventarios caducados.<button type="button" class="btn btn-link" data-toggle="modal" data-target="#productocaducados">Ver</button>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    $existe = false;
                    foreach ($bajostock as $x):
                        if ($x->stock < 15 && $x->stock != 0) {
                            $existe = true;
                        }
                    endforeach;
                    ?>
                    <?php if ($existe) { ?>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="alert alert-info alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Cuidado!</strong> Tienes productos con bajos stock.<button type="button" class="btn btn-link" data-toggle="modal" data-target="#productobajo">Ver</button>
                            </div>
                        </div>
                        <?php
                    }
                    $existe = false;
                    ?>
                </div>
            </div>
            <div id="productobajo" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Productos con bajos de stock</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $existe = false;
                                    foreach ($bajostock as $x):
                                        ?>
                                        <?php
                                        if ($x->stock < 15 && $x->stock != 0) {
                                            $existe = true;
                                            ?>
                                            <tr>
                                                <td><?= $x->nombre ?></td>
                                                <td><?= $x->stock ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                    <?php if (!$existe) { ?>
                                        <tr>
                                            <td colspan="3">Ningún dato</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Modal -->
            <div id="productoacaducar" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Productos a Caducar</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Stock</th>
                                        <th>Fecha de Ingreso</th>
                                        <th>Fecha de Expiración</th>
                                        <th>Días que faltan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $existe = false;
                                    foreach ($datos as $x):
                                        if ($x->dias_transcurridos < 10 && $x->stock != 0) {
                                            ?>
                                            <?php $existe = true; ?>
                                            <tr>
                                                <td><?= $x->nombre ?></td>
                                                <td><?= $x->stock ?></td>
                                                <td><?= $x->fechaingreso ?></td>
                                                <td><?= $x->fechaexpiracion ?></td>
                                                <td><?= $x->dias_transcurridos ?></td>
                                            </tr>
                                        <?php } endforeach; ?>
                                    <?php if (!$existe) { ?>
                                        <tr>
                                            <td colspan="5">Ningún dato</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

                </div>
            </div>
            <div id="productocaducados" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Productos Caducados</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Fecha de Ingreso</th>
                                        <th>Stock</th>
                                        <th>Fecha de expiración</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $existe = false;
                                    foreach ($caducados as $x):
                                        ?>
                                        <?php
                                        if ($x->stock != 0) {
                                            $existe = true;
                                            ?>
                                            <tr>
                                                <td><?= $x->nombre ?></td>
                                                <td><?= $x->fechaingreso ?></td>
                                                <td><?= $x->stock ?></td>
                                                <td><?= $x->fechaexpiracion ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                    <?php if (!$existe) { ?>
                                        <tr>
                                            <td colspan="4">Ningún dato</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>

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
                                    Menú de navegación
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body" id="panel-width">
                    <div class="x_content">
                        <div class="row" id="menu">
                            <div class="col-xs-12">
                                <div class=" col-md-offset-1">
                                    <?php if ($this->session->userdata('tipo')) { ?>
                                        <a style="border-radius: 0px;" href="<?= base_url() ?>cliente" class="icon well sbox">
                                            <div class="iconimage">
                                                <div class="pd">
                                                    <img src="<?= base_url() ?>static/img/user.png" alt="Cliente" title="Clientes"/>
                                                </div>
                                            </div>
                                            <div class="iconname">
                                                <div class="pd">
                                                    <h4 class="tituloicon">Clientes General</h4>
                                                    <span class="icondesc">Administrar todos los clientes</span>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="<?= base_url() ?>empleado" style="border-radius: 0px;" class="icon well sbox">
                                            <div class="iconimage">
                                                <div class="pd">
                                                    <img src="<?= base_url() ?>static/img/empleado_1.png" alt="Departamentos"/>
                                                </div>
                                            </div>
                                            <div class="iconname">
                                                <div class="pd">
                                                    <h4 class="tituloicon">Empleados General</h4>
                                                    <span class="icondesc">Listado de todos los Empleados</span>
                                                </div>
                                            </div>
                                        </a>
                                    <?php } ?>
                                    <!--inicio Contrato-->

                                    <!--fin Contrato-->

                                    <!--inicio Departamentos-->

                                    <!--fin de Departamentos-->

                                    <!--inicio Empleados-->
                                    <a href="<?= base_url() ?>proveedor" style="border-radius: 0px;" class="icon well sbox">
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="<?= base_url() ?>static/img/empleado.png" alt="Proveedor"/>
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Proveedores</h4>
                                                <span class="icondesc">Administración de todos los Proveedores.</span>
                                            </div>
                                        </div>
                                    </a>
                                    <!--fin Empleados-->

                                    <!--inicio Prestaciones-->
                                    <a href="<?= base_url() ?>inventario" style="border-radius: 0px;" class="icon well sbox">
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="<?= base_url() ?>static/img/producto.png" alt="Prestación"/>
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Inventario de Productos</h4>
                                                <span class="icondesc">Administración de Inventario de Productos.</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="<?= base_url() ?>inventario/ver" style="border-radius: 0px;" class="icon well sbox">
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="<?= base_url() ?>static/img/producto.png" alt="Prestación"/>
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Inventario Producto Filtro</h4>
                                                <span class="icondesc">Inventario Producto con Filtro.</span>
                                            </div>
                                        </div>
                                    </a>
                                    <!--fin Prestaciones-->

                                    <!--inicio rol de pago-->
                                    <a href="<?= base_url() ?>producto" style="border-radius: 0px;" class="icon well sbox">
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="<?= base_url() ?>static/img/producto1.png" alt="Producto"/>
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Producto</h4>
                                                <span class="icondesc">Administración de Producto</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="<?= base_url() ?>tipoproducto" style="border-radius: 0px;" class="icon well sbox">
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="<?= base_url() ?>static/img/producto1.png" alt="Producto"/>
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Tipo Producto</h4>
                                                <span class="icondesc">Administración de Tipo Producto</span>
                                            </div>
                                        </div>
                                    </a>
                                    <!--fin  rol de pago-->
                                    <!--inicio rol de pago-->
                                    <a href="<?= base_url() ?>compra" style="border-radius: 0px;" class="icon well sbox">
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="<?= base_url() ?>static/img/compra.jpg" alt="Compra" title="Compra"/>
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Compra</h4>
                                                <span class="icondesc">Administración de compra.</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="<?= base_url() ?>venta" style="border-radius: 0px;" class="icon well sbox">
                                        <div class="iconimage">
                                            <div class="pd">
                                                <img src="<?= base_url() ?>static/img/venta.png" alt="Ventas" title="Ventas"/>
                                            </div>
                                        </div>
                                        <div class="iconname">
                                            <div class="pd">
                                                <h4 class="tituloicon">Venta</h4>
                                                <span class="icondesc">Administración de Venta.</span>
                                            </div>
                                        </div>
                                    </a>
                                    <?php if ($this->session->userdata('tipo')) { ?>
                                        <a href="<?= base_url() ?>empresa" style="border-radius: 0px;" class="icon well sbox">
                                            <div class="iconimage">
                                                <div class="pd">
                                                    <img src="<?= base_url() ?>static/img/prestacion.png" alt="Empresa" title="Empresa"/>
                                                </div>
                                            </div>
                                            <div class="iconname">
                                                <div class="pd">
                                                    <h4 class="tituloicon">Empresa</h4>
                                                    <span class="icondesc">Administración de Empresa.</span>
                                                </div>
                                            </div>
                                        </a>
                                    <?php } ?>

                                    <!--fin  rol de pago-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </section>
        <footer style="padding-top: 2%">
            <?php $this->load->view('data/footer'); ?>
        </footer>
        <script src="<?= base_url() ?>static/jquery/dist/jquery.min2.0.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                $('.fakeloader').append('<div class="fl spinner1"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>');
                $(".fakeloader").fadeOut();
                $(document).ready(function ($) {
                    var alto = $('body').height();
                    var ancho = $(window).width();
                    $('#panel-width').css('height', (parseInt(alto) - 240) + 'px');
                    //alert((parseInt(alto) - 299) + ' ' + ancho)
                });
            });
        </script>
        <script src="<?= base_url() ?>static/fakeLoader.js-master/fakeLoader.min.js" type="text/javascript"></script>
        <!---Moment-->
        <script src="<?= base_url() ?>static/moment/moment.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/moment/locale/es.js" type="text/javascript"></script>

    </body>
</html>