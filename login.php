<?php
require_once 'funciones.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login_identifier = $_POST['login-usuario']; // Podría ser email o nombre de usuario
    $password = $_POST['login-contraseña'];

    $conexion = conectar_db();

    if ($conexion) {
        $login_identifier_escaped = mysqli_real_escape_string($conexion, $login_identifier);

        $query = "SELECT id_usuario, nombre_usuario, contrasena, rol FROM usuarios WHERE email = '$login_identifier_escaped' OR nombre_usuario = '$login_identifier_escaped'";
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            if (mysqli_num_rows($resultado) == 1) {
                $usuario = mysqli_fetch_assoc($resultado);
                $hashed_password = $usuario['contrasena'];

                if (password_verify($password, $hashed_password)) {
                    $_SESSION['usuario_id'] = $usuario['id_usuario'];
                    $_SESSION['nombre_usuario'] = $usuario['nombre_usuario']; // ¡Línea añadida!
                    $_SESSION['usuario_rol'] = $usuario['rol'];
                    $_SESSION['loggedin'] = true;
                    mysqli_close($conexion);
                    header("Location: rankings.php");
                    exit();
                } else {
                    $_SESSION['login_error'] = "Contraseña incorrecta.";
                }
            } else {
                $_SESSION['login_error'] = "El usuario no existe.";
            }
        } else {
            $_SESSION['login_error'] = "Error al consultar la base de datos: " . mysqli_error($conexion);
        }

        mysqli_close($conexion);
    } else {
        $_SESSION['login_error'] = "Error al conectar a la base de datos.";
    }

    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>