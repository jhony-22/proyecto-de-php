<?php
    class DetalleVenta{
        private $_conexion;
        private $_idfacturaV;
        private $_idrepuestoV;
        private $_cantidad;
        private $_preciou;
        private $_subtotal;
        private $_paginacion = 10;

        function __construct($conexion,$idfacturaV,$idrepuestoV,$cantidad,$preciou,$subtotal){
            $this->_conexion = $conexion;
            $this->_idfacturaV = $idfacturaV;
            $this->_idrepuestoV = $idrepuestoV;
            $this->_cantidad = $cantidad;
            $this->_preciou = $preciou;
            $this->_subtotal = $subtotal;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
        }
        function insertar(){
            $sql = "insert into detalle_venta (idFacturaVenta,idRepuestosVenta,precioU,sutTotal,cantidad)
            values($this->_idfacturaV, $this->_idrepuestoV, $this->_cantidad, $this->_preciou, $this->_subtotal)";
            echo "sql", $sql;
            $insertar = mysqli_query($this->_conexion,$sql);
            return $insertar;
        }
        Function listarfactura(){
            $sql = "SELECT fv.idFacturaVenta, fv.idcliente, c.nombre, fv.fecha, dv.idRepuestosVenta, r.nombre, 
            dv.cantidad, dv.precioU,dv.sutTotal, fv.totalPagar from factura_venta fv 
            inner JOIN cliente c on fv.idcliente = c.idcliente 
            inner join detalle_venta dv on fv.idFacturaVenta = dv.idFacturaVenta 
            inner join repuestos r on dv.idRepuestosVenta = r.idRepuestos; ";
            
            $listarfactura = mysqli_query($this->_conexion,$sql);
            return $listarfactura;
        }
    }
