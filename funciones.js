// inicio sesion
document.addEventListener('DOMContentLoaded', function() {
    const loginToggle = document.querySelector('.main-nav ul li a.login-link');
    const loginDropdown = document.querySelector('.login-dropdown');

    if (loginToggle && loginDropdown) {
        loginToggle.addEventListener('click', function(event) {
            event.preventDefault(); // Evita que el enlace intente navegar
            loginDropdown.style.display = loginDropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Cerrar el desplegable si se hace clic fuera de él
        document.addEventListener('click', function(event) {
            if (!loginDropdown.contains(event.target) && event.target !== loginToggle) {
                loginDropdown.style.display = 'none';
            }
        });
    }
});

// Visualizar nombre de usuario en el nav
// document.addEventListener('DOMContentLoaded', function() {
//     const userButton = document.getElementById('user-button');
//     const userDropdown = document.querySelector('.user-dropdown');

//     if (userButton && userDropdown) {
//         userButton.addEventListener('click', function() {
//             userDropdown.classList.toggle('show');
//         });

//         // Cerrar el dropdown si se hace clic fuera de él
//         document.addEventListener('click', function(event) {
//             if (!userButton.contains(event.target) && !userDropdown.contains(event.target)) {
//                 userDropdown.classList.remove('show');
//             }
//         });
//     }
// });