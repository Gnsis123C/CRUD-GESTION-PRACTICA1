<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Data');
        $this->Data->tabla = 'empleado';
        $this->Data->id = 'idempleado';
    }

    public function index() {
        $data = array(
            'title' => 'Login',
            'breadcrumb' => 'Login',
            'page_header' => 'Login',
            'list_title' => 'Login',
            'nameform' => 'login',
            'titleform' => 'Administración del login'
        );
        $this->load->view('login', $data);
    }

    public function iniciar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //acciones por POST
            $post = (object) $_POST;
            if (trim($post->usuario) != "" && trim($post->pass) != "") {
                $user = $this->Data->buscarLogin($post->usuario);
                if ($user != FALSE && $user != NULL) {
                    if (($user->pass) == $post->pass) {
                        $sessionData = array(
                            'username' => $user->username,
                            'nombre' => $user->nombre,
                            'pass' => $user->pass,
                            'idempleado' => $user->idempleado,
                            'crear' => $user->crear,
                            'editar' => $user->editar,
                            'eliminar' => $user->eliminar,
                            'tipo' => $user->tipo,
                            'empresa' => $this->Data->listarTabla('empresa')
                        );
                        $this->session->set_userdata($sessionData);
                        echo '{"resp":true}';
                    } else {
                        echo '{"resp":false,"msj":"Datos enviados no válido"}';
                    }
                } else {
                    echo '{"resp":false,"msj":"Datos enviados no válido"}';
                }
            } else {
                echo '{"resp":false,"msj":"Datos enviados no válido"}';
            }
        } else {
            show_404();
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url() . 'login');
    }

    public function reset() {
        $data = array(
            'title' => 'Cambiar Contraseña',
            'breadcrumb' => 'Reset',
            'page_header' => 'Reset',
            'list_title' => 'Reset',
            'nameform' => 'pass',
            'titleform' => 'Cambio de pass'
        );
        $this->load->view('pass', $data);
    }

    public function cambiarpass() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $post = (object) $_POST;
                $data = array(
                    'pass' => ($post->pwd)
                );
                if ($this->Data->editar($data, $post->id)) {
                    $this->logout();
                    exit();
                } else {
                    echo '{"resp" : false,'
                    . '"error" : "El registro no se guardó!!"}';
                    exit();
                }
            } catch (Exception $ex) {
                echo '{"resp":false,"sms":"' . $ex->getMessage() . '"}';
            }
        } else {
            //echo 'No posee permiso para estar aquí!!!!!!';
            show_404();
        }
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['pass'])) {
                $data = array(
                    'username' => 'admin',
                    'pass' => ('asdfg12345'),
                    'name' => 'Administrador Web'
                );
                if ($this->Data->crear($data)) {
                    echo '{"resp" : true}';
                    exit();
                } else {
                    echo '{"resp" : false,'
                    . '"error" : "El registro no se guardó!!"}';
                    exit();
                }
            }
        }
    }

}
