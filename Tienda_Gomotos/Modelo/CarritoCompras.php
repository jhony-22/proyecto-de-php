<?php
    class CarritoCompras{
        private $_conexion;
        private $_cantidad;
        private $_idproveedor;
        Private $_idrepuesto;
        private $_paginacion =10;

        function __construct($conexion,$cantidad,$idproveedor,$repuesto){
            $this->_conexion = $conexion;
            $this->_cantidad = $cantidad;
            $this->_idproveedor = $idproveedor;
            $this->_idrepuesto = $repuesto;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k, $v){
            $this-> $k = $v;
             
        }
        
        
        function insertar(){
            $sql = "INSERT INTO carrito_compras(cantidad,idproveedor,idRepuestos)
            values($this->_cantidad, $this->_idproveedor, $this->_idrepuesto)";
            echo $sql;
            $insertar = mysqli_query($this->_conexion,$sql);
            return $insertar;
        }
        function eliminardecarrito(){
            $sql = "delete from carrito_compras where idRepuestos=$this->_idrepuesto";
            $eliminar = mysqli_query($this->_conexion,$sql);
            return $eliminar;
        }
        
        function cantidadPaginas(){
            $cantidadBloques = mysqli_query($this->_conexion, "select ceil(count (idproveedor)/$this->_paginacion) as cantidad from carrito_compras")
            or die (mysqli_error($this->_conexion));
            $unRegistro = mysqli_fetch_array($cantidadBloques);
            return $unRegistro['cantidad'];
        }
        function listarcarrito($pagina){
            if($pagina<=0){
                $listado = mysqli_query($this->_conexion, "select * from carrito_compras order by idproveedor")
                or die (mysqli_error($this->_conexion));
                return $listado;
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion, "select * from carrito_compras order by idproveedor
                limit $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion)); 
                return $listado;
            }            
        }
        
        function comprar($idPro){

            function obtenerFecha() {
                return date('Y-m-d');
            }
            $fechaActual = obtenerFecha();

            $sqlCarrito = "SELECT * FROM `carrito_compras` ";
            $lcarrito = mysqli_query($this->_conexion,$sqlCarrito);         

            while($unregistro = mysqli_fetch_array($lcarrito)){
                echo "id proveedor ". $unregistro["idproveedor"];            
            }

            $sql = "SELECT c.idRepuestos, c.cantidad, r.precio from
            carrito_compras c
            INNER JOIN repuestos r on c.idRepuestos = r.idRepuestos
            ORDER by c.idproveedor";

            $total = 0;

            $listado = mysqli_query($this->_conexion,$sql);

            include_once("../Modelo/FacturaCompra.php");
            $obgetoFaC = new FacturaCompra($this->_conexion,0,$fechaActual,"",$idPro);
            $idfC = $obgetoFaC->insertar();
            echo "idfactura compra".$idfC;

            include_once("../Modelo/DetalleCompra.php");
            while($unregistro = mysqli_fetch_array($listado)){

                $subTotal = $unregistro['cantidad'] * $unregistro['precio'];
                $total += $subTotal;

                echo "ID Repuesto: " . $unregistro["idRepuestos"] . ", Precio: " . $unregistro['precio'] 
                    . ", Cantidad: " . $unregistro['cantidad'] .", Subtotal: ". $subTotal . " <br>";

                $obgetoDetalle = new DetalleCompra($this->_conexion,$idfC,$unregistro["idRepuestos"],$unregistro['precio'],
                $unregistro['cantidad'],$subTotal);

                $obgetoDetalle->insertar();

               
            }
            
            echo "total". $total;

            $obgetoFaC->actualizar($idfC,$total);

            $idpro = mysqli_real_escape_string($this->_conexion, $this->_idproveedor);

                if (!empty($idpro)) {
                    $eliminarcarrito = "DELETE FROM carrito_compras WHERE cantidad='$this->_cantidad'";
                    if (mysqli_query($this->_conexion, $eliminarcarrito)) {
                        echo "Carrito eliminado";
                    } else {
                        echo "Error al eliminar carrito: " . mysqli_error($this->_conexion);
                    }
                } else {
                    echo "cantidad no válido";
            } 
            exit;
        }
    }
