import defaultTheme from 'laravel-vite-plugin/inertia'; // O el predeterminado de Breeze

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                'gym-dark': '#080c14',
                'gym-neon': '#00f2ff', // Cian neón
                'gym-purple': '#7000ff', // Acento púrpura para contraste
            },
            boxShadow: {
                'neon-glow': '0 0 15px rgba(0, 242, 255, 0.5)',
            }
        },
    },
    plugins: [require('@tailwindcss/forms')],
};