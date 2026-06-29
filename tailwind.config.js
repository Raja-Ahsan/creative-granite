import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.{js,ts,jsx,tsx}',
    ],

    theme: {
        extend: {
            colors: {
                cream: '#f5f0e8',
                bone: '#ebe5dc',
                ink: '#2a2622',
                'ink-soft': '#3d3832',
                accent: '#a67c52',
                background: '#f5f0e8',
                foreground: '#2a2622',
            },
            fontFamily: {
                sans: ['"Biondi Sans"', '"Helvetica Neue"', 'Arial', ...defaultTheme.fontFamily.sans],
                display: ['Luxerie', 'Didot', '"Bodoni 72"', '"Times New Roman"', 'serif'],
                mono: ['"JetBrains Mono"', ...defaultTheme.fontFamily.mono],
            },
        },
    },

    plugins: [forms],
};
