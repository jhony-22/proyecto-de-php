<?php
    class Repuestos{
        private $_conexion;
        private $_idrepuesto;
        private $_nombre;
        private $_cantidad;
        private $_precio;
        private $_tipo;
        private $_idmarca;
        private $_paginacion = 20;

        function __construct($conexion,$idrepuesto,$nombre,$cantidad,$precio,$tipo,$idmarca){
            $this->_conexion = $conexion;
            $this->_idrepuesto = $idrepuesto;
            $this->_nombre = $nombre;
            $this->_cantidad = $cantidad;
            $this->_precio = $precio;
            $this->_tipo = $tipo;
            $this->_idmarca = $idmarca;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
        }
        function insertar(){
            $sql = "insert into repuestos (idRepuestos,nombre,cantidad,tipo,precio,idmarca)
            values(null, '$this->_nombre', '$this->_cantidad', '$this->_tipo', '$this->_precio','$this->_idmarca')";
            $insertar = mysqli_query($this->_conexion,$sql);
            return $insertar;
        }
        function modificar(){
            $sql = "update repuestos set nombre='$this->_nombre', cantidad='$this->_cantidad',
            tipo='$this->_tipo', precio='$this->_precio', idmarca='$this->_idmarca'
            where idRepuestos=$this->_idrepuesto";
            echo "sql", $sql;
            
            $modificar = mysqli_query($this->_conexion,$sql);
            return $modificar;
        }
        function eliminar(){
            $sql = "delete from repuestos where idRepuestos=$this->_idrepuesto";
            $eliminar = mysqli_query($this->_conexion, $sql);
            return $eliminar;
        }
        function cantidadPaginas(){
            $cantidadBloques = mysqli_query($this->_conexion, "select ceil(count (idRepuestos)/$this->_paginacion) as cantidad from repuestos")
            or die (mysqli_error($this->_conexion));
            $unRegistro = mysqli_fetch_array($cantidadBloques);
            return $unRegistro['cantidad'];
        }
        function listar($pagina){
            if($pagina<=0){
                $listado = mysqli_query($this->_conexion, "select * from repuestos order by idRepuestos")
                or die (mysqli_error($this->_conexion));
                return $listado;
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion, "select * from repuestos order by idRepuestos
                limit $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion)); 
                return $listado;
            }
        }
    }