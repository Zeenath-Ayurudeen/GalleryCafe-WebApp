const hamburger = document.getElementById('hamburger');
const nav = document.querySelector('.nav-list');

hamburger.addEventListener('click', function () {
    const hamIcon = this.querySelector('.hamburger-icon');
    const crossIcon = this.querySelector('.cross-icon');

    if (nav.style.right === "0px") {
        // Hide the nav
        nav.style.right = "-100%";  // Move the nav out of view
        hamIcon.style.display = "block";
        crossIcon.style.display = "none";
    } else {
        // Show the nav
        nav.style.right = "0px";  // Bring the nav into view
        hamIcon.style.display = "none";
        crossIcon.style.display = "block";
    }
});
