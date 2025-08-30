<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empresa extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Data');
        $this->Data->tabla = 'empresa';
        $this->Data->id = 'idempresa';
    }

    public function index() {
        if ($this->session->userdata('tipo')) {
            $data = array(
                'title' => 'Empresa',
                'breadcrumb' => 'empresa',
                'page_header' => 'empresa',
                'img' => base_url() . 'static/img/prestacion.png',
                'list_title' => 'empresa',
                'nameform' => 'empresa',
                'idtipoproducto' => $this->Data->listarTabla('tipoproducto'),
                'titleform' => 'Administración de Empresa',
                'atributos' => array($this->Data->id, 'tipo', 'nombre', 'cedularucruc', 'apellido', 'estado', 'tipo', 'precio'),
                'barra' => 'sidebar',
                'id' => $this->Data->id
            );
            $this->load->view('empresa', $data);
        } else {
            show_404();
        }
    }

    public function listar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $data = array(
                    'data' => $this->Data->listar()
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

    public function validar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //acciones por POST
            $post = (object) $_POST;
            if ($post->id == '0') {
                echo json_encode(array('valid' => !$this->Data->existe(strtoupper($post->nombre), 'nombre')));
                exit();
            } else {
                echo json_encode(array('valid' => !$this->Data->existeEditar_(strtoupper($post->nombre), $post->id, 'nombre')));
                exit();
            }
        } else {
            //echo 'No posee permiso para estar aquí!!!!!!';
            show_404();
        }
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = (object) $_POST;
            $data = $this->editarArray($post);
            switch ($post->action) {
                case 'add':
                    if ($this->Data->crear($data)) {
                        echo '{"resp" : true}';
                        exit();
                    } else {
                        echo '{"resp" : false,'
                        . '"error" : "El registro no se guardó!!"}';
                        exit();
                    }
                    break;
                case 'edit':
                    if ($this->Data->editar($data, $post->id)) {
                        echo '{"resp" : true}';
                        exit();
                    } else {
                        echo '{"resp" : false,'
                        . '"error" : "El registro no se guardó!!"}';
                        exit();
                    }
                    break;

                default:
                    break;
            }
        }
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = (object) $_POST;
            $data = $this->editarArray($post);
            if ($this->Data->editar($data, $post->id)) {
                echo '{"resp" : true}';
                exit();
            } else {
                echo '{"resp" : false,'
                . '"error" : "El registro no se guardó!!"}';
                exit();
            }
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
                    $str .= $this->Data->id . '=' . ($json[$i]->idproducto) . (($i + 1) == $tamanioList ? '' : ' or ');
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

    private function editarArray($post) {
        return array(
            'nombre' => strtoupper($post->nombre),
            'telefono' => ($post->telefono),
            'direccion' => ($post->direccion),
            'ruc' => ($post->ruc)
        );
    }

}
