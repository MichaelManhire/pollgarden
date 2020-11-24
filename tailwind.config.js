const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: {
        content: [
            './vendor/laravel/jetstream/**/*.blade.php',
            './storage/framework/views/*.php',
            './resources/views/**/*.blade.php',
        ],

        options: {
            whitelist: [
                'bg-green-100',
                'text-green-800',
                'bg-blue-100',
                'text-blue-800',
                'bg-yellow-100',
                'text-yellow-800',
                'bg-teal-100',
                'text-teal-800',
                'bg-red-100',
                'text-red-800',
                'bg-pink-100',
                'text-pink-800',
                'bg-orange-100',
                'text-orange-800',
                'bg-purple-100',
                'text-purple-800',
            ],
        },
    },

    theme: {
        extend: {
            colors: {
                green: {
                    '50': '#e3f9e5',
                    '100': '#c1eac5',
                    '200': '#a3d9a5',
                    '300': '#7bc47f',
                    '400': '#57ae5b',
                    '500': '#3f9142',
                    '600': '#2f8132',
                    '700': '#207227',
                    '800': '#0e5814',
                    '900': '#05400a',
                },
                purple: {
                    '50': '#eae2f8',
                    '100': '#cfbcf2',
                    '200': '#a081d9',
                    '300': '#8662c7',
                    '400': '#724bb7',
                    '500': '#653cad',
                    '600': '#51279b',
                    '700': '#421987',
                    '800': '#34126f',
                    '900': '#240754',
                },
                red: {
                    '50': '#ffeeee',
                    '100': '#facdcd',
                    '200': '#f29b9b',
                    '300': '#e66a6a',
                    '400': '#d64545',
                    '500': '#ba2525',
                    '600': '#a61b1b',
                    '700': '#911111',
                    '800': '#780a0a',
                    '900': '#610404',
                },
                yellow: {
                    '50': '#fffaeb',
                    '100': '#fcefc7',
                    '200': '#f8e3a3',
                    '300': '#f9da8b',
                    '400': '#f7d070',
                    '500': '#e9b949',
                    '600': '#c99a2e',
                    '700': '#a27c1a',
                    '800': '#7c5e10',
                    '900': '#513c06',
                },
            },
            container: {
                center: true,
                padding: '1rem',
            },
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [require('@tailwindcss/ui')],
};
