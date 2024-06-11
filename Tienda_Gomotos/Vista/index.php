<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            color: #333;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group input:focus {
            border-color: #007bff;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .alert {
            color: #d9534f;
            background-color: #f2dede;
            border-color: #ebccd1;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="../Controlador/controladorLogin.php" method="post">
            <div class="form-group">
                <label for="correo">Correo</label>
                <input id="correo" name="correo" type="email" maxlength="60" placeholder="nombre@correo.com" required autofocus>
            </div>
            <div class="form-group">
                <label for="clave">Contraseña</label>
                <input id="clave" name="clave" type="password" placeholder="Contraseña" required>
            </div>
            <script>
            function redirigir() {
                window.location.href = "FormularioCliente.php";
            }
        </script>

        <button type="button" onclick="redirigir()">Registrarse</button>
        <br>
        <br>
            <div class="form-group">
                <button name="enviar" type="submit" value="Validar">Ingresar</button>
            </div>
        </form>
        

        <?php
        @$mensaje = $_GET['mensaje'];
        if (isset($mensaje) && $mensaje == 'incorrecto') {
            echo '<div class="alert">Correo o clave incorrecta</div>';
        }
        ?>
    </div>
</body>
</html>

