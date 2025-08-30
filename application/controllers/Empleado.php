<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empleado extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Data');
        $this->Data->tabla = 'empleado';
        $this->Data->id = 'idempleado';
    }

    public function index() {
        if ($this->session->userdata('tipo')) {
            $data = array(
                'title' => 'Empleados',
                'breadcrumb' => 'empleado',
                'page_header' => 'Empleados',
                'list_title' => 'empleado',
                'nameform' => 'empleado',
                'img' => base_url() . 'static/img/empleado_1.png',
                'titleform' => 'Administración de Empleados',
                'atributos' => array($this->Data->id, 'tipo', 'nombre', 'cedularucruc', 'apellido', 'estado', 'tipo'),
                'barra' => 'sidebar',
                'id' => $this->Data->id
            );
            $this->load->view('empleado', $data);
        } else {
            show_404();
        }
    }

    public function listar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $data = array(
                    'data' => $this->Data->listarEmpleado()
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
                echo json_encode(array('valid' => !$this->Data->existe(strtoupper($post->cedula), 'cedula')));
                exit();
            } else {
                echo json_encode(array('valid' => !$this->Data->existeEditar_(strtoupper($post->cedula), $post->id, 'cedula')));
                exit();
            }
        } else {
            //echo 'No posee permiso para estar aquí!!!!!!';
            show_404();
        }
    }

    public function validaruser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //acciones por POST
            $post = (object) $_POST;
            if ($post->id == '0') {
                echo json_encode(array('valid' => !$this->Data->existe(strtoupper($post->username), 'username')));
                exit();
            } else {
                echo json_encode(array('valid' => !$this->Data->existeEditar_(strtoupper($post->username), $post->id, 'username')));
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
                    $str .= $this->Data->id . '=' . ($json[$i]->idempleado) . (($i + 1) == $tamanioList ? '' : ' or ');
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
            'apellido' => strtoupper($post->apellido),
            'cedula' => ($post->cedula),
            'telefono' => strtoupper($post->telefono),
            'tipo' => ($post->tipo),
            'estado' => ($post->estado),
            'crear' => ($post->crear),
            'editar' => ($post->editar),
            'eliminar' => ($post->eliminar),
            'username' => ($post->username),
            'pass' => ($post->pass)
        );
    }

}
