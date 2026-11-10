
document.addEventListener("DOMContentLoaded", function () {

    // Smooth scrolling for navigation links
    document.querySelectorAll('nav a').forEach(function(link) {
        link.addEventListener('click', function() {
            console.log("Navigation: " + link.textContent);
        });
    });

    // Welcome message
    console.log("Welcome to Madan M P Portfolio!");

    // Update footer year
    const footer = document.querySelector("footer p");

    if (footer) {
        footer.textContent =
            "© " + new Date().getFullYear() +
            " Madan M P | Personal Portfolio";
    }

});
