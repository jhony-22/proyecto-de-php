<?php
    class Marca{
        private $_conexion;
        private $_idmarca;
        private $_nombre;
        private $_modelo;
        private $_paginacion = 10;

        function __construct($conexion,$idmarca,$nombre,$modelo){
            $this->_conexion = $conexion;
            $this->_idmarca = $idmarca;
            $this->_nombre = $nombre;
            $this->_modelo = $modelo;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
        }
        function insertar(){
            $sql = "insert into marca (idmarca,nombre,modelo) 
            values(null, '$this->_nombre', '$this->_modelo')";
            $insertar = mysqli_query($this->_conexion, $sql);
            return $insertar;
        }
        function modificar(){
            $sql = "update marca set nombre='$this->_nombre',
            modelo='$this->_modelo' where idmarca=$this->_idmarca";
            $modificar = mysqli_query($this->_conexion,$sql);
            return $modificar;
        }
        function eliminar(){
            $sql = "delete from marca where idmarca=$this->_idmarca";
            $eliminar = mysqli_query($this->_conexion,$sql);
            return $eliminar;
        }
        function cantidadPaginas(){
            $cantidadBloques = mysqli_query($this->_conexion, "select ceil(count (idmarca)/$this->_paginacion) as cantidad from marca")
            or die (mysqli_error($this->_conexion));
            $unRegistro = mysqli_fetch_array($cantidadBloques);
            return $unRegistro['cantidad'];
        }
        function listar($pagina){
            if($pagina<=0){
                $listado = mysqli_query($this->_conexion, "select * from marca order by idmarca")
                or die (mysqli_error($this->_conexion));
                return $listado;
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion, "select * from marca order by idmarca
                limit $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion)); 
                return $listado;
            }
        }
    }