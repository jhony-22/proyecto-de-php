<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas</title>
</head>
<body bgcolor="gren">
    <center>
        <header>
            <h1>Facturas</h1>
        </header>
        <table border="10">
            <tbody>
                <tr>
                    <th>ID FACTURAS</th>
                    <th>ID CLIENTE</th>
                    <th>NOMBRE CLIENTE</th>
                    <th>FECHA</th>
                    <th>ID REPUESTOS</th>
                    <th>NOMBRE</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO U</th>
                    <th>SUBTOTAL</th>
                    <th>TOTAL </th>
                </tr>
        <?php
                include_once("../Modelo/Conexion.php");
                $objetocon = new Conexion();
                $conexion = $objetocon->conectar();

                include_once("../Modelo/DetalleVenta.php");
                $obgetoDetalle = new DetalleVenta($conexion,0,'','','','',);
                $listarfacturas = $obgetoDetalle->listarfactura();
                while ($unregistro = mysqli_fetch_array($listarfacturas)) {
                    echo '<tr>';
                    echo '<form id="flistarFacturas' . $unregistro[0] . '" action="" method="">';
                    echo '<td><input type="hidden" name="idfactura" value="' . $unregistro[0] . '"></td>';
                    echo '<td><input type="number" name="idcliente" value="' . $unregistro[1] . '"></td>';
                    echo '<td><input type="text" name="nombre" value="' . $unregistro[2] . '"></td>';
                    echo '<td><input type="date" name="nombre" value="' . $unregistro[3] . '"></td>';
                    echo '<td><input type="number" name="idrepuesto" value="' . $unregistro[4] . '"></td>';
                    echo '<td><input type="text" name="nombre" value="' . $unregistro[5] . '"></td>';
                    echo '<td><input type="number" name="cantidad" value="' . $unregistro[6] . '"></td>';
                    echo '<td><input type="number" name="precio" value="' . $unregistro[7] . '"></td>';
                    echo '<td><input type="number" name="subtotal" value="' . $unregistro[8] . '"></td>';
                    echo '<td><input type="number" name="total" value="' . $unregistro[9] . '"></td>';

                }
        ?>
        
            </tbody>
        </table>
    </center>
</body>
</html>