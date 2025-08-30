(function ($) {
    $.extend({
        cedula: function (cedula) {
            if (typeof (cedula) == 'string' && cedula.length == 10 && /^\d+$/.test(cedula)) {
                var digitos = cedula.split('').map(Number);
                var codigo_provincia = digitos[0] * 10 + digitos[1];

                if (codigo_provincia >= 1 && (codigo_provincia <= 24 || codigo_provincia == 30) && digitos[2] < 6) {
                    var digito_verificador = digitos.pop();

                    var digito_calculado = digitos.reduce(
                            function (valorPrevio, valorActual, indice) {
                                return valorPrevio - (valorActual * (2 - indice % 2)) % 9 - (valorActual == 9) * 9;
                            }, 1000) % 10;
                    return digito_calculado === digito_verificador;
                }
            }
            return false;
        },
        ruc: function (ruc) {
            var number = ruc.toString();
            var dto = number.length;
            var valor;
            var acu = 0;
            if (number == "") {
                return false;
            }
            else {
                for (var i = 0; i < dto; i++) {
                    valor = number.substring(i, i + 1);
                    if (valor == 0 || valor == 1 || valor == 2 || valor == 3 || valor == 4 || valor == 5 || valor == 6 || valor == 7 || valor == 8 || valor == 9) {
                        acu = acu + 1;
                    }
                }
                if (acu == dto) {
                    while (number.substring(10, 13) != 001) {
                        return false;
                    }
                    while (number.substring(0, 2) > 24) {
                        return false;
                    }
                    return true;
                }
                else {
                    return false;
                }
            }
        },
        formularioEnvio: function () {
            $('#modal_').modal('hide');
            $('#demo-form2').find('input, textarea, button, select').prop('disabled', true);
            $('#loading').removeClass('fa-save');
            $('#loading').addClass('fa-refresh fa-pulse fa-fw');
            $('#caption').html('Guardando..');
            $.isLoading({
                text: "<strong>Guardando...</strong>",
                tpl: '<span class="isloading-wrapper %wrapper%"><i class="fa fa-circle-o-notch fa-2x fa-spin"></i><br>%text%</span>',
            });
            return true;
        },
        formularioRespuesta: function (mensaje) {
            setTimeout(function () {
                $.isLoading("hide");
                bootbox.alert({
                    message: mensaje + ((mensaje == 'Dato guardado!') ? ' <i class="fa fa-check"></i>' : '<i style="color:red" class="fa fa-times"></i>'),
                    className: 'bb-alternate-modal',
                    size: 'small'
                });
            }, 900);
            $('#demo-form2').find('input, textarea, button, select').prop('disabled', false);
            $('#loading').removeClass('fa-refresh');
            $('#loading').removeClass('fa-pulse');
            $('#loading').removeClass('fa-fw');
            $('#boton_submit').removeClass('disabled');
            $('#loading').addClass('fa-save');
            $('#caption').html('Guardar Registro');
            $('#demo-form2').data('formValidation').resetForm();
            document.getElementById("demo-form2").reset();
            return true;
        },
        españolT: {
            "select": {
                "rows": {
                    "_": "<code>Usted tiene seleccionado %d filas.</code>",
                    "0": "<code>Clic para seleccionar filas.</code>",
                    "1": "<code>Usted tiene seleccionado 1 fila.</code>"
                }
            },
            "sSearch": "<span class='fa fa-search'></span> ",
            "sZeroRecords": "No se encontraron resultados",
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ":Activar para ordenar la columna de manera descendente"
            },
            "oPaginate": {"sFirst": "Primero", "sLast": "Último", "sNext": "<span class='fa fa-chevron-right'></span>", "sPrevious": "<span class='fa fa-chevron-left'></span>"},
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ | <b>Total: </b> _MAX_ registros - ",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros - ",
            "sInfoFiltered": "(de un total de _MAX_ registros)",
            "sInfoPostFix": ""
        }
    });
})(jQuery);