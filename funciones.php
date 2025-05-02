<?php
// Datos de conexión a la base de datos
$host = 'localhost';
$usuario_db = 'root'; 
$contrasena_db = ''; 
$nombre_db = 'fitconnect';

// Función para conectar a la base de datos
function conectar_db() {
    global $host, $usuario_db, $contrasena_db, $nombre_db;
    $conexion = mysqli_connect($host, $usuario_db, $contrasena_db, $nombre_db);

    if (!$conexion) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
    }

    return $conexion;
}
?>