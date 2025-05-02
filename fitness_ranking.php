<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ranking de Fitness - FitConnect</title>
    <link rel="shortcut icon" href="/imatges/barra-con-pesas-azul-2.png" type="image/ico">
    <link rel="stylesheet" href="estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="funciones.js" defer></script>
</head>
<body>
    <header class="main-header">
        <div class="container header-content" id="principio">
            <div class="logo">
                <a href="index.php"><img src="imatges/barra-con-pesas-azul-2.png" alt="Logo de FitConnect"> <span>FitConnect</span></a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Página principal</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="nutricion.php">Planes</a></li>
                    <li><a href="horario.php">Horario</a></li>
                    <?php
                    require_once 'funciones.php';
                    session_start();
                    if (isset($_SESSION['nombre_usuario'])) {
                        echo '<li class="logged-in-user">' . 'Bienvenido ' . '<br>' . htmlspecialchars($_SESSION['nombre_usuario']) . '</li>';
                        echo '<li class="logout-item"><a href="logout.php" class="logout-button">Cerrar Sesión</a></li>';
                        
                    } else {
                        header("Location: index.php");
                        exit();
                    }

                    // Procesar el formulario si se ha enviado
                    if (isset($_POST['guardar_resultado'])) {
                        if (isset($_SESSION['usuario_id']) && isset($_POST['actividad']) && isset($_POST['resultado']) && isset($_POST['ejercicio'])) {
                            $id_usuario = $_SESSION['usuario_id'];
                            $actividad = $_POST['actividad'];
                            $resultado = $_POST['resultado'];
                            $ejercicio = $_POST['ejercicio'];
                            $unidad = isset($_POST['unidad']) ? $_POST['unidad'] : '';
                    
                            $conexion = conectar_db();
                    
                            if ($conexion) {
                                // Validar que el resultado sea un número y el ejercicio no esté vacío
                                if (is_numeric($resultado) && !empty($ejercicio)) {
                                    // Verificar si ya existe un resultado para este usuario, actividad y ejercicio
                                    $check_query = "SELECT id_ranking FROM rankings WHERE id_usuario = ? AND actividad = ? AND ejercicio = ?";
                                    $stmt_check = mysqli_prepare($conexion, $check_query);
                                    mysqli_stmt_bind_param($stmt_check, "iss", $id_usuario, $actividad, $ejercicio);
                                    mysqli_stmt_execute($stmt_check);
                                    $check_result = mysqli_stmt_get_result($stmt_check);
                    
                                    if (mysqli_num_rows($check_result) > 0) {
                                        // Ya existe, realizar UPDATE
                                        $update_query = "UPDATE rankings SET resultado = ?, unidad = ?, fecha_registro = CURRENT_TIMESTAMP WHERE id_usuario = ? AND actividad = ? AND ejercicio = ?";
                                        $stmt_update = mysqli_prepare($conexion, $update_query);
                                        mysqli_stmt_bind_param($stmt_update, "dsiss", $resultado, $unidad, $id_usuario, $actividad, $ejercicio);
                                        if (mysqli_stmt_execute($stmt_update)) {
                                            $_SESSION['resultado_guardado'] = "Resultado actualizado con éxito.";
                                        } else {
                                            $_SESSION['resultado_error'] = "Error al actualizar el resultado: " . mysqli_error($conexion);
                                        }
                                        mysqli_stmt_close($stmt_update);
                                    } else {
                                        // No existe, realizar INSERT
                                        $insert_query = "INSERT INTO rankings (id_usuario, actividad, ejercicio, resultado, unidad) VALUES (?, ?, ?, ?, ?)";
                                        $stmt_insert = mysqli_prepare($conexion, $insert_query);
                                        mysqli_stmt_bind_param($stmt_insert, "issds", $id_usuario, $actividad, $ejercicio, $resultado, $unidad);
                                        if (mysqli_stmt_execute($stmt_insert)) {
                                            $_SESSION['resultado_guardado'] = "Resultado guardado con éxito.";
                                        } else {
                                            $_SESSION['resultado_error'] = "Error al guardar el resultado: " . mysqli_error($conexion);
                                        }
                                        mysqli_stmt_close($stmt_insert);
                                    }
                                    mysqli_stmt_close($stmt_check);
                                } else {
                                    $_SESSION['resultado_error'] = "El resultado debe ser un número y el ejercicio no puede estar vacío.";
                                }
                                mysqli_close($conexion);
                            } else {
                                $_SESSION['resultado_error'] = "Error al conectar a la base de datos.";
                            }
                            // Redirigir para actualizar la página y mostrar el mensaje
                            header("Location: " . $_SERVER['PHP_SELF']);
                            exit();
                        }
                    }

                    // Obtener el ranking para la actividad actual (fitness)
                    $actividad_ranking = 'fitness';
                    $conexion_ranking = conectar_db();
                    if ($conexion_ranking) {
                        $ranking_query = "SELECT u.nombre_usuario, r.ejercicio, r.resultado, r.unidad, r.fecha_registro
                                          FROM rankings r
                                          JOIN usuarios u ON r.id_usuario = u.id_usuario
                                          WHERE r.actividad = ?
                                          ORDER BY r.resultado DESC"; // Orden descendente por defecto
                        $stmt_ranking = mysqli_prepare($conexion_ranking, $ranking_query);
                        mysqli_stmt_bind_param($stmt_ranking, "s", $actividad_ranking);
                        mysqli_stmt_execute($stmt_ranking);
                        $ranking_result = mysqli_stmt_get_result($stmt_ranking);
                        $ranking_data = [];
                        while ($row = mysqli_fetch_assoc($ranking_result)) {
                            $ranking_data[] = $row;
                        }
                        mysqli_stmt_close($stmt_ranking);
                        mysqli_close($conexion_ranking);
                    } else {
                        // Manejar error al conectar para el ranking
                        echo '<p class="error-message">Error al conectar a la base de datos para mostrar el ranking.</p>';
                        $ranking_data = [];
                    }
                    ?>
                </ul>
            </nav>
            <div class="social-links">
                <a href="https://www.facebook.com" target="_blank" aria-label="Facebook"><img src="imatges/socialnetwork/facebook.png" alt="Facebook"></a>
                <a href="https://www.instagram.com" target="_blank" aria-label="Instagram"><img src="imatges/socialnetwork/instagram.png" alt="Instagram"></a>
                <a href="https://www.whatsapp.com" target="_blank" aria-label="WhatsApp"><img src="imatges/socialnetwork/whatsapp.png" alt="WhatsApp"></a>
            </div>
        </div>
    </header>

    <main class="container main-content">
        <h1>Ranking de Fitness</h1>
        <section class="form-section">
            <h2>Ingresa o actualiza tu resultado en Fitness</h2>
            <form action="" method="post">
                <input type="hidden" name="actividad" value="fitness">
                <label for="ejercicio">Ejercicio:</label>
                <input type="text" id="ejercicio" name="ejercicio" required>
                <label for="resultado">Resultado:</label>
                <input type="number" id="resultado" name="resultado" min="0" required>
                <label for="unidad">Unidad (opcional):</label>
                <input type="text" id="unidad" name="unidad">
                <button type="submit" name="guardar_resultado">Guardar resultado</button>
            </form>
            <div id="resultado_mensaje">
                <?php
                if (isset($_SESSION['resultado_guardado'])) {
                    echo '<p class="success-message">' . $_SESSION['resultado_guardado'] . '</p>';
                    unset($_SESSION['resultado_guardado']);
                }
                if (isset($_SESSION['resultado_error'])) {
                    echo '<p class="error-message">' . $_SESSION['resultado_error'] . '</p>';
                    unset($_SESSION['resultado_error']);
                }
                ?>
            </div>
        </section>

        <section class="table-container">
            <h2>Ranking actual de Fitness</h2>
            <table class="schedule-table">
    <thead>
        <tr>
            <th>Posición</th>
            <th>Usuario</th>
            <th>Ejercicio</th>
            <th>Resultado</th>
            <th>Unidad</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($ranking_data)): ?>
            <?php $posicion = 1; ?>
            <?php foreach ($ranking_data as $row): ?>
                <tr>
                    <td><?php echo $posicion++; ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_usuario']); ?></td>
                    <td><?php echo htmlspecialchars($row['ejercicio']); ?></td>
                    <td><?php echo htmlspecialchars($row['resultado']); ?></td>
                    <td><?php echo htmlspecialchars($row['unidad']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha_registro']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">No hay resultados registrados para esta actividad aún. ¡Sé el primero!</td></tr>
        <?php endif; ?>
    </tbody>
</table>
        </section>
    </main>

    <footer class="main-footer">
        <div class="container footer-content">
            <p>&copy; 2025 FitConnect. Todos los derechos reservados.</p>
            <p>Diseñado por Héctor Martínez Juan.</p>
        </div>
    </footer>
</body>
</html>