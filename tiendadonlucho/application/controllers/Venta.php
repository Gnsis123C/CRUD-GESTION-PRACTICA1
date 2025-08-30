<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Venta extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Data');
        $this->Data->tabla = 'venta';
        $this->Data->id = 'idventa';
        require_once(APPPATH . '/libraries/vendor/autoload.php');
    }

    public function index() {
        date_default_timezone_set('America/Guayaquil');
        setlocale(LC_ALL, 'es_ES');
        $fecha = strftime("%Y-%m-%d");
        $data = array(
            'title' => 'Ventas',
            'breadcrumb' => 'venta',
            'page_header' => 'Ventas',
            'list_title' => 'venta',
            'nameform' => 'venta',
            'titleform' => 'Administración de Ventas',
            'barra' => 'sidebar',
            'fecha' => $fecha,
            'id' => $this->Data->id,
            'idclienteproveedor' => $this->Data->listarTabla('cliente_proveedor'),
            'idempleado' => $this->Data->listarTabla('empleado'),
            'idproducto' => $this->Data->buscarProductoInventario(),
            'txt' => 'venta'
        );
        $this->load->view('venta', $data);
    }

    public function listardetalle2() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $data = array(
                    'data' => $this->Data->listarDetalle2($_GET['idtransaccion'])
                );
                echo json_encode($data);
            } catch (Exception $ex) {
                echo '{"resp":false,"sms":"' . $ex->getMessage() . '"}';
            }
        } else {
            //echo 'No posee permiso para estar aquí!!!!!!';
            show_404();
        }
    }

    public function listar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $data = array(
                    'data' => $this->Data->listarventa()
                );
                echo json_encode($data);
            } catch (Exception $ex) {
                echo '{"resp":false,"sms":"' . $ex->getMessage() . '"}';
            }
        } else {
            //echo 'No posee permiso para estar aquí!!!!!!';
            show_404();
        }
    }

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //acciones por POST
            $post = (object) $_POST;
            try {
                $estado = TRUE;
                $str = '';
                $json = json_decode($_POST["c"]);
                $tamanioList = count($json);
                for ($i = 0; $i < $tamanioList; $i++) {
                    $str .= $this->Data->id . '=' . ($json[$i]->idventa) . (($i + 1) == $tamanioList ? '' : ' or ');
                }
                $estado = $this->Data->eliminarList($str);
                echo ($estado != 1 ? ($estado == FALSE ? '{"resp" : false,"error":"Dato no eliminado"}' : '{"resp" : false,"error":"' . $estado . '"}') : '{"resp" : true}');
                //echo json_encode($str);
            } catch (Exception $ex) {
                echo '{"resp":false,"sms":"' . $ex->getMessage() . '"}';
            }
        } else {
            //echo 'No posee permiso para estar aquí!!!!!!';
            show_404();
        }
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            /*
             * 
             * 
              echo '{"resp" : false,'
              . '"error" : "El registro no se guardó!!"}';
             */
            $json = json_decode($_POST['planificacion']);
            $detalle = ($json->detplanificacion);
            $fecha = $json->fecha;
            $idclienteproveedor = $json->idclienteproveedor;
            $data = array(
                'idclienteproveedor' => $idclienteproveedor,
                'idempleado' => $this->session->userdata('idempleado'),
                'fecha' => $fecha
            );
            $idventa = $this->Data->crearVC($data);

            $sql = 'INSERT INTO detalleventa(idventa,idproducto, cantidad, precio) values';
            for ($i = 0; $i < count($detalle); $i++) {
                $ins = $detalle[$i];
                $sql .= '(' . $idventa . ',' . $ins->idinventario . ', ' . $ins->cantidad . ', ' . $ins->valor . ')' . ((count($detalle) == $i + 1) ? ' ' : ' ,');
                //$this->Data->sql('call inventarioitemventa('.$ins->idinventario.','.$ins->cantidad.');');
            }
            $this->Data->sql($sql);
            echo '{"resp" : true,"idventa":"' . $idventa . '"}';
        } else {
            //echo 'No posee permiso para estar aquí!!!!!!';
            show_404();
        }
    }

    public function factura() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            try {
                $dat = $this->Data->facturapdf($_GET['idventa']);
                $detalle = $this->Data->facturaDetpdf($_GET['idventa']);
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
                $mpdf->writeHTML(file_get_contents(base_url() . 'static/html/style.css?v=1'), \Mpdf\HTMLParserMode::HEADER_CSS);
                date_default_timezone_set('America/Guayaquil');
                setlocale(LC_ALL, 'es_ES');
                $fecha = strftime("%Y/%m/%d %H:%M:%S");
                $url = base_url();
                $htmlPage = file_get_contents(base_url() . 'static/html/factura.html');
                /* DATOS DE LA EMPRESA */
                $htmlPage = str_ireplace('{[nombre_emp]}', $this->session->userdata('empresa')[0]->nombre, $htmlPage);
                $htmlPage = str_ireplace('{[ruc_emp]}', $this->session->userdata('empresa')[0]->ruc, $htmlPage);
                $htmlPage = str_ireplace('{[telefono_emp]}', $this->session->userdata('empresa')[0]->telefono, $htmlPage);
                $htmlPage = str_ireplace('{[direccion_emp]}', $this->session->userdata('empresa')[0]->direccion, $htmlPage);
                /* FIN DATOS DE LA EMPRESA */
                /* NOMBRE DEL REPORTE */
                $htmlPage = str_ireplace('{[report_nombre]}', 'Factura N°' . $_GET['idventa'], $htmlPage);
                $htmlPage = str_ireplace('{[data_fecha]}', $_GET['fecha'], $htmlPage);
                $htmlPage = str_ireplace('{[data_empleado]}', $dat[0]->nombree . ' ' . $dat[0]->apellidoe, $htmlPage);
                $htmlPage = str_ireplace('{[data_ncliente]}', $dat[0]->nombre . ' ' . $dat[0]->apellido, $htmlPage);
                /* FIN NOMBRE DEL REPORTE */
                /* CABECERA DE LA TABLA */
                $table = '';
                $table .= '<tr>';
                $table .= '<th class="" style="width:5%"></th>';
                $table .= '<th class="" style="width:15%">Fecha</th>';
                $table .= '<th class="" style="width:25%">Producto</th>';
                $table .= '<th class="" style="width:15%">Cantidad</th>';
                $table .= '<th class="" style="width:15%">Precio</th>';
                $table .= '<th class="" style="width:15%">Valor total</th>';
                $table .= '</tr>';
                $htmlPage = str_ireplace('{[table_thead]}', $table, $htmlPage);
                $table .= '';
                /* FIN CABECERA DE LA TABLA */
                $table = '';
                $total = 0;
                for ($i = 0; $i < count($detalle); $i++) {
                    $obj = $detalle[$i];
                    $table .= '<tr>';
                    $table .= '<td class="no">' . ($i * 1 + 1) . '</td>';
                    $table .= '<td class="unit">' . $dat[0]->fecha . '</td>';
                    $table .= '<td class="qty">' . $obj->producto . '</td>';
                    $table .= '<td class="unit">N° ' . $obj->cantidad . '</td>';
                    $table .= '<td class="unit">$' . $obj->precio . '</td>';
                    $table .= '<td class="total">$' . (round($obj->cantidad * $obj->precio, 2)) . '</td>';
                    $table .= '</tr>';
                    $total = $total + round($obj->cantidad * $obj->precio, 2);
                }

                $htmlPage = str_ireplace('{[table_body]}', $table, $htmlPage);
                /* FOOTER TABLA */
                $table = '';


                $table .= '<tr>';
                $table .= '<td class="no"></td>';
                $table .= '<td class="desc"></td>';
                $table .= '<td class="qty"></td>';
                $table .= '<td class="qty"></td>';
                $table .= '<td class="unit">TOTAL:</td>';
                $table .= '<td class="total">$' . $total . '</td>';
                $table .= '</tr>';
                $htmlPage = str_ireplace('{[table_foot]}', $table, $htmlPage);

                $mpdf->writeHTML($htmlPage, \Mpdf\HTMLParserMode::HTML_BODY);
                //$mpdf->Output('reporte.pdf', 'I');
                $mpdf->Output('reporte_' . $fecha . '.pdf', 'I');
            } catch (Exception $ex) {
                echo '{"resp":false,"sms":"' . $ex->getMessage() . '"}';
            }
        } else {
            //echo 'No posee permiso para estar aquí!!!!!!';
            show_404();
        }
    }

    private function editarArray($post) {
        return array(
            'nombres' => strtoupper($post->nombres),
            'apellidos' => strtoupper($post->apellidos),
            'cedula' => ($post->cedula),
            'email' => ($post->email),
            'tipo' => "0",
            'estado' => true,
        );
    }

    public function vista() {
        $data = array(
            'title' => 'Lista de Ventas',
            'breadcrumb' => 'venta',
            'page_header' => 'Ventas',
            'list_title' => 'venta',
            'nameform' => 'venta',
            'titleform' => 'Administración de Ventas',
            'atributos' => array($this->Data->id, 'tipo', 'nombre', 'cedularucruc', 'apellido', 'estado', 'tipo'),
            'barra' => 'sidebar',
            'id' => $this->Data->id
        );
        $this->load->view('vistaventa', $data);
    }

    public function listardetalle() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $data = array(
                    'data' => $this->Data->listaVentaDet($_GET['id'])
                );
                echo json_encode($data);
            } catch (Exception $ex) {
                echo '{"resp":false,"sms":"' . $ex->getMessage() . '"}';
            }
        } else {
            //echo 'No posee permiso para estar aquí!!!!!!';
            show_404();
        }
    }

    public function detalle() {
        $data = array(
            'title' => 'Detalle de Ventas',
            'breadcrumb' => 'venta',
            'page_header' => 'Detalle de Ventas',
            'list_title' => 'venta',
            'nameform' => 'venta',
            'titleform' => 'Administración de Detalle de Ventas',
            'atributos' => array($this->Data->id, 'tipo', 'nombre', 'cedularucruc', 'apellido', 'estado', 'tipo'),
            'barra' => 'sidebar',
            'id' => 'iddetalle'
        );
        $this->load->view('detalleventa', $data);
    }

    public function eliminardetalle() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //acciones por POST
            $post = (object) $_POST;
            try {

                $this->Data->tabla = 'detalleventa';
                $estado = TRUE;
                $str = '';
                $json = json_decode($_POST["c"]);
                $tamanioList = count($json);
                for ($i = 0; $i < $tamanioList; $i++) {
                    $str .= 'iddetalle=' . ($json[$i]->iddetalle) . (($i + 1) == $tamanioList ? '' : ' or ');
                }
                $estado = $this->Data->eliminarList($str);
                echo ($estado != 1 ? ($estado == FALSE ? '{"resp" : false,"error":"Dato no eliminado"}' : '{"resp" : false,"error":"' . $estado . '"}') : '{"resp" : true}');
                //echo json_encode($str);
            } catch (Exception $ex) {
                echo '{"resp":false,"sms":"' . $ex->getMessage() . '"}';
            }
        } else {
            //echo 'No posee permiso para estar aquí!!!!!!';
            show_404();
        }
    }

}
