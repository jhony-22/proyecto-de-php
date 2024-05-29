<?php
    class FacturaVenta{
        private $_conexion;
        private $_idfacturaV;
        private $_idcliente;
        
        private $_fecha;
        private $_total;
        private $_paginacion = 10;

        function __construct($conexion,$idfacturaV,$idcliente,$fecha,$total){
            $this->_conexion = $conexion;
            $this->_idfacturaV = $idfacturaV;
            $this->_idcliente = $idcliente;
            $this->_fecha = $fecha;
            $this->_total = $total;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
        }
        function insertar(){
            $sql = "insert into factura_venta (idFacturaVenta,idcliente,fecha,totalPagar)
            values(null, '$this->_idcliente', '$this->_fecha', '$this->_total')";
            echo "sql".  $sql;
            $insertar = mysqli_query($this->_conexion,$sql);
            $ultimo_id = mysqli_insert_id($this->_conexion);
            return $ultimo_id;
        }
        function actualizar($idf,$total){
            $sql = "update factura_venta set totalPagar=$total where idFacturaVenta=$idf";
            $actualizar = mysqli_query($this->_conexion,$sql);
            return $actualizar;
        }
    }