function toggleDarkMode() {
  const isDark = document.documentElement.classList.toggle('dark');
  ['darkIcon', 'darkIconMobile'].forEach(id => {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.toggle('fa-moon', !isDark);
    el.classList.toggle('fa-sun', isDark);
  });
  localStorage.setItem('darkMode', isDark);
}
 
if (localStorage.getItem('darkMode') === 'true') {
  document.documentElement.classList.add('dark');
  document.addEventListener('DOMContentLoaded', () => {
    ['darkIcon', 'darkIconMobile'].forEach(id => {
      const el = document.getElementById(id);
      if (el) el.classList.replace('fa-moon', 'fa-sun');
    });
  });
}