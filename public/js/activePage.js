// Add active class to the current link
document.addEventListener("DOMContentLoaded", () => {
    const navLinks = document.querySelectorAll(".nav-box a");
    const currentPath = window.location.pathname;

    navLinks.forEach(link => {
        if (link.getAttribute("href") === currentPath) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }
    });
});
