<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registro FitConnect</title>
    <link rel="shortcut icon" href="imatges/barra-con-pesas-azul-2.png" type="image/ico">
    <link rel="stylesheet" href="estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
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
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="nutricion.html">Planes</a></li>
                    <li><a href="horario.html">Horario</a></li>
                    <li class="login-item">
                        <a href="#" id="login-toggle" class="login-link">Iniciar Sesión</a>
                        <div class="login-dropdown">
                            <form id="login-form" action="login.php" method="post">
                                <h2>Iniciar Sesión</h2>
                                <label for="login-usuario">Usuario:</label>
                                <input type="text" id="login-usuario" name="login-usuario" required>
                                <label for="login-contraseña">Contraseña:</label>
                                <input type="password" id="login-contraseña" name="login-contraseña" required>
                                <button type="submit">Entrar</button>
                                <p class="error-message" id="login-error"></p>
                            </form>
                            <p class="register-link">¿No tienes cuenta? <a href="contactos.php">Regístrate</a></p>
                        </div>
                    </li>
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
        <section class="form-section">
            <h1>Formulario de Registro</h1>
            <?php
                require_once 'funciones.php';

                session_start();
                if (isset($_SESSION['login_error'])) {
                    echo '<script>document.addEventListener("DOMContentLoaded", function() {
                        document.getElementById("login-error").textContent = "' . $_SESSION['login_error'] . '";
                        let loginDropdown = document.querySelector(".login-dropdown");
                    if (loginDropdown) {
                        loginDropdown.classList.add("show"); // Asegúrate de que "show" es tu clase para mostrar el desplegable
                        }
                    });</script>';
                unset($_SESSION['login_error']); // Limpiar el error de la sesión
            }
                if (isset($_SESSION['registro_exito'])) {
            echo '<div class="success-message">' . htmlspecialchars($_SESSION['registro_exito']) . '</div>';
            unset($_SESSION['registro_exito']); // Limpiar el mensaje de éxito
            }
        ?>
            <form id="formulario" method="post" action="registro.php">

                <fieldset>
                    <legend>Datos Personales</legend>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" minlength="1" maxlength="50" placeholder="Nombre" required>

                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" minlength="1" maxlength="80" placeholder="Apellidos" required>

                    <label for="usuario">Email:</label>
                    <input type="email" id="usuario" name="usuario" placeholder="Email" required>

                    <label for="fecha-nacimiento">Fecha de nacimiento:</label>
                    <input type="date" id="fecha-nacimiento" name="fecha-nacimiento">
                </fieldset>

                <fieldset>
                <legend>Credenciales</legend>
                <label for="nombre_usuario">Nombre de usuario:</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" minlength="3" maxlength="50" placeholder="Nombre de usuario" required>

                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña" required>
                </fieldset>

                <fieldset class="plan-selection-form">
                    <legend>Plan de Nutrición</legend>
                    <div class="form-group">
                        <label for="plan-nutricion">Selecciona tu plan:</label>
                        <select id="plan-nutricion" name="plan-nutricion">
                            <option value="">-- Elige un plan --</option>
                            <option value="basico">Plan básico - 9.90€/mes</option>
                            <option value="avanzado">Plan avanzado - 19.90€/mes</option>
                            <option value="vegano">Plan vegano-vegetariano - 9.90€/mes</option>
                        </select>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Intereses</legend>
                    <div class="checkbox-group">
                        <label>Actividades:</label>
                        <input type="checkbox" id="zumba" name="actividades[]" value="Zumba">
                        <label for="zumba">Zumba</label>

                        <input type="checkbox" id="fitness" name="actividades[]" value="Fitness">
                        <label for="fitness">Fitness</label>

                        <input type="checkbox" id="kickboxing" name="actividades[]" value="Kick-boxing">
                        <label for="kickboxing">Kick-boxing</label>

                        <input type="checkbox" id="crossfit" name="actividades[]" value="Crossfit">
                        <label for="crossfit">Crossfit</label>
                    </div>
                </fieldset>

                <div class="form-buttons">
                    <button type="submit">Registrarse</button>
                    <button type="reset">Borrar</button>
                </div>
            </form>
        </section>
    </main>

    <div class="back-to-top">
        <a href="index.php" class="button secondary-button">Volver a la página principal</a>
    </div>

    <footer class="main-footer">
        <div class="container footer-content">
            <p>&copy; 2025 FitConnect. Todos los derechos reservados.</p>
            <p>Diseñado por Héctor Martínez Juan.</p>
        </div>
    </footer>
</body>
</html>