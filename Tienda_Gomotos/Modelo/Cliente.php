<?php
    class Cliente{
        private $_conexion;
        private $_idcliente;
        private $_nombre;
        private $_documento;
        private $_telefono;
        private $_correo;
        private $_paginacion = 10;

        function __construct($conexion,$idcliente,$nombre,$documento,$telefono,$correo){
            $this->_conexion = $conexion;
            $this->_idcliente = $idcliente;
            $this->_nombre = $nombre;
            $this->_documento = $documento;
            $this->_telefono = $telefono;
            $this->_correo = $correo;
        }
        function _get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
        }
        function insertar(){
            $sql = "insert into cliente (idcliente,nombre,documento,telefono,correo)
            values (null, '$this->_nombre','$this->_documento','$this->_telefono','$this->_correo')";
            $insertar = mysqli_query($this->_conexion,$sql);
            return $insertar;
        }
        function modificar(){
            $sql = "update cliente set nombre='$this->_nombre',
            documento='$this->_documento', telefono='$this->_telefono',
            correo='$this->_correo' where idcliente=$this->_idcliente";
            $modificar = mysqli_query($this->_conexion,$sql);
            return $modificar;
        }
        function eliminar(){
            $sql = "delete from cliente where idcliente=$this->_idcliente";
            $eliminar = mysqli_query($this->_conexion,$sql);
            return $eliminar;
        }
        function cantidadPaginas(){
            $cantidadBloques = mysqli_query($this->_conexion, "select ceil(count (idcliente)/$this->_paginacion) as cantidad from cliente")
            or die (mysqli_error($this->_conexion));
            $unRegistro = mysqli_fetch_array($cantidadBloques);
            return $unRegistro['cantidad'];
        }
        function listar($pagina){
            if($pagina<=0){
                $listado = mysqli_query($this->_conexion, "select * from cliente order by idcliente")
                or die (mysqli_error($this->_conexion));
                return $listado;
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion, "select * from cliente order by idcliente
                limit $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion)); 
                return $listado;
            }            
        }

    }