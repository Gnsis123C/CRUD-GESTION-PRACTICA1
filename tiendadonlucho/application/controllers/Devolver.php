<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Devolver extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Data');
        $this->Data->tabla = 'compra';
        $this->Data->id = 'idcompra';
    }

    public function index() {
        date_default_timezone_set('America/Guayaquil');
        setlocale(LC_ALL, 'es_ES');
        $fecha = strftime("%Y-%m-%d");
        if (!$this->Data->buscardevuelto($_GET['id'])->devuelto) {
            $data = array(
                'title' => 'Devolver Compras',
                'breadcrumb' => 'devolvercompra',
                'page_header' => 'Devolver Compras',
                'list_title' => 'devolvercompra',
                'nameform' => 'devolvercompra',
                'titleform' => 'Administración de Compras',
                'barra' => 'sidebar',
                'id' => $this->Data->id,
                'fecha' => $fecha,
                'idproveedor' => $this->Data->buscarProveedor($_GET['id']),
                'idproducto' => $this->Data->listaCompraDet($_GET['id']),
                'txt' => 'compra'
            );
            $this->load->view('devolucion', $data);
        } else {
            show_404();
        }
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
                    'data' => $this->Data->listarcompra()
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

    public function eliminardevol() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //acciones por POST
            $post = (object) $_POST;
            try {
                $estado = TRUE;
                $str = '';
                $str .= ' idreferencia=' . ($post->id) . '';
                $estado = $this->Data->eliminarList($str);
                $dataeditar = array(
                    'devuelto' => 0,
                );
                $this->Data->editar($dataeditar, $post->id);
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
                    $str .= $this->Data->id . '=' . ($json[$i]->idcompra) . (($i + 1) == $tamanioList ? '' : ' or ');
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
                'fecha' => $fecha,
                'tipo' => 'd',
                'motivo' => $json->motivo,
                'idreferencia' => $_GET['id']
            );
            $idventa = $this->Data->crearVC($data);

            $dataeditar = array(
                'devuelto' => 1,
            );
            $this->Data->editar($dataeditar, $_GET['id']);

            $sql = 'INSERT INTO detallecompra(idcompra,idproducto, cantidad, precio,fecha,fechaexpi,tipo) values';
            for ($i = 0; $i < count($detalle); $i++) {
                $ins = $detalle[$i];
                $sql .= '(' . $idventa . ',' . $ins->idinventario . ', ' . $ins->cantidad . ', ' . $ins->valor . ',"' . $fecha . '","' . $ins->fechaexpi . '","d")' . ((count($detalle) == $i + 1) ? ' ' : ' ,');
            }
            $this->Data->sql($sql);
            echo '{"resp" : true,"idcompra":"' . $idventa . '"}';
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
            'title' => 'Lista de Devolución',
            'breadcrumb' => 'devolucion',
            'page_header' => 'Devolución',
            'list_title' => 'devolucion',
            'idproveedor' => $this->Data->buscarProveedor($_GET['id']),
            'nameform' => 'devolucion',
            'titleform' => 'Administración de Devoluciones',
            'atributos' => array($this->Data->id, 'tipo', 'nombre', 'cedularucruc', 'apellido', 'estado', 'tipo'),
            'barra' => 'sidebar',
            'id' => $this->Data->id
        );
        $this->load->view('vistadevolucion', $data);
    }

    public function listardetalle() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $data = array(
                    'data' => $this->Data->listaDevolDet($_GET['id'])
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
            'title' => 'Detalle de Compras',
            'breadcrumb' => 'compra',
            'page_header' => 'Detalle de Compras',
            'list_title' => 'compra',
            'nameform' => 'compra',
            'titleform' => 'Administración de Detalle de Compras',
            'atributos' => array($this->Data->id, 'tipo', 'nombre', 'cedularucruc', 'apellido', 'estado', 'tipo'),
            'barra' => 'sidebar',
            'id' => 'iddetalle'
        );
        $this->load->view('detallecompra', $data);
    }

    public function eliminardetalle() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //acciones por POST
            $post = (object) $_POST;
            try {

                $this->Data->tabla = 'detallecompra';
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
