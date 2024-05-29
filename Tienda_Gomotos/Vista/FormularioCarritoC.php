<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito Compras</title>
</head>
<body bgcolor="gren">
    <center>
        <header>
            <h1>CARRITO COMPRAS</h1>
        </header>
        <table border="10">
            <tbody>
                <tr>
                    <th scope="row">Nombre</th>
                    <th scope="row">Cantidad</th>
                    <th scope="row">Tipo</th>
                    <th scope="row">Precio</th>
                    <th scope="row">IdMarca</th>
                    <th scope="row">Agregar a carrito</th>
                    
                </tr>
        <?php
            include_once("../Modelo/Conexion.php");
            $obgetoCone = new Conexion();
            $conexion = $obgetoCone->conectar();
         
            include_once("../Modelo/Repuestos.php");
            include_once("../Modelo/Marca.php");
            include_once("../Modelo/Proveedor.php");

            $obgetoProveedor = new Proveedor($conexion,0,'','','','');
            $listaproveedor = $obgetoProveedor->listar(0);

            $obgetoMarca = new Marca($conexion,0,'','');
            $listamarca = $obgetoMarca->listar(0);

            $obgetoRepuesto = new Repuestos($conexion,0,'','','','','');
            $listaRepuesto = $obgetoRepuesto->listar(0);

            while($unregistro = mysqli_fetch_array($listaRepuesto)){
                echo '<tr><form id="fmodificarrepuesto'.$unregistro["idRepuestos"].'" action="../Controlador/ControladorCarritoC.php" 
                method="post">';
                echo '<td><input type="hidden" name="idrepuesto" value="'.$unregistro['idRepuestos'].'">';
                echo '    <input type="text" name="nombre" value="'.$unregistro['nombre'].'"></td>';
                echo '<td><input type="number" name="cantidad" value="'.$unregistro['cantidad'].'"></td>';
                echo '<td><input type="text" name="tipo" value="'.$unregistro['tipo'].'"></td>';
                echo '<td><input type="number" name="precio" value="'.$unregistro['precio'].'"></td>';
                
                // Consulta para obtener las marcas
                $listamarca = $obgetoMarca->listar(0);
                // Desplegable para marca
                echo '<td><select name="marca">';
                while ($rowMarca = mysqli_fetch_assoc($listamarca)) {
                    echo '<option value="'.$rowMarca['idmarca'].'"';
                    if ($unregistro['idmarca'] == $rowMarca['idmarca']) {
                        echo ' selected';
                    }
                    echo '>'.$rowMarca['nombre'].'</option>';
                }
                echo '</select></td>';
                //recargar desplegable proveedor
                $listaproveedor = $obgetoProveedor->listar(0);
                //desplegable par aproveedor
                echo '<td><select name="proveedor">';
                    while ($rowProveedor = mysqli_fetch_assoc($listaproveedor)) {
                        echo '<option value="'.$rowProveedor['idproveedor'].'"';
                        echo '>'.$rowProveedor['nombre'].'</option>';
                    }
                    '</select>';
                
                echo '<input type="text" name="cantidad" value="'.$unRegistro['cantidad'].'">
                     <button type="submit" name="Agregar" value="Insertar" >Agregar</button></td>';
                echo '</form></tr>';
            }
        ?>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <table id="tabla_2" border="10">
            <tbody>
                <tr>
                    <th>Cantidad</th>
                    <th>Id Proveedor</th>
                    <th>Id Repuesto</th>
                    <th></th>
                </tr>
        <?php
            include_once("../Modelo/Conexion.php");
            $obgetoCone = new Conexion();
            $conexion = $obgetoCone->conectar();

            include_once("../Modelo/CarritoCompras.php");
            $obgetocarritoC = new CarritoCompras($conexion,'','','');
            $listaCarritoC = $obgetocarritoC->listarcarrito();
            while($unregistro = mysqli_fetch_array($listaCarritoC)){
                echo '<tr><form id="ingresarCarrito'.$unregistro[0].'" action="../Controlador/ControladorCarritoC.php"
                method="post"">';
                echo '<td><input type="number" name="cantidad"   value="'.$unregistro[0].'"></td>';
                echo '<td><input type="number"   name="proveedor"  value="'.$unregistro[1].'"></td>';
                echo '<td><input type="number" name="idrepuesto" value="'.$unregistro[2].'"></td>';

                echo '<td><button type="submit" name="Agregar"  value="Eliminar">Eliminar</button></td>';

                echo '</form></tr>';
            }
        ?>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <tr><form id="nuevacompra" action="../Controlador/ControladorCarritoC.php" method="post">
                <td><button type="submit" name="Agregar" value="Comprar">Nueva Compra</button></td>
       
                </form></tr>
    </center>
    
</body>
</html>