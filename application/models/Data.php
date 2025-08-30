<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of empresa
 *
 * @author
 */
class Data extends CI_Model {

    public $tabla;
    public $id;

    public function __construct() {
        
    }

    public function idcliente($idtransaccion) {
        $maxid = 0;
        $row = $this->db->query('SELECT idcliente FROM transaccion where idtransac=' . $idtransaccion)->row();
        if ($row) {
            $maxid = $row->idcliente;
        }
        return $maxid;
    }

    public function maxid($tabla, $id) {
        $maxid = 0;
        $row = $this->db->query('SELECT MAX(' . $id . ') AS `maxid` FROM ' . $tabla)->row();
        if ($row) {
            $maxid = $row->maxid;
        }
        return $maxid;
    }

    public function sql($sql) {
        $this->db->query($sql);
        return true;
    }

    public function eliminarList($str) {
        try {
            $sql = 'delete from ' . $this->tabla . ' where ' . $str;
            $this->db->query($sql);
            return true;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function buscar($data) {
        try {
            $this->db->select('*');
            $this->db->from($this->tabla);
            $this->db->where($data);
            $consulta = $this->db->get();
            $resultado = $consulta->row();
            return ($resultado == NULL) ? false : $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function crear($data) {
        try {
            $this->db->insert($this->tabla, $data);
            return ($this->db->affected_rows() > 0) ? true : false;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function existe($name, $text) {
        try {
            $this->db->select();
            $this->db->from($this->tabla);
            $this->db->where($text, $name);
            $resultado = $this->db->get();
            return ($resultado->num_rows() > 0) ? true : false;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function editar($data, $id) {
        try {
            $this->db->where($this->id, $id);
            $this->db->update($this->tabla, $data);
            return ($this->db->affected_rows() > 0) ? true : false;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function eliminar($id) {
        try {
            $this->db->where($this->id, $id);
            $this->db->delete($this->tabla);
            return ($this->db->affected_rows() > 0) ? true : false;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function buscarlistar($tabla, $attr, $attrRsp) {
        try {
            $this->db->select('*');
            $this->db->from($tabla);
            $this->db->where($attr, $attrRsp);
            $consulta = $this->db->get();
            $resultado = $consulta->result_array();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function existeEditar_($nombre, $id, $strnombre) {
        $resultado = $this->db->query('select*from ' . $this->tabla . ' where ' . $this->id . '!=' . $id . ' and ' . $strnombre . '="' . $nombre . '"');
        return ($resultado->num_rows() > 0) ? true : false;
    }

    public function listarUsuario() {
        try {
            $this->db->select('*');
            $this->db->from($this->tabla);
            $this->db->where('nickname<>"admin"');
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result_array();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function listarEmpleado() {
        try {
            $this->db->select('*');
            $this->db->from($this->tabla);
            $this->db->where('username!="admin"');
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result_array();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function listarClienteProveedor($tipo) {
        try {
            $this->db->select('*');
            $this->db->from($this->tabla);
            $this->db->where('tipo=' . $tipo);
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result_array();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function listar() {
        try {
            $this->db->select('*');
            $this->db->from($this->tabla);
            $this->db->order_by($this->id . ' desc');
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result_array();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function listarTabla($tabla) {
        try {
            $this->db->select('*');
            $this->db->from($tabla);
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function ultimoid() {
        try {
            $resultado = $this->db->query('select max(' . $this->id . ') as num from ' . $this->tabla);
            return $resultado->result();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /*
     * Administraciòn de LOGIN
     */

    public function buscarLogin($nick) {
        try {
            $this->db->select('p.nombre, p.pass, p.username, p.crear, p.editar, p.eliminar,p.estado,p.tipo,p.idempleado');
            $this->db->from('empleado p');
            $this->db->where('p.username', $nick);
            $this->db->where('p.estado', 1);
            $resultado = $this->db->get();
            return ($resultado->num_rows() > 0) ? $resultado->row() : false;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function crearVC($data) {
        try {
            $this->db->insert($this->tabla, $data);
            return ($this->db->affected_rows() > 0) ? $this->db->insert_id() : false;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function buscarProductoInventario() {
        try {
            $this->db->select('p.idproducto,p.precio,p.nombre,p.estado, (select sum(inv.cantidad) from inventario_producto inv where inv.idproducto=p.idproducto and inv.fechaexpiracion>=now()) as cantidad,(select sum(inv.stock) from inventario_producto inv where inv.idproducto=p.idproducto and inv.fechaexpiracion>=now()) as stock');
            $this->db->from('producto p');
            $this->db->order_by('p.nombre asc');
            $consulta = $this->db->get();
            $resultado = $consulta->result_array();
            return ($resultado == NULL) ? false : $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function facturapdf($idventa) {
        try {
            $this->db->select('v.idventa,v.fecha,cp.nombre,cp.apellido,cp.cedularuc,e.nombre as nombree,e.apellido as apellidoe');
            $this->db->from('venta v');
            $this->db->join('cliente_proveedor cp', 'cp.idclienteproveedor=v.idclienteproveedor');
            $this->db->join('empleado e', 'e.idempleado=v.idempleado');
            $this->db->where('v.idventa', $idventa);
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function listarventa() {
        try {
            $this->db->select('v.idventa,v.fecha,cp.nombre,cp.apellido,cp.cedularuc,e.nombre as nombree,e.apellido as apellidoe,cp.idclienteproveedor');
            $this->db->from('venta v');
            $this->db->join('cliente_proveedor cp', 'cp.idclienteproveedor=v.idclienteproveedor');
            $this->db->join('empleado e', 'e.idempleado=v.idempleado');
            $this->db->order_by('v.idventa desc');
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result_array();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function listaVentaDet($idventa) {
        try {
            $this->db->select('v.idventa, p.nombre as producto, d.cantidad, d.precio,(d.cantidad* d.precio) as total,v.fecha,d.iddetalle');
            $this->db->from('detalleventa d');
            $this->db->join('venta v', 'v.idventa=d.idventa');
            $this->db->join('producto p', 'p.idproducto=d.idproducto');
            $this->db->where('v.idventa', $idventa);
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result_array();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function facturaDetpdf($idventa) {
        try {
            $this->db->select('v.idventa, p.nombre as producto, d.cantidad, d.precio');
            $this->db->from('detalleventa d');
            $this->db->join('venta v', 'v.idventa=d.idventa');
            $this->db->join('producto p', 'p.idproducto=d.idproducto');
            $this->db->where('v.idventa', $idventa);
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function listaDevolDet($idcompra) {
        try {
            $this->db->select('v.idcompra,p.idproducto, p.nombre as producto, d.cantidad, d.precio,(d.cantidad* d.precio) as total,v.fecha,d.iddetalle');
            $this->db->from('detallecompra d');
            $this->db->join('compra v', 'v.idcompra=d.idcompra');
            $this->db->join('producto p', 'p.idproducto=d.idproducto');
            $this->db->where('v.idreferencia', $idcompra);
            $this->db->where('v.tipo', 'd');
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result_array();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function listaCompraDet($idcompra) {
        try {
            $this->db->select('v.idcompra,p.idproducto, p.nombre as producto, d.cantidad, d.precio,(d.cantidad* d.precio) as total,v.fecha,d.iddetalle');
            $this->db->from('detallecompra d');
            $this->db->join('compra v', 'v.idcompra=d.idcompra');
            $this->db->join('producto p', 'p.idproducto=d.idproducto');
            $this->db->where('v.idcompra', $idcompra);
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result_array();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function listarcompra() {
        try {
            $this->db->select('v.idcompra,v.fecha,cp.nombre,cp.apellido,cp.cedularuc,cp.idclienteproveedor,v.tipo,v.devuelto');
            $this->db->from('compra v');
            $this->db->join('cliente_proveedor cp', 'cp.idclienteproveedor=v.idclienteproveedor');
            $this->db->where('v.tipo', 'c');
            $this->db->order_by('v.idcompra desc');
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result_array();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function buscarproductosexpirados_menu($fechainicio, $fechafin) {
        try {
            $this->db->select('p.nombre,sum(inv.stock) as stock,inv.fechaingreso,inv.fechaexpiracion,TIMESTAMPDIFF(DAY, date(now()), inv.fechaexpiracion) AS dias_transcurridos');
            $this->db->from('inventario_producto inv');
            $this->db->join('producto p', 'p.idproducto=inv.idproducto');
            $this->db->where('inv.fechaexpiracion>=date(now())');
            $this->db->group_by(array("p.idproducto", "inv.fechaexpiracion"));
            //$this->db->limit('5');
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function buscarproductosexpirados_2($fechainicio, $fechafin) {
        try {
            $this->db->select('p.nombre,sum(inv.stock) as stock,inv.fechaingreso,inv.fechaexpiracion,TIMESTAMPDIFF(DAY, date(now()), inv.fechaexpiracion) AS dias_transcurridos');
            $this->db->from('inventario_producto inv');
            $this->db->join('producto p', 'p.idproducto=inv.idproducto');
            $this->db->where('inv.fechaexpiracion>=date(now())');
            $this->db->group_by(array("p.idproducto", "inv.fechaexpiracion"));
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function buscarproductosexpirados($fechainicio, $fechafin) {
        try {
            $this->db->select('p.nombre,sum(inv.stock) as stock,inv.fechaingreso,inv.fechaexpiracion,TIMESTAMPDIFF(DAY, "' . $fechainicio . '", inv.fechaexpiracion) AS dias_transcurridos');
            $this->db->from('inventario_producto inv');
            $this->db->join('producto p', 'p.idproducto=inv.idproducto');
            $this->db->where('inv.fechaexpiracion>="' . $fechainicio . '"');
            $this->db->where('inv.fechaexpiracion<="' . $fechafin . '"');
            $this->db->group_by(array("p.idproducto", "inv.fechaexpiracion"));
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function buscarproductoscaducados($fechainicio) {
        try {
            $this->db->select('p.nombre,sum(inv.stock) as stock,inv.fechaexpiracion,inv.fechaingreso');
            $this->db->from('inventario_producto inv');
            $this->db->join('producto p', 'p.idproducto=inv.idproducto');
            $this->db->where('inv.fechaexpiracion<="' . $fechainicio . '"');
            $this->db->group_by(array("p.idproducto", "inv.fechaexpiracion"));
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function buscardevuelto($idcompra) {
        try {
            $this->db->select('v.devuelto');
            $this->db->from('compra v');
            $this->db->where('v.idcompra', $idcompra);
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->row();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function buscarProveedor($idcompra) {
        try {
            $this->db->select('cp.idclienteproveedor,cp.nombre,cp.apellido,cp.cedularuc,v.fecha');
            $this->db->from('compra v');
            $this->db->join('cliente_proveedor cp', 'cp.idclienteproveedor=v.idclienteproveedor');
            $this->db->where('v.idcompra', $idcompra);
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->row();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function reporteingreso($fi, $ff) {
        try {
            $this->db->select('inv.fechaingreso,p.nombre,inv.fechaexpiracion,inv.cantidad,inv.stock');
            $this->db->from('inventario_producto inv');
            $this->db->join('producto p', 'p.idproducto=inv.idproducto');
            $this->db->where('inv.fechaingreso>="' . $fi . '"');
            $this->db->where('inv.fechaingreso<="' . $ff . '"');
            $this->db->order_by('inv.fechaingreso desc');
            $consulta = $this->db->get();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function reporteegresovista($fi, $ff) {
        try {
            $this->db->select('v.fecha,det.cantidad,det.precio, p.nombre as nombreproducto, tp.nombre as nombretipo');
            $this->db->from('detalleventa det');
            $this->db->join('venta v', 'v.idventa=det.idventa');
            $this->db->join('producto p', 'p.idproducto=det.idproducto');
            $this->db->join('tipoproducto tp', 'tp.idtipoproducto=p.idtipoproducto');
            $this->db->where('v.fecha>="' . $fi . '"');
            $this->db->where('v.fecha<="' . $ff . '"');
            $this->db->order_by('v.fecha asc');
            $consulta = $this->db->get();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function reporteegreso($fi, $ff) {
        try {
            $this->db->select('v.fecha,det.cantidad,det.precio');
            $this->db->from('detalleventa det');
            $this->db->join('venta v', 'v.idventa=det.idventa');
            $this->db->where('v.fecha>="' . $fi . '"');
            $this->db->where('v.fecha<="' . $ff . '"');
            $this->db->order_by('v.fecha asc');
            $consulta = $this->db->get();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function reporteegreso3($fi, $ff) {
        try {
            $this->db->select('sum(det.cantidad) as total');
            $this->db->from('detalleventa det');
            $this->db->join('venta v', 'v.idventa=det.idventa');
            $this->db->where('v.fecha>="' . $fi . '"');
            $this->db->where('v.fecha<="' . $ff . '"');
            $consulta = $this->db->get();
            $resultado = $consulta->row();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function reporteegreso2($fi, $ff) {
        try {
            $this->db->select('sum(det.cantidad) as total');
            $this->db->from('detalleventa det');
            $this->db->join('venta v', 'v.idventa=det.idventa');
            $this->db->where('v.fecha>="' . $fi . '"');
            $this->db->where('v.fecha<="' . $ff . '"');
            $consulta = $this->db->get();
            $resultado = $consulta->row();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function reporteingreso2($fi, $ff) {
        try {
            $this->db->select('sum(inv.cantidad) as cantidad,sum(inv.stock)as stock');
            $this->db->from('inventario_producto inv');
            $this->db->where('inv.fechaingreso>="' . $fi . '"');
            $this->db->where('inv.fechaingreso<="' . $ff . '"');
            $consulta = $this->db->get();
            $resultado = $consulta->row();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function reporteventas($sql) {
        try {

            $consulta = $this->db->query($sql);
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function buscarproductosbajo() {
        try {
            $this->db->select('p.nombre,sum(inv.stock) as stock, sum(inv.cantidad) as cantidad');
            $this->db->from('inventario_producto inv');
            $this->db->join('producto p', 'p.idproducto=inv.idproducto');
            $this->db->where('inv.fechaexpiracion>=date(now())');
            $this->db->group_by(array("p.idproducto"));
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function listarinvetarioporproducto($fi, $ff, $idproducto) {
        try {
            $this->db->select('inv.fechaingreso,inv.fechaexpiracion, tp.nombre as tipop, inv.cantidad, inv.stock');
            $this->db->from('inventario_producto inv');
            $this->db->join('producto p', 'p.idproducto=inv.idproducto');
            $this->db->join('tipoproducto tp', 'tp.idtipoproducto=p.idtipoproducto');
            $this->db->where('inv.fechaingreso>="' . $fi . '"');
            $this->db->where('inv.fechaingreso<="' . $ff . '"');
            $this->db->where('p.idproducto', $idproducto);
            $this->db->order_by('inv.fechaingreso asc');
            $consulta = $this->db->get();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function mejorProductoVenta($fi, $ff) {
        try {
            $this->db->select('sum(dv.cantidad) as cantidad, sum(dv.precio) as precio, sum(dv.cantidad*dv.precio) as total, p.nombre, v.idventa');
            $this->db->from('detalleventa dv');
            $this->db->join('venta v', 'v.idventa=dv.idventa');
            $this->db->join('producto p', 'p.idproducto=dv.idproducto');
            $this->db->where('v.fecha>="' . $fi . '"');
            $this->db->where('v.fecha<="' . $ff . '"');
            $this->db->group_by(array("p.idproducto"));
            $this->db->order_by('sum(dv.cantidad*dv.precio) desc');
            $this->db->limit('5');
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public function mejorProductoCompra($fi, $ff) {
        try {
            $this->db->select('sum(dv.cantidad) as cantidad, sum(dv.precio) as precio, sum(dv.cantidad*dv.precio) as total, p.nombre, v.idcompra');
            $this->db->from('detallecompra dv');
            $this->db->join('compra v', 'v.idcompra=dv.idcompra');
            $this->db->join('producto p', 'p.idproducto=dv.idproducto');
            $this->db->where('v.fecha>="' . $fi . '"');
            $this->db->where('v.fecha<="' . $ff . '"');
            $this->db->group_by(array("p.idproducto"));
            $this->db->order_by('sum(dv.cantidad*dv.precio) desc');
            $this->db->limit('5');
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function menorProductoVenta($fi, $ff) {
        try {
            $this->db->select('sum(dv.cantidad) as cantidad, sum(dv.precio) as precio, sum(dv.cantidad*dv.precio) as total, p.nombre, v.idventa');
            $this->db->from('detalleventa dv');
            $this->db->join('venta v', 'v.idventa=dv.idventa');
            $this->db->join('producto p', 'p.idproducto=dv.idproducto');
            $this->db->where('v.fecha>="' . $fi . '"');
            $this->db->where('v.fecha<="' . $ff . '"');
            $this->db->group_by(array("p.idproducto"));
            $this->db->order_by('sum(dv.cantidad*dv.precio) asc');
            $this->db->limit('5');
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function menorProductoCompra($fi, $ff) {
        try {
            $this->db->select('sum(dv.cantidad) as cantidad, sum(dv.precio) as precio, sum(dv.cantidad*dv.precio) as total, p.nombre, v.idcompra');
            $this->db->from('detallecompra dv');
            $this->db->join('compra v', 'v.idcompra=dv.idcompra');
            $this->db->join('producto p', 'p.idproducto=dv.idproducto');
            $this->db->where('v.fecha>="' . $fi . '"');
            $this->db->where('v.fecha<="' . $ff . '"');
            $this->db->group_by(array("p.idproducto"));
            $this->db->order_by('sum(dv.cantidad*dv.precio) asc');
            $this->db->limit('5');
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function ventaPorMes($mes, $anio) {
        try {
            $this->db->select('sum(dv.cantidad) as cantidad, sum(dv.precio) as precio, sum(dv.cantidad*dv.precio) as total, p.nombre, v.idventa, count(*) as numero');
            $this->db->from('detalleventa dv');
            $this->db->join('venta v', 'v.idventa=dv.idventa');
            $this->db->join('producto p', 'p.idproducto=dv.idproducto');
            $this->db->where('month(v.fecha)="' . $mes . '"');
            $this->db->where('year(v.fecha)="' . $anio . '"');
            $this->db->group_by(array("p.idproducto"));
            $this->db->order_by('sum(dv.cantidad*dv.precio) desc');
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function ventaPorMesAnio($mes, $anio) {
        try {
            $this->db->select('sum(dv.cantidad) as cantidad, sum(dv.precio) as precio, sum(dv.cantidad*dv.precio) as total, p.nombre, v.idventa, count(*) as numero');
            $this->db->from('detalleventa dv');
            $this->db->join('venta v', 'v.idventa=dv.idventa');
            $this->db->join('producto p', 'p.idproducto=dv.idproducto');
            $this->db->where('month(v.fecha)="' . $mes . '"');
            $this->db->where('year(v.fecha)="' . $anio . '"');
            $this->db->group_by(array("v.idventa"));
            $this->db->order_by('sum(dv.cantidad*dv.precio) desc');
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function compraPorMes($mes, $anio, $idproducto) {
        try {
            $this->db->select('sum(dv.cantidad) as cantidad, sum(dv.precio) as precio, sum(dv.cantidad*dv.precio) as total, p.nombre, v.idcompra, count(*) as numero');
            $this->db->from('detallecompra dv');
            $this->db->join('compra v', 'v.idcompra=dv.idcompra');
            $this->db->join('producto p', 'p.idproducto=dv.idproducto');
            $this->db->where('year(v.fecha)="' . $anio . '"');
            if($mes!=0){
                $this->db->where('month(v.fecha)="' . $mes . '"');
            }
            if($idproducto!=0){
                $this->db->where('dv.idproducto',$idproducto);
            }
            $this->db->group_by(array("p.idproducto"));
            $this->db->order_by('sum(dv.cantidad*dv.precio) asc');
            $consulta = $this->db->get();
            //$resultado = $consulta->result();
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
