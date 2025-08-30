<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frame extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Data');
        $this->Data->tabla = 'cliente_proveedor';
        $this->Data->id = 'idclienteproveedor';
    }

    public function index() {
        show_404();
    }

    public function ingresoegreso() {
        $data = array(
            'title' => 'Reportes de ingresos y egresos de productos',
            'breadcrumb' => 'cliente',
            'page_header' => 'Clientes',
            'list_title' => 'cliente',
            'nameform' => 'cliente',
            'titleform' => 'Reportes de ingresos y egresos de productos',
            'atributos' => array($this->Data->id, 'tipo', 'nombre', 'cedularucruc', 'apellido', 'estado', 'tipo'),
            'barra' => 'sidebar',
            'id' => $this->Data->id,
            'url' => 'ingresoegreso'
        );
        $this->load->view('/data/iframe/frameingresosegreso', $data);
    }

}
