<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Repuestos</title>
</head>
<body bgcolor="gren">
    <center>
        <header>
            <h1>Formulario Repuestos</h1>
        </header>
        <table id="Tabla_1" border="10">
            <tbody>
                <tr>
                    <th scope="row">Nombre</th>
                    <th scope="row">Cantidad</th>
                    <th scope="row">Tipo</th>
                    <th scope="row">Precio</th>
                    <th scope="row">IdMarca</th>
                    <th scope="row">botones</th>
                     
                    
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
                echo '<tr><form id="fmodificarrepuesto'.$unregistro["idRepuestos"].'" action="../Controlador/ControladorRepuestos.php" method="post">';
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
                
                echo '<td><button type="submit" name="enviar" value="Modificar">Modificar</button>
                          <button type="submit" name="enviar" value="Eliminar">Eliminar</button></td>';
                
                echo '</form></tr>';
            }
            
                $listamarca = $obgetoMarca->listar(0);
        ?>
                <tr><form id="fIngresarrepuesto" action="../Controlador/ControladorRepuestos.php" method="post">
                    <td><input type="hidden" name="idrepuesto" value="0">
                    <input type="text"  name="nombre"></td>
                    <td><input type="number" name="cantidad"></td>
                    <td><input type="text" name="tipo"></td>
                    <td><input type="number" name="precio"></td>
                    
                    <!-- Desplegable para marca -->
                    <td>
                        <select name="marca">
                        <?php
                            while ($rowMarca = mysqli_fetch_assoc($listamarca)) {
                                echo '<option value="'.$rowMarca['idmarca'].'">'.$rowMarca['nombre'].'</option>';
                            }
                        ?>
                        </select>
                    </td>
                    
                    <td><button type="submit" name="enviar" value="Insertar">Insertar</button>
                        <button type="submit" name="enviar" value="Limpiar">Limpiar</button></td>
                    </form></tr>
            </tbody>
            
    </center>
    <?php
        mysqli_free_result($listaRepuesto);
        $obgetoCon->desconectar($conexion);
    ?>
    
</body>
</html>