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
        <link href="<?= base_url() ?>static/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css"/>
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
        </div>
        <section class="container-fluid" id="panel-listar">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row-fluid">
                        <div class="container-fluid">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <h2 class="text-primary" id="title-listar" style="font-size: 20px">

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
                    <div class="x_content" id="tabla_1">

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
        <!-- Fecha -->

        <script src="<?= base_url() ?>static/touchspin/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/datapicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/locales/bootstrap-datepicker.es.min.js" type="text/javascript"></script>
        <script>
            $(function () {

                $("#stock").TouchSpin({
                    buttondown_class: 'btn btn-white',
                    buttonup_class: 'btn btn-white',
                    min: 2,
                    max: 100000,
                    step: 1,
                    decimals: 0,
                    boostat: 5,
                    maxboostedstep: 10,
                    postfix: 'N°'
                });
                $('#fechaingreso').datepicker({
                    language: "es",
                    format: "yyyy-mm-dd",
                    startDate: "2017-01-01",
                    endDate: "2030-01-01",
                    firstDay: 1,
                    numberOfMonths: 1,
                    daysOfWeekDisabled: "0,6",
                });
                var permisos = {
                    editar: <?= ($this->session->userdata('editar') == '1' ? 1 : 0) ?>,
                    eliminar: <?= ($this->session->userdata('eliminar') == '1' ? 1 : 0) ?>,
                    crear: <?= ($this->session->userdata('crear') == '1' ? 1 : 0) ?>
                }
                //FECHA NACIMIENTO
                var imgU = '<?= $img ?>';
                $('#title-listar').html('<img src="' + imgU + '" alt="icon" class="img-circle" width="70">Listado de <?= $title ?>');
                moment.locale('es');
                $('#fecha-foot').html(' <i>' + moment().format('dddd DD [de] MMMM [de] YYYY [-] HH:mm' + '</i>'));
                var url = '<?= base_url() ?><?= $breadcrumb ?>/listar';
                var urlelim = '<?= base_url() ?><?= $breadcrumb ?>/eliminar';
                var validarcedula = '<?= base_url() ?><?= $breadcrumb ?>/validar';
                var urlForm = '<?= base_url() ?><?= $breadcrumb ?>/crear';
                var dataTable;
                var id_text = '<?= $id ?>';
                var idproducto = function (idproducto) {
                    var data = <?= json_encode($idproducto) ?>;
                    for (var i in data) {
                        var o = data[i];
                        if (o.idproducto === idproducto) {
                            return o.nombre;
                        }
                    }
                }
                var precio = function (idproducto) {
                    var data = <?= json_encode($idproducto) ?>;
                    for (var i in data) {
                        var o = data[i];
                        if (o.idproducto === idproducto) {
                            return o.precio;
                        }
                    }
                }
                dataTable = $.tablaAjax({
                    fixedHeader: false,
                    tabla: {className: 'table-striped table-bordered jambo_table'},
                    paging: true,
                    responsive: true,
                    image: imgU,
                    lengthMenu: [10, 20, 50, 100],
                    id: id_text,
                    thead: ['Código','Producto', 'Fecha de ingreso','Precio de venta', 'Fecha de expiración', 'Cantidad','Cantidad saliente', 'Stock'],
                    ajax: {
                        url: url,
                        urlelim: urlelim,
                        data: {"action": "Jsons"},
                        resp: [
                            {
                                "data": "idinventario", "render": function (d, t, f) {
                                    return '0'+d.toUpperCase()
                                }
                            },
                            {
                                "data": function (d, t, f) {
                                    return idproducto(d.idproducto);
                                }
                            },
                            {
                                "data": "fechaingreso", "render": function (d, t, f) {
                                    return d.toUpperCase()
                                }
                            },{
                                "data": function (d, t, f) {
                                    return '$ '+precio(d.idproducto);
                                }
                            },
                            {
                                "data": "fechaexpiracion", "render": function (d, t, f) {
                                    return d.toUpperCase()
                                }
                            },
                            {
                                "data": "cantidad", "render": function (d, t, f) {

                                    return d.toUpperCase()
                                }
                            },
                            {
                                "data": function (d, t, f) {
                                    var colores = ['success', 'danger', 'warning', 'default', 'success', 'danger', 'warning', 'default'];
                                    var stock = parseInt(d.stock);
                                    var cantidad = parseInt(d.cantidad);
                                    var porcentaje = (stock * 100) / cantidad;
                                    var html = '';
                                    return cantidad-stock;
                                }
                            },
                            {
                                "data": function (d, t, f) {
                                    var colores = ['success', 'danger', 'warning', 'default', 'success', 'danger', 'warning', 'default'];
                                    var stock = parseInt(d.stock);
                                    var cantidad = parseInt(d.cantidad);
                                    var porcentaje = (stock * 100) / cantidad;
                                    var html = '';
                                    html += '<div title="'+stock+'" class="progress progress-striped active">';
                                    html += '<div class="progress-bar progress-bar-'+colores[Math.floor(Math.random() * 7)]+'" role="progressbar"';
                                    html += 'aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"';
                                    html += 'style="width: ' + porcentaje + '%">';
                                    html += '<span class="sr-only">Quedan ' + stock + '</span>';
                                    html += '</div>';
                                    html += '</div>';
                                    return stock
                                }
                            }
                        ]
                    },
                    group: {
                        estado: false,
                        order: [[2, 'asc']],
                        drawCallback: function (settings) {
                            var j = 0;
                            var api = this.api();
                            var rows = api.rows({page: 'current'}).nodes();
                            var last = null;
                            api.column(2, {page: 'current'}).data().each(function (group, i) {
                                if (last !== group) {
                                    j = j + 1;
                                    $(rows).eq(i).before('<tr class="group"  style="width: 35px;background: #ecf0f5"><td colspan="10"><b>' + group + '</b></td></tr>');
                                    last = group;
                                }
                            });
                        }
                    },
                    container: 'tabla_1',
                    contextMenu: {
                        urlForm: urlForm,
                        visible: true,
                        add: false,
                        edit: {
                            estado: permisos.editar,
                            callback: function (key, options) {
                                tabla.dir(tabla.objt());
                            }
                        },
                        elim: permisos.eliminar
                    },
                    buttons: ['reload'],
                    buttons_local: false,
                    colum: [2, 3, 6, 7] //a imprimir o pdf
                            //tbody: ,
                });
                //tabla.ajax();
                $("#tdetalle").on('click', 'a[rel="action"]', function (e) {
                    var data = $(this).data('json'),
                            action = data.action,
                            id = data.id;
                    if (action == 'editar') {
                        var objeto = $.objtEdit(id);
                        tabla.dir(objeto);
                    } else {
                        $.confirm({
                            //icon: 'fa fa-warning',
                            theme: 'bootstrap',
                            type: 'red',
                            typeAnimated: true,
                            animation: 'zoom',
                            closeAnimation: 'scale',
                            title: 'Confirmar acción!',
                            content: '¿Desea eliminar el registro?',
                            buttons: {
                                confirm: {
                                    text: '<i class="fa fa-trash-o"></i> Eliminar',
                                    btnClass: 'btn-danger',
                                    keys: ['enter'],
                                    action: function () {
                                        $.eliminarAjax(id);
                                    }
                                },
                                cancel: {
                                    text: 'Cancelar',
                                    action: function () {
                                        return true;
                                    }
                                }
                            }
                        });
                    }
                });
                var stockoriginal = 0;
                var tabla = {
                    objt: function () {
                        var list = [];
                        var listLocal = dataTable.rows('.selected').data();
                        for (var i = 0; i < listLocal.length; i++) {
                            list.push(listLocal[i]);
                        }
                        return list;
                    },
                    dir: function (obj) {
                        $('#panel-form').slideDown('slow');
                        $('#panel-listar').slideUp('slow');
                        $('#action').val('edit');
                        $('#id_').val(obj[0].<?= $id ?>);
                        $('#idproducto').val(obj[0].idproducto);
                        $('#cantidad').val(obj[0].cantidad);
                        $('#stockoriginal').val(obj[0].stock);

                        $('#stock').trigger("touchspin.updatesettings", {min: (obj[0].stock)});
                        stockoriginal = obj[0].stock;
                        $('#stock').val(obj[0].stock);
                        //$('#fechanacimiento').val();
                        $('#precio').val(obj[0].precio);
                        $('#fechaingreso').val(obj[0].fechaingreso);
                        $('#accion_form').html('Editar ');
                        //window.location = urlForm + '?idtipoproc=' +  + '&nomtipo=' +  + '&tarifa=' +  + '&action=edit';
                    }
                };
                $("#ver-lista").click(function () {
                    $('#demo-form2').data('formValidation').resetForm();
                    document.getElementById("demo-form2").reset();
                    $('#panel-listar').slideDown('slow');
                    $('#panel-form').slideUp('slow');
                });



                ///FORM VALIDATION
                $('#demo-form2').keypress(function (e) {
                    if (e.which == 13) {
                        return false;
                    }
                });
                FormValidation.Validator.Cedula = {
                    validate: function (validator, $field, option) {
                        var value = $field.val();
                        if (!isNaN(value)) {
                            if (value.length == 13) {
                                return $.ruc(value);
                            }
                        }
                        return true;
                    }
                };
                var form = $('#demo-form2').formValidation({
                    framework: 'bootstrap',
                    icon: {
                        valid: 'fa fa-check',
                        invalid: 'fa fa-close ',
                        validating: 'fa fa-refresh fa-pulse'
                    },
                    fields: {

                    }
                });
                form.on('success.form.fv', function (e) {
                    e.preventDefault();
                    var $form = $(e.target), fv = $form.data('formValidation');
                    var idForm = 'demo-form2';
                    var idIcon = 'loading';
                    var TextButton = 'caption';
                    var ajx = $.ajaxTabla({
                        url: urlForm,
                        data: $form.serialize(),
                        idForm: idForm,
                        idIcon: idIcon,
                        TextButton: TextButton
                    });
                    ajx.success(function (data) {
                        dataTable.ajax.reload(function () {
                            $('#' + idForm).find('input, textarea, button, select').prop('disabled', false);
                            $('#' + idIcon).removeClass('fa-refresh fa-pulse');
                            $('#' + idIcon).addClass('fa-save');
                            $('#' + TextButton).html('Guardar Registro');
                            if (data.resp) {
                                toastr.options = {
                                    progressBar: true,
                                    hideDuration: 2000
                                };
                                toastr.success('<b>MENSAJE:</b><br>Dato guardado!!');
                                $('#panel-listar').slideDown('slow');
                                $('#panel-form').slideUp('slow');
                            } else {
                                toastr.options = {
                                    progressBar: true,
                                    hideDuration: 2000
                                };
                                toastr.error((data.error == 'Dato no guardado' ? '<b>ERROR: </b><br>' + data.error : '<b style="font-size: 12px;">¡¡ERROR!! AL ' + ($('#action').val() == 'add' ? 'AGREGAR' : 'EDITAR') + ' EL REGISTRO: </b><br><div style="font-size: 10px;">' + data.error + '</div><br><b style="font-size: 14px;">POSIBLES CAUSAS:</b><div style="font-size: 12px;">1.- Error interno del sistema.</div>'));
                                $('#panel-listar').slideDown('slow');
                                $('#panel-form').slideUp('slow');
                            }
                            $('#' + idForm).data('formValidation').resetForm();
                            document.getElementById(idForm).reset();
                            $.tablaMdos();
                            return;
                        });
                    })
                });
                $('#stock').change(function () {
                    var num = $(this).val();
                    $('#stock').trigger("touchspin.updatesettings", {min: (num)});
                    if (num < stockoriginal) {
                        $(this).val(stockoriginal);
                    }
                })
            });
        </script>
    </body>
</html>