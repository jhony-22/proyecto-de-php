<?php
    class Proveedor{
        private $_conexion;
        private $_idproveedor;
        private $_nombre;
        private $_documento;
        private $_telefono;
        private $_correo;
        private $_paginacion;

        function __construct($conexion,$idproveedor,$nombre,$documento,$telefono,$correo){
            $this->_conexion = $conexion;
            $this->_idproveedor = $idproveedor;
            $this->_nombre = $nombre;
            $this->_documento = $documento;
            $this->_telefono = $telefono;
            $this->_correo = $correo;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
        }
        function insertar(){
            $sql = "insert into proveedor (idproveedor,nombre,documento,telefono,correo)
            values(null, '$this->_nombre', '$this->_documento', '$this->_telefono', '$this->_correo')";
            $insertar = mysqli_query($this->_conexion,$sql);
            return $insertar;
        }
        function modificar(){
            $sql = "update proveedor set nombre='$this->_nombre',
            documento='$this->_documento', telefono='$this->_telefono',
            correo='$this->_correo' where idproveedor=$this->_idproveedor";
            $modificar = mysqli_query($this->_conexion,$sql);
            return $modificar;
        }
        function eliminar(){
            $sql = "delete from proveedor where idproveedor=$this->_idproveedor";
            $eliminar = mysqli_query($this->_conexion,$sql);
            return $eliminar;
        }
        function cantidadPaginas(){
            $cantidadBloques = mysqli_query($this->_conexion, "select ceil(count (idproveedor)/$this->_paginacion) as cantidad from proveedor")
            or die (mysqli_error($this->_conexion));
            $unRegistro = mysqli_fetch_array($cantidadBloques);
            return $unRegistro['cantidad'];
        }
        function listar($pagina){
            if($pagina<=0){
                $listado = mysqli_query($this->_conexion, "select * from proveedor order by idproveedor")
                or die (mysqli_error($this->_conexion));
                return $listado;
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion, "select * from proveedor order by idproveedor
                limit $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion)); 
                return $listado;
            }
        }
        
    }