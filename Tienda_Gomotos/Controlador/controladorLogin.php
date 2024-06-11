<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];

    // Incluir la conexión a la base de datos
    include_once("../Modelo/Conexion.php");
    $objetocone = new Conexion();
    $conexion = $objetocone->conectar();

    // Escapar el correo para evitar inyecciones SQL
    $correo = mysqli_real_escape_string($conexion, $correo);

    // Incluir la clase login
    include_once("../Modelo/login.php");
    $objetoLogin = new login($conexion, $correo, $clave);

    $verificar = $objetoLogin->verificar();

    // Desconectar de la base de datos
    $objetocone->desconectar($conexion);

    // Redirigir según el resultado de la verificación
    if ($verificar) {
        // Iniciar sesión y almacenar datos del usuario
        session_start();
        $_SESSION['usuario'] = $verificar;
        header("Location: ../Vista/FormularioCarritoV.php");
    } else {
        header("Location: ../Vista/index.php?mensaje=incorrecto");
    }
    exit();
} else {
    header("Location: ../Vista/index.php");
    exit();
}
?>
