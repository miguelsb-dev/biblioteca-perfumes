document.addEventListener("DOMContentLoaded", function () {
    const revealElements = document.querySelectorAll("main, .form-container, .profile-card");
    revealElements.forEach(el => {
        el.classList.add("page-reveal");
    });

    const forms = document.querySelectorAll("form");
    forms.forEach(form => {
        const btn = form.querySelector("button");
        if (btn && btn.textContent.trim().toLowerCase() === "eliminar") {
            form.addEventListener("submit", function (e) {
                if (!confirm("¿Desea retirar esta pieza de su colección personal?")) {
                    e.preventDefault();
                }
            });
        }
    });

    const header = document.querySelector("header");
    if (header) {
        window.addEventListener("scroll", function () {
            if (window.scrollY > 20) {
                header.style.background = "rgba(10, 13, 20, 0.95)";
                header.style.padding = "0 30px";
                header.style.height = "80px";
            } else {
                header.style.background = "rgba(15, 19, 26, 0.85)";
                header.style.padding = "0 40px";
                header.style.height = "90px";
            }
        });
    }
});