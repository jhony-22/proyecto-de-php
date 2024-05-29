<?php

    include_once("../Modelo/Conexion.php");
    $obgetoCone = new Conexion();
    $conexion = $obgetoCone->conectar();

    include_once("../Modelo/Marca.php");

    $opcion = $_POST['enviar'];
    $idmarca = $_POST['idmarca'];
    $nombre = $_POST['nombre'];
    $modelo = $_POST['modelo'];

    $obgetoMarca = new Marca($conexion,$idmarca,$nombre,$modelo);

    switch($opcion){
        case 'Insertar':
            $obgetoMarca->insertar();
            $mensaje = "insertado";
            break;
        
        case 'Modificar':
            $obgetoMarca->modificar();
            $mensaje = "modificado";
            break;

        case 'Eliminar':
            $obgetoMarca->eliminar();
            $mensaje = "eliminado";
            break;
    }
    $obgetoCone->desconectar($conexion);
    header("location:../Vista/FormularioMarca.php?msj=$mensaje");