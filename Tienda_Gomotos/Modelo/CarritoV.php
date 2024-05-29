<?php
    class CarritoV{
        private $_conexion;
        private $_idcliente;
        private $_idrepuesto;
        private $_cantidad;
        private $_paginacion =10;

        function __construct($conexion,$idcliente,$idrepuesto,$cantidad){
            $this->_conexion = $conexion;
            $this->_idcliente = $idcliente;
            $this->_idrepuesto = $idrepuesto;
            $this->_cantidad = $cantidad;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k, $v){
            $this->$k = $v;
        }
        function insertar (){
            $sql = "insert into carrito_ventas (idcliente,idRepuestos,cantidad)
            values('$this->_idcliente', '$this->_idrepuesto', '$this->_cantidad')";
            $insertar = mysqli_query($this->_conexion,$sql);
            return $insertar;
        }
        function eliminar(){
            $sql = "delete from carrito_ventas where idRepuestos=$this->_idrepuesto";
            $eliminar = mysqli_query($this->_conexion,$sql);
            return $eliminar;
        }
        function cantidadPaginas(){
            $cantidadBloques = mysqli_query($this->_conexion, "select ceil(count (idcliente)/$this->_paginacion) as cantidad from carrito_ventas")
            or die (mysqli_error($this->_conexion));
            $unRegistro = mysqli_fetch_array($cantidadBloques);
            return $unRegistro['cantidad'];
        }
        function listar($pagina){
            if($pagina<=0){
                $listado = mysqli_query($this->_conexion, "select * from carrito_ventas order by idcliente")
                or die (mysqli_error($this->_conexion));
                return $listado;
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion, "select * from carrito_ventas order by idcliente
                limit $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion)); 
                return $listado;
            }            
        }
        
        
        function comprar(){
            $sql1 = "select c.idRepuestos, r.precio, c.cantidad 
            from carrito_ventas c 
            inner join repuestos r ON c.idRepuestos = r.idRepuestos 
            ORDER BY c.idcliente";
            
            function obtenerFecha() {
                return date('Y-m-d');
            }
            $fechaActual = obtenerFecha();
            

            $total = 0;

            $listado = mysqli_query($this->_conexion, $sql1);
            
            include_once("../Modelo/FacturaVenta.php");
            $objetoFactura = new FacturaVenta($this->_conexion,0,$this->_idcliente,$fechaActual,0);
            $idf = $objetoFactura->insertar();
            echo "idFactura", $idf;

            include_once("../Modelo/DetalleVenta.php");

                while($unregistro = mysqli_fetch_array($listado)){

                    $subtotal = $unregistro['precio'] * $unregistro['cantidad'];
                    
                    $objetoDetalle = new DetalleVenta($this->_conexion,$idf,$unregistro["idRepuestos"],
                    $unregistro['precio'],$subtotal ,$unregistro['cantidad']);

                    $objetoDetalle->insertar();
                    
                    $total += $subtotal;
                    
                    echo "ID Repuesto: " . $unregistro["idRepuestos"] . ", Precio: " . $unregistro['precio'] 
                    . ", Cantidad: " . $unregistro['cantidad'] .", subTotal: " . $subtotal . "<br>";
                    
                }

                echo "total". $total;
                
                $objetoFactura->actualizar($idf,$total);

                 // Consulta SQL para eliminar todos los registros de la tabla carrito
                $sqlDelete = "DELETE FROM carrito_ventas WHERE idcliente = $this->_idcliente";
                    if (mysqli_query($this->_conexion, $sqlDelete)) {
                        echo "Carrito limpiado correctamente.";
                    } else {
                        echo "Error al limpiar el carrito: " . mysqli_error($this->_conexion);
                    }
              
                exit;
        }
    }