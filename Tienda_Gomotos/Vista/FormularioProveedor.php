<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Proveedor</title>
</head>
<body bgcolor="gren">
    <center>
        <header>
            <h1>Formulario Proveedor</h1>
        </header>
        <table border="10">

            <tbody>
                
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col"></th>
                </tr>
        
        <?php
            include_once("../Modelo/Conexion.php");
            $obgetoConex = new Conexion();
            $conexion = $obgetoConex->conectar();

            include_once("../Modelo/Proveedor.php");
            $obgetoProveedor = new Proveedor($conexion,0,'','','','');
            $listaproveedor = $obgetoProveedor->listar(0);
            while($unregistro = mysqli_fetch_array($listaproveedor)){
                echo '<tr><form id="fmodificarproveedor'.$unregistro["idproveedor"].'" action="../Controlador/ControladorProveedor.php"
                method="post"">';
                echo '<td><input type="hidden" name="idproveedor"   value="'.$unregistro['idproveedor'].'">';
                echo '    <input type="text"   name="nombre"  value="'.$unregistro['nombre'].'"></td>';
                echo '<td><input type="number" name="documento" value="'.$unregistro['documento'].'"></td>';
                echo '<td><input type="email"  name="correo"   value="'.$unregistro['correo'].'"></td>';
                echo '<td><input type="number"  name="telefono"   value="'.$unregistro['telefono'].'"></td>';
                
                echo '<td><button type="submit" name="enviar"  value="Modificar">Modificar</button>
                          <button type="submit" name="enviar"  value="Eliminar">Eliminar</button></td>';
                echo '</form></tr>';          
            }    
        ?>
                <tr><form id="fIngresarproveedor" action="../Controlador/ControladorProveedor.php" method="post">
                    <td><input type="hidden" name="idproveedor" value="0">
                    <input type="text"  name="nombre"></td>
                    <td><input type="number" name="documento"></td>
                    <td><input type="email" name="correo"></td>
                    <td><input type="number" name="telefono"></td>
                    <td><button type="submit" name="enviar" value="Insertar">Insertar</button>
                        <button type="submit" name="enviar" value="Limpiar">Limpiar</button></td>
                </form></tr>

            </tbody>
        </table>
<?php
    mysqli_free_result($listaproveedor);
    $obgetoConex->desconectar($conexion);

?>
    </center>
    
</body>
</html>