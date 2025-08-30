<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventario extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Data');
        $this->Data->tabla = 'inventario_producto';
        $this->Data->id = 'idinventario';
    }

    public function index() {
        $data = array(
            'title' => 'Iventario Producto',
            'breadcrumb' => 'inventario',
            'page_header' => 'Iventario Producto',
            'list_title' => 'inventario',
            'nameform' => 'inventario',
            'idproducto' => $this->Data->listarTabla('producto'),
            'img' => base_url() . 'static/img/producto.png',
            'titleform' => 'Administración de Iventario Producto',
            'atributos' => array($this->Data->id, 'tipo', 'nombre', 'cedularucruc', 'apellido', 'estado', 'tipo'),
            'barra' => 'sidebar',
            'id' => $this->Data->id
        );
        $this->load->view('inventario', $data);
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
                echo json_encode(array('valid' => !$this->Data->existe(strtoupper($post->cedularuc), 'cedularuc')));
                exit();
            } else {
                echo json_encode(array('valid' => !$this->Data->existeEditar_(strtoupper($post->cedularuc), $post->id, 'cedularuc')));
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
                    $str .= $this->Data->id . '=' . ($json[$i]->idinventario) . (($i + 1) == $tamanioList ? '' : ' or ');
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
            'idproducto' => strtoupper($post->idproducto),
            'cantidad' => ($post->stockoriginal == $post->stock ? $post->cantidad : (($post->cantidad) + ($post->stock - $post->stockoriginal))),
            'stock' => ($post->stock),
            'fechaingreso' => ($post->fechaingreso)
        );
    }

    public function ver() {
        $data = array(
            'title' => 'Iventario Producto',
            'breadcrumb' => 'inventario',
            'page_header' => 'Iventario Producto',
            'list_title' => 'inventario',
            'nameform' => 'inventario',
            'idproducto' => $this->Data->listarTabla('producto'),
            'idproductos' => $this->Data->buscarproductosbajo(),
            'img' => base_url() . 'static/img/producto.png',
            'titleform' => 'Administración de Iventario Producto',
            'atributos' => array($this->Data->id, 'tipo', 'nombre', 'cedularucruc', 'apellido', 'estado', 'tipo'),
            'barra' => 'sidebar',
            'id' => $this->Data->id
        );
        $this->load->view('inventarioporproducto', $data);
    }

    public function verlistar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $post = (object) $_POST;
                echo json_encode($this->Data->listarinvetarioporproducto($post->fi, $post->ff, $post->idproducto));
            } catch (Exception $ex) {
                echo '{"resp":false,"sms":"' . $ex->getMessage() . '"}';
            }
        } else {
            //echo 'No posee permiso para estar aquí!!!!!!';
            show_404();
        }
    }

}
