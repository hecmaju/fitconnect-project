<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FitConnect</title>
    <link rel="shortcut icon" href="/imatges/barra-con-pesas-azul-2.png" type="image/ico">
    <link rel="stylesheet" href="estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="funciones.js" defer></script>
</head>
<body>
    <header class="main-header">
        <div class="container header-content" id="principio">
            <div class="logo">
                <a href="index.html"><img src="imatges/barra-con-pesas-azul-2.png" alt="Logo de FitConnect"> <span>FitConnect</span></a>
            </div>
            
            <nav class="main-nav">
    <ul>
        <li><a href="index.html" class="active">Página principal</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="nutricion.html">Planes</a></li>
        <li><a href="horario.html">Horario</a></li>
        <?php
        session_start();
        if (isset($_SESSION['nombre_usuario'])) {
            echo '<li class="logged-in-user">'.'Bienvenido/a '.'<br>' . htmlspecialchars($_SESSION['nombre_usuario']) . '</li>';
            echo '<li class="logout-item"><a href="logout.php" class="logout-button">Cerrar Sesión</a></li>';
        } else {
            echo '<li class="login-item">';
            echo '<a href="#" id="login-toggle" class="login-link">Iniciar Sesión</a>';
            echo '<div class="login-dropdown">';
            echo '<form id="login-form" action="login.php" method="post">';
            echo '<h2>Iniciar Sesión</h2>';
            echo '<label for="login-usuario">Usuario:</label>';
            echo '<input type="text" id="login-usuario" name="login-usuario" required>';
            echo '<label for="login-contraseña">Contraseña:</label>';
            echo '<input type="password" id="login-contraseña" name="login-contraseña" required>';
            echo '<button type="submit">Entrar</button>';
            echo '<p class="error-message" id="login-error"></p>';
            echo '</form>';
            echo '<p class="register-link">¿No tienes cuenta? <a href="contactos.php">Regístrate</a></p>';
            echo '</div>';
            echo '</li>';
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
        <section class="hero">
            <h1 class="hero-title">Bienvenido a FitConnect</h1>
            <p class="hero-subtitle">Tu plataforma integral para un estilo de vida saludable y activo.</p>
        </section>

        <section class="features">
            
            <div class="card-grid">
                <article class="card">
                    <img src="imatges/pawel-bulwan-JWK2H-2qz1Y-unsplash.jpg" alt="Personas haciendo ejercicio">
                    <h3>Clases y Entrenamientos Personalizados</h3>
                    <p>Reserva clases en tu gimnasio o sigue entrenamientos en línea diseñados a tu medida. ¡Elige entre yoga, spinning, HIIT y mucho más!</p>
                    <a href="clases.html" class="button">Ver más</a>
                </article>
                <article class="card">
                    <img src="imatges/bascula.jpg" alt="Báscula para medir el peso">
                    <h3>Seguimiento de tu Progreso</h3>
                    <p>Lleva un registro de tu evolución física con informes detallados. Desde tu peso hasta el número de repeticiones, verás tu mejora día tras día.</p>
                    <a href="seguimiento.html" class="button">Ver más</a>
                </article>
                <article class="card">
                    <img src="imatges/comida.jpg" alt="Variedad de alimentos saludables">
                    <h3>Planes de Nutrición Saludables</h3>
                    <p>Complementa tu rutina con una alimentación adecuada. Recibe planes de comida personalizados y consulta a nuestros nutricionistas cuando lo necesites.</p>
                    <a href="nutricion.html" class="button">Ver más</a>
                </article>
                <article class="card">
                    <img src="imatges/comunidad.jpg" alt="Grupo de personas interactuando">
                    <h3>Comunidad Activa y Retos de Fitness</h3>
                    <p>Únete a nuestra comunidad en línea, comparte tus logros y participa en emocionantes retos mensuales. ¡Gana premios y mantente motivado!</p>
                    <a href="comunidad.html" class="button">Ver más</a>
                </article>
                <article class="card">
                    <img src="imatges/entrenador.jpg" alt="Entrenador personal ayudando a una persona">
                    <h3>Acceso a Entrenadores Personales</h3>
                    <p>Conéctate con entrenadores certificados que te ayudarán a diseñar rutinas, ofrecer consejos y motivarte para alcanzar tus metas.</p>
                    <a href="entrenadores.html" class="button">Ver más</a>
                </article>
                <article class="card">
                    <img src="imatges/online.jpg" alt="Persona haciendo ejercicio frente a una pantalla">
                    <h3>Clases en Línea y App Móvil</h3>
                    <p>Entrena desde cualquier lugar, en cualquier momento. Accede a entrenamientos en vivo o a nuestra biblioteca de videos on-demand desde la app.</p>
                    <a href="videos.html" class="button">Ver más</a>
                </article>
                
                <article class="card">
                    <img src="imatges/medicina.png" alt="Icono de un estetoscopio">
                    <h3>Asesoría Médica y de Salud</h3>
                    <p>Consulta a nuestros médicos y especialistas en salud para asegurarte de que tu rutina es segura y efectiva.</p>
                    <a href="asesoria-medica.html" class="button">Ver más</a>
                </article>
                <article class="card">
                    <img src="imatges/blog.jpg" alt="Imagen relacionada con un blog de fitness">
                    <h3>Blog de Fitness y Consejos de Salud</h3>
                    <p>Mantente al día con las últimas tendencias en fitness, consejos de nutrición, recetas saludables y guías de entrenamiento en nuestro blog.</p>
                    <a href="blog.html" class="button">Ir al Blog</a>
                </article>
                <article class="card">
                    <img src="imatges/horario.jpg" alt="Reloj marcando la hora">
                    <h3>Horarios Flexibles</h3>
                    <p>Consulta los horarios de las clases y actividades en tu gimnasio. ¡Nunca más te perderás una sesión!</p>
                    <a href="horario.html" class="button">Ver Horario</a>
                </article>
            </div>
        </section>

        <div class="back-to-top">
            <a href="#principio" class="button secondary-button">Volver al principio</a>
        </div>
    </main>

    <footer class="main-footer">
        <div class="container footer-content">
            <p>&copy; 2025 FitConnect. Todos los derechos reservados.</p>
            <p>Diseñado por Héctor Martínez Juan.</p>
        </div>
    </footer>

</body>
</html>