<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reporte extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Data');
        $this->Data->tabla = 'cliente_proveedor';
        $this->Data->id = 'idclienteproveedor';
    }

    public function index() {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case '1':
                    /* INGRESOS Y EGRESOS */
                    $data = array(
                        'title' => 'Reportes de ingresos y egresos de productos',
                        'breadcrumb' => 'cliente',
                        'page_header' => 'Clientes',
                        'list_title' => 'cliente',
                        'nameform' => 'cliente',
                        'action' => $_GET['action'],
                        'egreso' => (isset($_GET['fi']) ? $this->Data->reporteegreso3($_GET['fi'], $_GET['ff']) : ''),
                        'ingreso' => (isset($_GET['fi']) ? $this->Data->reporteingreso2($_GET['fi'], $_GET['ff']) : ''),
                        'titleform' => 'Reportes de ingresos y egresos de productos',
                        'atributos' => array($this->Data->id, 'tipo', 'nombre', 'cedularucruc', 'apellido', 'estado', 'tipo'),
                        'barra' => 'sidebar',
                        'id' => $this->Data->id,
                        'url' => 'ingresoegreso'
                    );
                    $this->load->view('ingresosegreso', $data);
                    break;
                case '2':
                    /* INGRESOS Y EGRESOS */
                    $arrayanio;
                    $arraymes;
                    $sql = 'SELECT v.fecha,year(v.fecha) as anio,month(v.fecha) as mes, dt.cantidad,dt.precio,dt.idproducto,p.nombre  FROM detalleventa dt JOIN venta v ON( dt.idventa=v.idventa) JOIN producto p ON(p.idproducto=dt.idproducto) where ';
                    if (isset($_GET['anio']) && isset($_GET['mes'])) {
                        $arrayanio = explode(',', $_GET['anio']);
                        $arraymes = explode(',', $_GET['mes']);
                        for ($i = 0; $i < count($arrayanio); $i++) {
                            $sql .= '(year(v.fecha)=' . $arrayanio[$i] . ' and (';
                            for ($j = 0; $j < count($arraymes); $j++) {
                                $sql .= ' month(v.fecha)=' . $arraymes[$j] . (($j + 1) == count($arraymes) ? '' : ' or ');
                            }
                            $sql .= '))' . (($i + 1) == count($arrayanio) ? '' : ' or ') . '';
                        }
                        $sql = $this->Data->reporteventas($sql);
                    } else {
                        $sql = '';
                    }
                    $sql2 = 'SELECT year(v.fecha) as year, sum(dt.precio)as income, (sum(dt.precio)*2) as expenses  FROM detalleventa dt JOIN venta v ON( dt.idventa=v.idventa) JOIN producto p ON(p.idproducto=dt.idproducto) where ';
                    if (isset($_GET['anio']) && isset($_GET['mes'])) {
                        $arrayanio2 = explode(',', $_GET['anio']);
                        $arraymes2 = explode(',', $_GET['mes']);
                        for ($i = 0; $i < count($arrayanio2); $i++) {
                            $sql2 .= '(year(v.fecha)=' . $arrayanio[$i] . ' and (';
                            for ($j = 0; $j < count($arraymes2); $j++) {
                                $sql2 .= ' month(v.fecha)=' . $arraymes2[$j] . (($j + 1) == count($arraymes2) ? '' : ' or ');
                            }
                            $sql2 .= '))' . (($i + 1) == count($arrayanio2) ? '' : ' or ') . '';
                        }
                        $sql2 = $this->Data->reporteventas($sql2 . ' GROUP BY year(v.fecha)');
                    } else {
                        $sql2 = '';
                    }

                    $data = array(
                        'title' => 'Reporte de ventas',
                        'breadcrumb' => 'cliente',
                        'page_header' => 'Clientes',
                        'list_title' => 'cliente',
                        'nameform' => 'cliente',
                        'sql' => $sql,
                        'sql2' => $sql2,
                        'action' => $_GET['action'],
                        'egreso' => (isset($_GET['fi']) ? $this->Data->reporteegreso2($_GET['fi'], $_GET['ff']) : ''),
                        'ingreso' => (isset($_GET['fi']) ? $this->Data->reporteingreso2($_GET['fi'], $_GET['ff']) : ''),
                        'titleform' => 'Reporte de ventas',
                        'atributos' => array($this->Data->id, 'tipo', 'nombre', 'cedularucruc', 'apellido', 'estado', 'tipo'),
                        'barra' => 'sidebar',
                        'id' => $this->Data->id,
                        'url' => 'ventas'
                    );
                    $this->load->view('reporteventa', $data);
                    break;
            }
        } else {
            show_404();
        }
    }

    public function ingresoegreso() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $fi = $_POST['fi'];
                $ff = $_POST['ff'];
                $data = array(
                    'ingreso' => $this->Data->reporteingreso($fi, $ff),
                    'egreso' => $this->Data->reporteegresovista($fi, $ff)
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

    public function ventas() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $fi = $_POST['fi'];
                $ff = $_POST['ff'];
                $data = array(
                    'ingreso' => $this->Data->reporteingreso($fi, $ff),
                    'egreso' => $this->Data->reporteegreso($fi, $ff)
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

    public function mejorproducto() {
        if ($this->session->userdata('tipo')) {
            $data = array(
                'title' => 'Mejores productos de compras y ventas',
                'breadcrumb' => 'mejorproducto',
                'page_header' => 'mejorproducto',
                'list_title' => 'mejorproducto',
                'nameform' => 'mejorproducto',
                'titleform' => '',
                'barra' => 'sidebar',
                'id' => $this->Data->id
            );
            $this->load->view('mejorproducto', $data);
        }else{
            show_404();
        }
    }

    public function mejorproductolist() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $fi = $_POST['fi'];
                $ff = $_POST['ff'];
                $data = array(
                    'venta' => $this->Data->mejorProductoVenta($fi, $ff),
                    'compra' => $this->Data->mejorProductoCompra($fi, $ff)
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

    public function menosvendidos() {
        if ($this->session->userdata('tipo')) {
            $data = array(
                'title' => 'Compras y ventas de productos menos vendidos',
                'breadcrumb' => 'menosvendidos',
                'page_header' => 'menosvendidos',
                'list_title' => 'menosvendidos',
                'nameform' => 'menosvendidos',
                'titleform' => '',
                'barra' => 'sidebar',
                'id' => $this->Data->id
            );
            $this->load->view('menosvendidos', $data);
        }else{
            show_404();
        }
    }

    public function menorproductolist() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $fi = $_POST['fi'];
                $ff = $_POST['ff'];
                $data = array(
                    'venta' => $this->Data->menorProductoVenta($fi, $ff),
                    'compra' => $this->Data->menorProductoCompra($fi, $ff)
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

    public function comparativoventapormes() {
        if ($this->session->userdata('tipo')) {
            $data_resp = array(
                'resp' => true
            );
            if (isset($_GET['mes'])==true && isset($_GET['anio'])==true) {
                $data_resp = array(
                    'resp' => true,
                    'dat' => $this->Data->ventaPorMes($_GET['mes'],$_GET['anio'])
                );
            }else{
                $data_resp = array(
                    'resp' => false
                );
            }
            $data = array(
                'title' => 'Comparativo ventas por mes',
                'breadcrumb' => 'comparativoventapormes',
                'page_header' => 'comparativoventapormes',
                'list_title' => 'comparativoventapormes',
                'nameform' => 'comparativoventapormes',
                'titleform' => '',
                'barra' => 'sidebar',
                'data_resp' => $data_resp,
                'id' => $this->Data->id
            );
            $this->load->view('comparativoventapormes', $data);
        }else{
            show_404();
        }
    }

    public function comparativoventapormeslist() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $fi = $_POST['mes'];
                echo json_encode($this->Data->ventaPorMes($fi));
            } catch (Exception $ex) {
                echo '{"resp":false,"sms":"' . $ex->getMessage() . '"}';
            }
        } else {
            //echo 'No posee permiso para estar aquí!!!!!!';
            show_404();
        }
    }

    public function ventapormesanio() {
        if ($this->session->userdata('tipo')) {
            $data_resp = array(
                'resp' => true
            );
            if (isset($_GET['mes'])==true && isset($_GET['anio'])==true) {
                $data_resp = array(
                    'resp' => true,
                    'dat' => $this->Data->ventaPorMesAnio($_GET['mes'],$_GET['anio'])
                );
            }else{
                $data_resp = array(
                    'resp' => false
                );
            }
            $data = array(
                'title' => 'Comparativo ventas por mes y año',
                'breadcrumb' => 'ventapormesanio',
                'page_header' => 'ventapormesanio',
                'list_title' => 'ventapormesanio',
                'nameform' => 'ventapormesanio',
                'titleform' => '',
                'barra' => 'sidebar',
                'data_resp' => $data_resp,
                'id' => $this->Data->id
            );
            $this->load->view('reporteventapormesanio', $data);
        }else{
            show_404();
        }
    }

    public function comparativocomprapormes() {
        if ($this->session->userdata('tipo')) {
            $data_resp = array(
                'resp' => true
            );
            if (isset($_GET['mes'])==true && isset($_GET['anio'])==true && isset($_GET['idproducto'])==true) {
                $data_resp = array(
                    'resp' => true,
                    'dat' => $this->Data->compraPorMes($_GET['mes'],$_GET['anio'],$_GET['idproducto'])
                );
            }else{
                $data_resp = array(
                    'resp' => false
                );
            }
            $data = array(
                'title' => 'Comparativo compras por mes',
                'breadcrumb' => 'comparativocomprapormes',
                'page_header' => 'comparativocomprapormes',
                'list_title' => 'comparativocomprapormes',
                'nameform' => 'comparativocomprapormes',
                'idproducto' => $this->Data->listarTabla('producto'),
                'titleform' => '',
                'barra' => 'sidebar',
                'data_resp' => $data_resp,
                'id' => $this->Data->id
            );
            $this->load->view('comparativocomprapormes', $data);
        }else{
            show_404();
        }
    }

}
