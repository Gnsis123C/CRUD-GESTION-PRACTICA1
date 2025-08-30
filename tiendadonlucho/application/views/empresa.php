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
        <section class="container-fluid" id="panel-"  style="display: none" >
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
        <section class="container-fluid"id="panel-form">
            <div class="col-md-8 col-md-offset-2">
                <?php $this->load->view('data/form/' . $nameform); ?>
            </div>
        </section>
        <?php $this->load->view('data/js'); ?>
        <script src="<?= base_url() ?>static/plugin/cedulayruc.js" type="text/javascript"></script>
        <!-- Fecha -->

        <script src="<?= base_url() ?>static/jquery.bootstrap-touchspin/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
        <script>
            $(function () {
                var permisos = {
                    editar: <?= ($this->session->userdata('editar') == '1' ? 1 : 0) ?>,
                    eliminar: <?= ($this->session->userdata('eliminar') == '1' ? 1 : 0) ?>,
                    crear: <?= ($this->session->userdata('crear') == '1' ? 1 : 0) ?>
                }
                //FECHA NACIMIENTO
                var imgU = '<?= $img ?>';
                $('body > div.fakeloader').css('display','none');
                $('#title-listar').html('<img src="' + imgU + '" alt="icon" class="img-circle" width="70">Listado de <?= $title ?>');
                moment.locale('es');
                $('#fecha-foot').html(' <i>' + moment().format('dddd DD [de] MMMM [de] YYYY [-] HH:mm' + '</i>'));
                var url = '<?= base_url() ?><?= $breadcrumb ?>/listar';
                var urlelim = '<?= base_url() ?><?= $breadcrumb ?>/eliminar';
                var validarcedula = '<?= base_url() ?><?= $breadcrumb ?>/validar';
                var urlForm = '<?= base_url() ?><?= $breadcrumb ?>/crear';
                var dataTable;
                var id_text = '<?= $id ?>';
                var idtipop = function (idtipoproducto) {
                    var data = <?= json_encode($idtipoproducto) ?>;
                    for (var i in data) {
                        var o = data[i];
                        if (o.idtipoproducto === idtipoproducto) {
                            return o.nombre;
                        }
                    }
                }
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
                        $('#nombre').val(obj[0].nombre);
                        $('#precio').val(obj[0].precio);
                        $('#idtipoproducto').val(obj[0].idtipoproducto);
                        //$('#fechanacimiento').val();
                        $('#estado').val(obj[0].estado);
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
                $('#demo-form2 [name=telefono]').on('input', function () {
                    this.value = this.value.replace(/[^0-9\.]/g, '');
                });
                var form = $('#demo-form2').formValidation({
                    framework: 'bootstrap',
                    icon: {
                        valid: 'fa fa-check',
                        invalid: 'fa fa-close ',
                        validating: 'fa fa-refresh fa-pulse'
                    },
                    fields: {
                        nombre: {
                            validators: {
                                notEmpty: {
                                    message: 'Por favor introduce un valor correcto', },
                                stringLength: {
                                    min: 2,
                                    max: 40
                                },
                                remote: {
                                    message: 'El nombre ya se encuentra registrado en la base de datos',
                                    url: validarcedula,
                                    data: function (validator, $field, value) {
                                        return {
                                            nombre: validator.getFieldElements('nombre').val(),
                                            id: validator.getFieldElements('id').val() == '' ? 0 : validator.getFieldElements('id').val(),
                                            action: 'validarCed'
                                        };
                                    },
                                    type: 'POST'
                                }
                            }
                        },
                        ruc: {
                            validators: {
                                notEmpty: {
                                    message: 'Por favor introduce un valor correcto', },
                                regexp: {
                                    message: 'Error RUC, no debe tener letras ni signos especiales.',
                                    regexp: /^[0-9\s\-()+\.]+$/
                                },
                                stringLength: {
                                    min: 13,
                                    max: 13
                                },
                                Cedula: {
                                    message: 'Error RUC ingresada no es la correcta.'
                                }
                            }
                        }
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
                        window.location='<?= base_url() ?>login/logout'
                        return;
                    })
                });
            });
        </script>
    </body>
</html>