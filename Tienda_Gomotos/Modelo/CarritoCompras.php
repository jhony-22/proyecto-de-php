<?php
    class CarritoCompras{
        private $_conexion;
        private $_cantidad;
        private $_idproveedor;
        Private $_repuesto;

        function __construct($conexion,$cantidad,$idproveedor,$repuesto){
            $this->_conexion = $conexion;
            $this->_cantidad = $cantidad;
            $this->_idproveedor = $idproveedor;
            $this->_repuesto = $repuesto;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
        }
        
        
        function insertar(){
            $sql = "INSERT INTO carrito_compras(cantidad,idproveedor,idRepuestos)
            values($this->_cantidad, $this->_idproveedor, $this->_repuesto)";
            echo $sql;
            $insertar = mysqli_query($this->_conexion,$sql);
            return $insertar;
        }
        function eliminar(){ 
            $sql = "DELETE FROM carrito_compras WHERE idRepuestos = $this->_repuesto";
            
            $eliminar = mysqli_query($this->_conexion,$sql);
            return $eliminar;
        }
        function listarcarrito(){
            $listado = mysqli_query($this->_conexion, "select * from carrito_compras order by idproveedor")
                or die (mysqli_error($this->_conexion));
                return $listado;
        }
        function comprar($idPro){

            function obtenerFecha() {
                return date('Y-m-d');
            }
            $fechaActual = obtenerFecha();

            $sqlCarrito = "SELECT * FROM `carrito_compras` ";
            $lcarrito = mysqli_query($this->_conexion,$sqlCarrito);

            include_once("../Modelo/FacturaCompra.php");
            $obgetoFaC = new FacturaCompra($this->_conexion,0,$fechaActual,"",$idPro);
            $idfC = $obgetoFaC->insertar();
            echo "idfactura compra".$idfC;  
            

            while($unregistro = mysqli_fetch_array($lcarrito)){
                echo "id proveedor ". $unregistro["idproveedor"];            
            }

            $sql = "SELECT c.idRepuestos, c.cantidad, r.precio from
            carrito_compras c
            INNER JOIN repuestos r on c.idRepuestos = r.idRepuestos
            ORDER by c.idproveedor";

            $total = 0;

            $listado = mysqli_query($this->_conexion,$sql);



            while($unregistro = mysqli_fetch_array($listado)){

                $subTotal = $unregistro['cantidad'] * $unregistro['precio'];

                $total += $subTotal;
            
            echo "Proveedor: ".$unregistro["idproveedor"] .",ID Repuesto: " . $unregistro["idRepuestos"] . ", Precio: " . $unregistro['precio'] 
                    . ", Cantidad: " . $unregistro['cantidad'] .", Subtotal: ". $subTotal . " <br>";
            }
            echo "total", $total;
            exit;
        }
    }
