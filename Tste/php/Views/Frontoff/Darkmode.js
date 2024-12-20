function updateLogoBasedOnTheme() {
    const logoElement = document.getElementById('logo');
    const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

    console.log("�tat du mode sombre : ", isDarkMode); // Affiche l'�tat dans la console

    if (isDarkMode) {
        logoElement.src = '../../Assets/imgs/furniture/logo/black-logo.png'; // Logo pour le mode sombre
        alert("Dark mode activ�");
    } else {
        logoElement.src = '../../Assets/imgs/furniture/logo/new.png'; // Logo pour le mode clair
        alert("Mode clair activ�");
    }
}

// �coute les changements de pr�f�rence de couleur
const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
mediaQuery.addEventListener('change', updateLogoBasedOnTheme);

// Appel initial pour d�finir l'image au chargement de la page
document.addEventListener('DOMContentLoaded', updateLogoBasedOnTheme);