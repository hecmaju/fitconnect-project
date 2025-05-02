<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Rankings</title>
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
                    session_start();
                    if (isset($_SESSION['nombre_usuario'])) {
                        echo '<li class="logged-in-user">' . 'Bienvenido/a ' . '<br>' . htmlspecialchars($_SESSION['nombre_usuario']) . '</li>';
                        echo '<li class="logout-item"><a href="logout.php" class="logout-button">Cerrar Sesión</a></li>';
                        
                    } else {
                        header("Location: index.php"); // Si no hay sesión, redirigir a la página principal
                        exit();
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
        <section class="features">
            <h2>Elige tu actividad y compite</h2>
            <div class="card-grid">
                <article class="card">
                    <img src="imatges/blog-fuerza.png" alt="Imagen de Fitness">
                    <h3>Fitness</h3>
                    <p>Sigue tu progreso y compite en diferentes ejercicios de fitness.</p>
                    <a href="fitness_ranking.php" class="button">Ver Ranking</a>
                </article>
                <article class="card">
                    <img src="imatges/crossfit2.png" alt="Imagen de Crossfit">
                    <h3>Crossfit</h3>
                    <p>Compara tus tiempos y resultados en los WODs más desafiantes.</p>
                    <a href="rankings.php?actividad=crossfit" class="button">Ver Ranking</a>
                </article>
                <article class="card">
                    <img src="imatges/Yoga-relajacion.jpg" alt="Imagen de Yoga">
                    <h3>Yoga</h3>
                    <p>Registra tus logros en diferentes asanas y series de yoga.</p>
                    <a href="rankings.php?actividad=yoga" class="button">Ver Ranking</a>
                </article>
                <article class="card">
                    <img src="imatges/kick-boxing2.png" alt="Imagen de Kick-Boxing">
                    <h3>Kick-Boxing</h3>
                    <p>Mide tu potencia y resistencia en diferentes técnicas de combate.</p>
                    <a href="rankings.php?actividad=kick-boxing" class="button">Ver Ranking</a>
                </article>
            </div>
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