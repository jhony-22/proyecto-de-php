<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Marca</title>
</head>
<body bgcolor="gren">
    <center>
        <header>
            <h1>Formulario Marca</h1>
        </header>
        <table border="10">
            <tbody>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Modelo</th>
                    <th scope="col"></th>
                </tr>
        <?php
                    
            include_once("../Modelo/Conexion.php");
            $obgetoCone = new Conexion();
            $conexion = $obgetoCone->conectar();

            include_once("../Modelo/Marca.php");
            $obgetoMarca = new Marca($conexion,0,'','');
            $listamarca = $obgetoMarca->listar(0);
            while($unregistro = mysqli_fetch_array($listamarca)){
                echo '<tr><form id="fmodificarmarca'.$unregistro["idmarca"].'" action="../Controlador/ControladorMarca.php"
                method="post"">';
                echo '<td><input type="hidden" name="idmarca"   value="'.$unregistro['idmarca'].'">';
                echo '    <input type="text"   name="nombre"  value="'.$unregistro['nombre'].'"></td>';
                echo '<td><input type="number" name="modelo" value="'.$unregistro['modelo'].'"></td>';
                
                echo '<td><button type="submit" name="enviar"  value="Modificar">Modificar</button>
                          <button type="submit" name="enviar"  value="Eliminar">Eliminar</button></td>';
                echo '</form></tr>';          
            }    
        ?>
                <tr><form id="fIngresarmarca" action="../Controlador/ControladorMarca.php" method="post">
                    <td><input type="hidden" name="idmarca" value="0">
                    <input type="text"  name="nombre"></td>
                    <td><input type="number" name="modelo"></td>

                    <td><button type="submit" name="enviar" value="Insertar">Insertar</button>
                        <button type="submit" name="enviar" value="Limpiar">Limpiar</button></td>
                </form></tr>
            </tbody>
        </table>
    </center>
<?php
    mysqli_free_result($listamarca);
    $obgetoCone->desconectar($conexion);

?>
    
</body>
</html>