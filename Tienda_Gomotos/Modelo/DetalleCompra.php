<?php
    class DetalleCompra{
        private $_conexion;
        private $_idfacturaC;
        private $_idrepuestoC;
        private $_cantidad;
        private $_precioU;
        private $_subtotal;

        function __construct($conexion,$idfacturaC,$idrepuestoC,$cantidad,$precioU,$subtotal){
            $this->_conexion = $conexion;
            $this->_idfacturaC = $idfacturaC;
            $this->_idrepuestoC = $idrepuestoC;
            $this->_cantidad = $cantidad;
            $this->_precioU = $precioU;
            $this->_subtotal = $subtotal;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
        }
        function insertar(){
            $sql = "insert into detalle_compra(idfacturaCompra,idRepuestosCompra,cantidad,precioU,subTotal)
            values($this->_idfacturaC, $this->_idrepuestoC, $this->_cantidad, $this->_precioU, $this->_subtotal)";
            echo $sql;
            $insertar = mysqli_query($this->_conexion,$sql);
            return $insertar;
        }
      
            
    }