<?php
if ($this->session->userdata('username')) {
    redirect(base_url() . 'menu/');
}
?>
<?php $this->load->view('data/typehtml') ?>
<html lang="<?php $this->load->view('data/lang') ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <link href="<?= base_url() ?>static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <style type="text/css">
            body{background-color: #f1f1f1;}
            .bslf{
                width: 350px;
                margin: 120px auto;
                padding: 25px 20px;
                background: #3a1975;
                box-shadow: 2px 2px 4px #ab8de0;
                border-radius: 5px;
                color: #fff;
            }
            .bslf h2{
                margin-top: 0px;
                margin-bottom: 15px;
                padding-bottom: 5px;
                border-radius: 10px;
                border: 1px solid #25055f;
            }
            .bslf a{color: #783ce2;}
            .bslf a:hover{
                text-decoration: none;
                color: #03A9F4;
            }
            .bslf .checkbox-inline{padding-top: 7px;}
        </style>
    </head>
    <body>
        <div class="bslf">
            <form id="frmEntidad">
                <h2 class="text-center">Igresar al Sistema</h2>       
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Usuario" name="usuario" required="required">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Contraseña"  name="pass"required="required">
                </div>
                <div class="form-group">
                    <div id="alerta" class="alert alert-danger alert-dismissible" style="display: none" role="alert">
                            <!--<a href="#" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></a>-->
                        <div id="alerta_texto"></div>
                    </div>
                    <div class="space"></div>
                </div>
                <div class="form-group clearfix">
                    <button type="submit" class="btn btn-primary pull-right">Ingresar</button>
                </div>      
            </form>
        </div>
        <script src="<?= base_url() ?>static/jquery/dist/jquery.min2.0.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>static/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                var msj = {
                    alert: function (mensaje) {
                        $('#alerta_texto').html('<span class="fa fa-warning"></span>  ' + mensaje);
                        if ($('#alerta').is(':hidden')) {
                            $('#alerta').toggle('slow');
                        }
                        setTimeout(function () {
                            $('#alerta').toggle('slow');
                        }, 2500);
                    }
                }
                $('#frmEntidad').keypress(function (e) {
                    if (e.which === 32) {
                        return false;
                    }
                });
                $('#frmEntidad').submit(function () {
                    $.ajax({
                        url: "<?= base_url() ?>login/iniciar",
                        type: 'POST',
                        data: $(this).serialize(),
                        dataType: 'json',
                        timeout: 15000,
                        beforeSend: function () {
                            //M_error.Envio();
                            $('#frmEntidad').find('input, textarea, button, select').prop('disabled', true);
                            $('.ingresar').html('<i class="fa fa-refresh fa-pulse fa-fw"></i> Espere...');
                        },
                        success: function (data) {
                            if (data.resp) {
                                window.location = '<?= base_url() ?>menu/';
                                return;
                            } else {
                                msj.alert(data.msj);
                            }
                            $('#frmEntidad').find('input, textarea, button, select').prop('disabled', false);
                            $('.ingresar').html('<i class="fa fa-sign-in"></i>  Ingresar');
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status === 0) {
                                msj.alert('No estás conectado, verifica tu conección.');
                            } else if (jqXHR.status == 404) {
                                msj.alert('Respuesta, página no existe [404].');
                            } else if (jqXHR.status == 500) {
                                msj.alert('Error interno del servidor [500].');
                            } else if (textStatus === 'parsererror') {
                                msj.alert('Respuesta JSON erróneo.');
                            } else if (textStatus === 'timeout') {
                                msj.alert('Error, tiempo de respuesta.');
                            } else if (textStatus === 'abort') {
                                msj.alert('Respuesta ajax abortada.');
                            } else {
                                msj.alert('Uncaught Error: ' + jqXHR.responseText);
                            }
                        }
                    });
                    return false;
                });
            });
        </script>
    </body>
</html>