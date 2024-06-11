<?php
    include_once("../Modelo/Conexion.php");
    $obgetoCone = new Conexion();
    $conexion = $obgetoCone->conectar();

    include_once("../Modelo/CarritoCompras.php");

    $opcion = $_POST['Agregar'];
    $cantidad = $_POST['cantidad'] ?? null;
    $idproveedor = $_POST['proveedor'] ?? null;
    $repuesto = $_POST['idrepuesto'] ?? null;

    $obgetocarritoC = new CarritoCompras($conexion,$cantidad,$idproveedor,$repuesto);
    
    echo $opcion ;
    
    
    switch($opcion){

        case 'Insertar':
            $obgetocarritoC->insertar();
            $mensaje1 = "insertado";
            break;
        case 'eliminar':
            $obgetocarritoC->eliminardecarrito();
            
            $mensaje1 = "eliminado";
            break;        
        
        case 'Comprar':
            $obgetocarritoC->comprar(1);
            $mensaje1 = "compra exitoza";
            break;
    }
    $obgetoCone->desconectar($conexion);
    header("location:../Vista/FormularioCarritoC.php?msj=$mensaje1");