<?php
    include_once("../Modelo/Conexion.php");
    $obgetoco = new Conexion();
    $conexion = $obgetoco->conectar();

    include_once("../Modelo/CarritoV.php");

    $opcion = $_POST['enviar'];
    $idcliente = $_POST['cliente'];
    $idrepuesto = $_POST['idrepuesto'];
    $cantidad = $_POST['cantidad1'];

    $obgetoCarrito = new CarritoV($conexion,$idcliente,$idrepuesto,$cantidad);
  echo "entra al controlador";
  echo  $opcion;
  echo $idcliente;
  
  
    
    switch($opcion){ 
        case 'Insertar':
            $obgetoCarrito->insertar();
            $mensaje = "insertado";
            break;

        case 'Eliminar':
            $obgetoCarrito->eliminar();
            $mensaje = "eliminado";
            break;
        case 'Comprar':
            $obgetoCarrito->comprar();
            $mensaje = "compra exitosa";
            break;

    }
    

    $obgetoco->desconectar($conexion);
    header("location:../Vista/FormularioCarritoV.php?msj=$mensaje");
