<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author 
 */
class Menu extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('zip');

        $this->load->model('Data');
        $this->Data->tabla = 'avicola';
        $this->Data->id = 'idavicola';
    }

	public function inicio() {
        $fecha = date('Y-m-j');
        $nuevafecha = strtotime('+10 day', strtotime($fecha));
        $nuevafecha = date('Y-m-j', $nuevafecha);
        $data = array(
            'title' => 'Inicio',
            'breadcrumb' => '',
            'page_header' => 'Login',
            'list_title' => 'Login',
            'nameform' => 'login',
            'fecha' => $nuevafecha,
            'datos' => $this->Data->buscarproductosexpirados_menu($fecha,$nuevafecha),
            'idempresa' => $this->Data->listarTabla('empresa')[0],
            'bajostock' => $this->Data->buscarproductosbajo(),
            'caducados' => $this->Data->buscarproductoscaducados($fecha),
            'titleform' => 'Administración del login',
            'sidebar' => 'sidebar'
        );
        $this->load->view('inicio', $data);
    }

    public function index() {
        $fecha = date('Y-m-j');
        $nuevafecha = strtotime('+10 day', strtotime($fecha));
        $nuevafecha = date('Y-m-j', $nuevafecha);
        $data = array(
            'title' => 'Inicio',
            'breadcrumb' => '',
            'page_header' => 'Login',
            'list_title' => 'Login',
            'nameform' => 'login',
            'fecha' => $nuevafecha,
            'datos' => $this->Data->buscarproductosexpirados_menu($fecha,$nuevafecha),
            'bajostock' => $this->Data->buscarproductosbajo(),
            'caducados' => $this->Data->buscarproductoscaducados($fecha),
            'titleform' => 'Administración del login',
            'sidebar' => 'sidebar'
        );
        $this->load->view('menu', $data);
    }

    public function database_backup() {
        $this->load->dbutil();
        $db_format = array('format' => 'zip', 'filename' => 'my_db_backup.sql');
        $backup = $this->dbutil->backup($db_format);
        $dbname = 'backup-' . date('Y-m-d') . '.zip';
        $save = 'static/db_backup/' . $dbname;
        write_file($save, $backup);
        force_download($dbname, $backup);
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //acciones por POST
            $post = (object) $_POST;
            $data = array(
                'nombre' => ($post->nombre),
                'ruc' => ($post->ruc),
                'direccion' => ($post->direccion),
                'telefono' => ($post->telefono),
                'email' => ($post->email)
            );
            if ($this->Data->editar($data, $post->idavicola)) {
                $this->session->set_userdata('avicola', ($this->Data->listarTabla('avicola')));
                echo '{"resp" : true}';
                exit();
            } else {
                echo '{"resp" : false,'
                . '"error" : "Tus datos no fueron guardados!!"}';
                exit();
            }
        } else {
            //echo 'No posee permiso para estar aquí!!!!!!';
            show_404();
        }
    }

}
