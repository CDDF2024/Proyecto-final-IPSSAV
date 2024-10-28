// Interactividad para el menú y otras funcionalidades
document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.getElementById("menu-toggle");
    const wrapper = document.getElementById("wrapper");
    const sidebar = document.getElementById("sidebar-wrapper");

    // Toggle del menú lateral
    menuToggle.addEventListener("click", function() {
        wrapper.classList.toggle("toggled");
        sidebar.classList.toggle("shadow");
    });

    // Mensaje de bienvenida
    function showWelcomeMessage() {
        const welcomeMessage = document.createElement("div");
        welcomeMessage.className = "alert alert-success";
        welcomeMessage.innerText = "¡Bienvenido al Panel de Administración!";
        document.body.insertBefore(welcomeMessage, document.body.firstChild);

        // Desaparecer el mensaje después de 3 segundos
        setTimeout(() => {
            welcomeMessage.classList.add("fade-out");
            setTimeout(() => {
                welcomeMessage.remove();
            }, 1000);
        }, 3000);
    }

    showWelcomeMessage();
});

// CSS para el mensaje de bienvenida
const style = document.createElement('style');
style.innerHTML = `
    .fade-out {
        opacity: 0;
        transition: opacity 1s ease-out;
    }
`;
document.head.appendChild(style);
