

document.addEventListener("DOMContentLoaded", function () {
    const toggleSwitch = document.getElementById('theme-toggle');
    const modeText = document.getElementById('mode-text');
    const breadcrumb = document.getElementById('breadcrumb');
  
    function switchTheme(e) {
      if (e.target.checked) {
        // Tema oscuro
        document.documentElement.classList.add('dark-mode');
        document.documentElement.classList.remove('light-mode');
        modeText.textContent = 'modo claro';
        breadcrumb.classList.remove('bg-white', 'text-light');
        breadcrumb.classList.add('bg-dark', 'text-white');
        localStorage.setItem('theme', 'dark'); // Guardar la preferencia en localStorage
      } else {
        // Tema claro
        document.documentElement.classList.add('light-mode');
        document.documentElement.classList.remove('dark-mode');
        modeText.textContent = 'modo oscuro';
        breadcrumb.classList.remove('bg-dark', 'text-white');
        breadcrumb.classList.add('bg-white', 'text-light');
        localStorage.setItem('theme', 'light'); // Guardar la preferencia en localStorage
      }
    }
  
    // Aplicar el tema guardado en localStorage al cargar la página
    const currentTheme = localStorage.getItem('theme');
  
    if (currentTheme === 'dark') {
      toggleSwitch.checked = true;
      document.documentElement.classList.add('dark-mode');
      document.documentElement.classList.remove('light-mode');
      modeText.textContent = 'modo claro';
      breadcrumb.classList.remove('bg-white', 'text-light');
      breadcrumb.classList.add('bg-dark', 'text-white');
    } else if (currentTheme === 'light') {
      toggleSwitch.checked = false;
      document.documentElement.classList.add('light-mode');
      document.documentElement.classList.remove('dark-mode');
      modeText.textContent = 'modo oscuro';
      breadcrumb.classList.remove('bg-dark', 'text-white');
      breadcrumb.classList.add('bg-white', 'text-light');
    }
  
    // Event listener para el cambio de tema
    toggleSwitch.addEventListener('change', switchTheme);
  });
  
  
  // Function to update date and time
  function updateDateTime() {
      const now = new Date();
      const datetimeString = now.toLocaleString();
      document.getElementById('datetime').textContent = datetimeString;
  }
  
  
  // Initial call to set the date and time
  updateDateTime();
  
  // Update date and time every second
  setInterval(updateDateTime, 1000);
  