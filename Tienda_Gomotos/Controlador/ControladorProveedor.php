<?php
    include_once("../Modelo/Conexion.php");
    $obgetoConex = new Conexion();
    $conexion = $obgetoConex->conectar();

    include_once("../Modelo/Proveedor.php");

    $opcion = $_POST['enviar'];
    $idproveedor =$_POST['idproveedor'];
    $nombre =$_POST['nombre'];
    $documento = $_POST['documento'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    $obgetoProveedor = new Proveedor($conexion,$idproveedor,$nombre,$documento,$telefono,$correo);

    switch($opcion){
        case 'Insertar':
            $obgetoProveedor->insertar();
            $mensaje = "insertado";
            break;

            case 'Modificar':
                $obgetoProveedor->modificar();
                $mensaje = "modificado";
                break;

                case 'Eliminar':
                    $obgetoProveedor->eliminar();
                    $mensaje = "eliminado";
                    break;
    }
    $obgetoConex->desconectar($conexion);
    header("location:../Vista/FormularioProveedor.php?msj=$mensaje");