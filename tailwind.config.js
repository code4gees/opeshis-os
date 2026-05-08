/** @type {import('tailwindcss').Config} */
export default {
    important: true,
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './app/Http/Controllers/**/*.php',
    ],
    theme: {
        extend: {
            colors: {
                'cobalt': '#1B5FA8',
                'navy': '#0A192F',
                'critical': '#E11D48',
                'success': '#10B981',
            }
        },
    },
    plugins: [],
};
