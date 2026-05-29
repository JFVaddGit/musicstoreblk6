import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Theme toggle logic: uses class-based dark mode (Tailwind darkMode: 'class')
function updateThemeIcons() {
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');
    if (!darkIcon || !lightIcon) return;
    if (document.documentElement.classList.contains('dark')) {
        // show light (sun) icon when dark mode is active
        darkIcon.classList.add('hidden');
        lightIcon.classList.remove('hidden');
    } else {
        // show moon icon when light mode is active
        darkIcon.classList.remove('hidden');
        lightIcon.classList.add('hidden');
    }
}

function setTheme(theme) {
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    }
    updateThemeIcons();
}

document.addEventListener('DOMContentLoaded', function () {
    try {
        // initialize icons
        updateThemeIcons();

        const btn = document.getElementById('theme-toggle');
        if (btn) {
            btn.addEventListener('click', function () {
                if (document.documentElement.classList.contains('dark')) {
                    setTheme('light');
                } else {
                    setTheme('dark');
                }
            });
        }
    } catch (e) { }
});
