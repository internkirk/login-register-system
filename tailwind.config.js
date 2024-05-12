import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */



export default {
    content: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                vazir: ['vazir', 'sans-serif'],
                vazirBold: ['vazir-bold', 'sans-serif'],
                vazirThin: ['vazir-thin', 'sans-serif'],
                vazirLight: ['vazir-light', 'sans-serif'],
            },
            
        },
        
    },

    plugins: [
        require('flowbite/plugin')
    ]
};
