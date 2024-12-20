function updateLogoBasedOnTheme() {
    const logoElement = document.getElementById('logo');
    const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

    console.log("État du mode sombre : ", isDarkMode); // Affiche l'état dans la console

    if (isDarkMode) {
        logoElement.src = '../../Assets/imgs/furniture/logo/black-logo.png'; // Logo pour le mode sombre
        alert("Dark mode activé");
    } else {
        logoElement.src = '../../Assets/imgs/furniture/logo/new.png'; // Logo pour le mode clair
        alert("Mode clair activé");
    }
}

// Écoute les changements de préférence de couleur
const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
mediaQuery.addEventListener('change', updateLogoBasedOnTheme);

// Appel initial pour définir l'image au chargement de la page
document.addEventListener('DOMContentLoaded', updateLogoBasedOnTheme);