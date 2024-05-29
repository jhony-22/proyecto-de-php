<?php
    include_once("../Modelo/Conexion.php");
    $obgetoCon = new Conexion();
    $conexion = $obgetoCon->conectar();

    include_once("../Modelo/Repuestos.php");

    $opcion = $_POST['enviar'];
    $idrepuesto =$_POST['idrepuesto'];
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];
    $idmarca = $_POST['marca'];

    $obgetoRepuesto = new Repuestos($conexion,$idrepuesto,$nombre,$cantidad,$precio,$tipo,$idmarca);

    switch($opcion){
        case 'Insertar':
            $obgetoRepuesto->insertar();
            $mensaje = "insertado";
            break;

        case 'Modificar':
            $obgetoRepuesto->modificar();
            
            $mensaje = "modificado";
            break;

        case 'Eliminar':
            $obgetoRepuesto->eliminar();
            $mensaje = "eliminado";
            break;
    }
    $obgetoCon->desconectar($conexion);
    header("location:../Vista/FormularioRepuesto.php?msj=$mensaje");