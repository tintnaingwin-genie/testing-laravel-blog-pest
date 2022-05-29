const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    mode: 'jit',
    important: true,
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/vendor/**/*.blade.php',
        'app/Models/Enums/*.php',
    ],

    theme: {
        colors: {
            white: '#ffffff',
            ink: '#42332b',
            paper: '#fbfaf7',
            link: '#ff7f00',
            transparent: 'transparent',
            red: colors.red,
            green: colors.green,
            gray: colors.warmGray,
            blue: colors.indigo,
        },
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['"Playfair Display"'],
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
