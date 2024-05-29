<?php
    class FacturaCompra{
        private $_conexion;
        private $_idfacturaC;
        private $_idproveedor;
        private $_fecha;
        private $_total;

        function __construct($conexion,$idfacturaC,$fecha,$total,$idproveedor){
            $this->_conexion = $conexion;
            $this->_idfacturaC = $idfacturaC;
            $this->_idproveedor = $idproveedor;
            $this->_fecha = $fecha;
            $this->_total = $total;
        }

        function __get($k){
            return $this->$k;
        }
        function __set($k, $v){
            $this->$k = $v;
        }
        function insertar(){
            $sql1 = "insert into factura_compra (idfacturaCompra,fecha, totalPagar, idproveedor) 
            values(null, '$this->_fecha', '$this->_total', '$this->_idproveedor')";
            echo "consulta sql1 ", $sql1;
            $insertar = mysqli_query($this->_conexion,$sql1);

            $ultimo_id = mysqli_insert_id($this->_conexion);
            return $ultimo_id;
        }
    }