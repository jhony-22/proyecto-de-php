<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Cliente</title>
</head>
<body bgcolor="gren">
    <center>
    <header>
        <h1>Formulario Cliente</h1>
    </header>
    <table border="10">
    
        <tbody>
            <tr>
                <th scope="col">Nombre </th>
                <th scope="col">Documento </th>
                <th scope="col">Correo</th>
                <th scope="col">Telefono</th>
                <th></th>
                <th scope="col"></th>
            </tr>
    <?php
        include_once("../Modelo/Conexion.php");
        $obgetoConexion = new Conexion();
        $conexion = $obgetoConexion->conectar();

        include_once("../Modelo/Cliente.php");
        $obgetoCliente = new Cliente($conexion,0,'','','','','');
        $listaCliente = $obgetoCliente->listar(0);
        while($unregistro = mysqli_fetch_array($listaCliente)){
            echo '<tr><form id="fmodificarCliente'.$unregistro["idcliente"].'" action="../Controlador/ControladorCliente.php"
            method="post"">';
            echo '<td><input type="hidden" name="idcliente"   value="'.$unregistro['idcliente'].'">';
            echo '    <input type="text"   name="nombre"  value="'.$unregistro['nombre'].'"></td>';
            echo '<td><input type="number" name="documento" value="'.$unregistro['documento'].'"></td>';
            echo '<td><input type="email"  name="correo"   value="'.$unregistro['correo'].'"></td>';
            echo '<td><input type="number"  name="telefono"   value="'.$unregistro['telefono'].'"></td>';
            echo '<td><input type="password"  name="clave"   value="'.$unregistro['clave'].'"></td>';

            echo '<td><button type="submit" name="enviar"  value="Modificar">Modificar</button>
                      <button type="submit" name="enviar"  value="Eliminar">Eliminar</button></td>';
            echo '</form></tr>';

            
        }    
    ?>
            <tr><form id="fIngresarCliente" action="../Controlador/ControladorCliente.php" method="post">
                <td><input type="hidden" name="idcliente" value="0">
                <input type="text"  name="nombre"></td>
                <td><input type="number" name="documento"></td>
                <td><input type="email" name="correo"></td>
                <td><input type="number" name="telefono"></td>
                <td><input type="password" name="clave"></td>
                <td><button type="submit" name="enviar" value="Insertar">Insertar</button>
                    <button type="submit" name="enviar" value="Limpiar">Limpiar</button></td>
            </form></tr>
        </tbody>
    </table>
<?php
    mysqli_free_result($listaCliente);
    $obgetoConexion->desconectar($conexion);
?>
   </center> 
</body>
</html>