<?php
    include_once("../Modelo/Conexion.php");
    $obgetoConexion = new Conexion();
    $conexion = $obgetoConexion->conectar();

    include_once("../Modelo/Cliente.php");

    $opcion = $_POST['enviar'];
    $idcliente = $_POST['idcliente'];
    $nombre = $_POST['nombre'];
    $documento = $_POST['documento'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $obgetoCliente = new  Cliente($conexion,$idcliente,$nombre,$documento,$telefono,$correo,$clave);
    echo 'entra al insertar';
    
    switch($opcion){
        case 'Insertar':
            $obgetoCliente->insertar();
            $mensaje = 'cliente insertado';
            break;
        case 'Modificar':
            $obgetoCliente->modificar();
            $mensaje = 'cliente modificado';
            break;
        case 'Eliminar':
            $obgetoCliente->eliminar();
            $mensaje = 'cliente eliminado';
            break;
    }

    $obgetoConexion->desconectar($conexion);
    header("location:../Vista/FormularioCliente.php?msj=$mensaje");