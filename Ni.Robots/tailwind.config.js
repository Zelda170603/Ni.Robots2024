import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.php",
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  darkMode: 'class',
  theme: {
    extend: {
      aspectRatio: {
        '2/3': '2 / 3',
      },
      colors: {
        main_color: '#031930',
      },
      margin: {
        '18': '4.5rem',
      },
      fontSize: {
        'xs-extra': '10px',
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}