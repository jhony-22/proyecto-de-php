<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito Ventas</title>
    <script>
        function redirigir() {
            window.location.href = "FormularioCarrito.php";
        }
    </script>
</head>
<body bgcolor="gren">

    <button type="button" onclick="redirigir()">Ir a carrito</button>
    
    <center>
        <header>
            <h1>CARRITO VENTAS</h1>
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
            $obgetoCon = new Conexion();
            $conexion = $obgetoCon->conectar();
         
            include_once("../Modelo/Repuestos.php");

            include_once("../Modelo/Marca.php");

            include_once("../Modelo/Cliente.php");

            $obgetoCliente = new Cliente($conexion,0,'','','','');
            $listaCliente = $obgetoCliente->listar(0);

            $obgetoMarca = new Marca($conexion,0,'','');
            $listamarca = $obgetoMarca->listar(0);

            $obgetoRepuesto = new Repuestos($conexion,0,'','','','','');
            $listaRepuesto = $obgetoRepuesto->listar(0);
            while($unregistro = mysqli_fetch_array($listaRepuesto)){
                echo '<tr><form id="ingresarCarrito'.$unregistro["idRepuestos"].'" action="../Controlador/ControladorCarritoV.php"
                method="post"">';
                echo '<td><input type="hidden" name="idrepuesto"   value="'.$unregistro['idRepuestos'].'">';
                echo '    <input type="text"   name="nombre"  value="'.$unregistro['nombre'].'"></td>';
                echo '<td><input type="number" name="cantidad" value="'.$unregistro['cantidad'].'"></td>';
                echo '<td><input type="text"  name="tipo"   value="'.$unregistro['tipo'].'"></td>';
                echo '<td><input type="number"  name="precio"   value="'.$unregistro['precio'].'"></td>';
                
                //desplegable para marca
                echo '<td><select name="marca">';
                while ($rowMarca = mysqli_fetch_assoc($listamarca)) {
                    echo '<option value="'.$rowMarca['idmarca'].'"';
                    if ($unregistro['idmarca'] == $rowMarca['idmarca']) {
                        echo ' selected';
                    }
                    echo '>'.$rowMarca['nombre'].'</option>';
                }
                echo '</select></td>';
                       
                echo '<td><select name="cliente">';
                        while ($rowCliente = mysqli_fetch_assoc($listaCliente)) {    
                            echo '<option value="'.$rowCliente['idcliente'].'">'.$rowCliente['nombre'].'</option>';
                        }
                        '</select>'; 
                echo '<input type="number" name="cantidad1" value="'.$unRegistro['cantidad'].'">
                    <button type="submit" name="enviar" value="Insertar">Agregar</button></td>';
                echo '</form></tr>';

                $listamarca = $obgetoMarca->listar(0);
                $listaCliente = $obgetoCliente->listar(0);
               
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
                        <th>IdCliente</th>
                        <th>IdRepuesto</th>
                        <th>Cantidad</th>
                        <th></th>
                    </tr>
            <?php
                include_once("../Modelo/Conexion.php");
                $obgetoCon = new Conexion();
                $conexion = $obgetoCon->conectar();

                include_once("../Modelo/CarritoV.php");
                $obgetoCarrito = new CarritoV($conexion,'','','');
                $listarcarrito = $obgetoCarrito->listar(0);
                while($unregistro = mysqli_fetch_array($listarcarrito)){
                    echo '<tr><form id="ingresarCarrito'.$unregistro["idcliente"].'" action="../Controlador/ControladorCarritoV.php"
                    method="post"">';
                    echo '<td><input type="number" name="cliente"   value="'.$unregistro['idcliente'].'"></td>';
                    echo '<td><input type="number"   name="idrepuesto"  value="'.$unregistro['idRepuestos'].'"></td>';
                    echo '<td><input type="number" name="cantidad1" value="'.$unregistro['cantidad'].'"></td>';

                    echo '<td><button type="submit" name="enviar"  value="Eliminar">Eliminar</button></td>';
                }
            ?>
                </tbody>
        </table>  
        <br>
        <br>
        <br>
        <tr><form id="fIngresarfq" action="../Controlador/ControladorCarritoV.php" method="post">
                    <td><button type="submit" name="enviar" value="Comprar">Nueva Venta</button></td>
                </form></tr>
        
    </center>
    
</body>
</html>