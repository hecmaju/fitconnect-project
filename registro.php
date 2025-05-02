<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'funciones.php';
$conexion = conectar_db();
echo "¡El script registro.php se ha iniciado!<br>";

if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

echo "Conexión a la base de datos exitosa.<br>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Se ha recibido una petición POST.<br>";
    // Añades estas líneas justo antes de la primera validación ($_POST['nombre'], etc.)
    echo "Variables POST recibidas:<br>";
    var_dump($_POST);
    echo "<br>";

    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $email = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contraseña'] ?? '';
    $fecha_nacimiento = $_POST['fecha-nacimiento'] ?? null;
    $actividades = $_POST['actividades'] ?? [];
    $fecha_alta = date('Y-m-d H:i:s');
    $rol = 'usuario';
    $nombre_usuario = $_POST['nombre_usuario'] ?? '';
    $errores = [];
    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    }
    if (empty($apellidos)) {
        $errores[] = "Los apellidos son obligatorios.";
    }
    if (empty($email)) {
        $errores[] = "El email es obligatorio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El formato del email no es válido.";
    }
    if (empty($contrasena)) {
        $errores[] = "La contraseña es obligatoria.";
    } elseif (strlen($contrasena) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }
    if (empty($actividades)) {
        $errores[] = "Debes seleccionar al menos una actividad.";
    }
    if (empty($nombre_usuario)) {
        $errores[] = "El nombre de usuario es obligatorio.";
    } elseif (strlen($nombre_usuario) < 3) {
        $errores[] = "El nombre de usuario debe tener al menos 3 caracteres.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $nombre_usuario)) {
        $errores[] = "El nombre de usuario solo puede contener letras, números y guiones bajos.";
    }
    if (empty($errores)) {
        if ($conexion) {
            $email_escapado = mysqli_real_escape_string($conexion, $email);
            $check_email_query = "SELECT email FROM usuarios WHERE email = '$email_escapado'";
            $check_email_result = mysqli_query($conexion, $check_email_query);

            $nombre_usuario_escapado = mysqli_real_escape_string($conexion, $nombre_usuario);
            $check_nombre_usuario_query = "SELECT nombre_usuario FROM usuarios WHERE nombre_usuario = '$nombre_usuario_escapado'";
            $check_nombre_usuario_result = mysqli_query($conexion, $check_nombre_usuario_query);

            if (mysqli_num_rows($check_email_result) > 0) {
                $errores[] = "El email ya está registrado.";
            }
            if (mysqli_num_rows($check_nombre_usuario_result) > 0) {
                $errores[] = "El nombre de usuario ya está en uso.";
            }

            if (empty($errores)) {
                $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

                $insert_user_query = "INSERT INTO usuarios (nombre, apellido, email, nombre_usuario, contrasena, fecha_nacimiento, fecha_alta, rol) VALUES (
                    '" . mysqli_real_escape_string($conexion, $nombre) . "',
                    '" . mysqli_real_escape_string($conexion, $apellidos) . "',
                    '$email_escapado',
                    '$nombre_usuario_escapado',
                    '$hashed_password',
                    " . ($fecha_nacimiento ? "'" . mysqli_real_escape_string($conexion, $fecha_nacimiento) . "'" : 'NULL') . ",
                    '$fecha_alta',
                    '$rol'
                )";
                if (!mysqli_query($conexion, $insert_user_query)) {
                    echo "Error al insertar usuario: " . mysqli_error($conexion);
                    die();
                } else {
                    $user_id = mysqli_insert_id($conexion);

                    $fecha_inicio = date('Y-m-d');
                    $fecha_fin = date('Y-m-d', strtotime('+1 month'));

                    foreach ($actividades as $actividad) {
                        $actividad_escapada = mysqli_real_escape_string($conexion, $actividad);
                        $insert_inscripcion_query = "INSERT INTO inscripciones (id_usuario, actividad, fecha_inicio, fecha_fin) VALUES ($user_id, '$actividad_escapada', '$fecha_inicio', '$fecha_fin')";
                        mysqli_query($conexion, $insert_inscripcion_query);
                    }

                    $_SESSION['registro_exito'] = "Registro completado con éxito. Ya puedes iniciar sesión.";
                    header("Location: index.php");
                    exit();
                }
            }
        } else {
            $errores[] = "Error al conectar a la base de datos.";
        }
    }

    if (!empty($errores)) {
        $_SESSION['registro_errores'] = $errores;
        header("Location: contactos.php");
        exit();
    }
} else {
    header("Location: contactos.php");
    exit();
}
?>