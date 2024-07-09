const toggleDarkModeButton = document.getElementById('toggleDarkMode');
const htmlElement = document.documentElement;

// Función para alternar entre modos claro y oscuro
function toggleDarkMode() {
  htmlElement.classList.toggle('dark-mode');
  if (htmlElement.classList.contains('dark-mode')) {
    toggleDarkModeButton.textContent = 'Modo Claro';
    localStorage.setItem('theme', 'dark');
  } else {
    toggleDarkModeButton.textContent = 'Modo Oscuro';
    localStorage.setItem('theme', 'light');
  }
}

// Evento click para el botón de modo oscuro
toggleDarkModeButton.addEventListener('click', toggleDarkMode);

// Verificar el tema guardado en el almacenamiento local al cargar la página
const savedTheme = localStorage.getItem('theme');
if (savedTheme === 'dark') {
  htmlElement.classList.add('dark-mode');
  toggleDarkModeButton.textContent = 'Modo Claro';
}
