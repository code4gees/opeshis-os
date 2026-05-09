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
                'surface': {
                    'deep': '#050B15',
                    'base': '#0A192F',
                    'elevated': '#112240',
                    'overlay': '#1D2D50',
                },
                'cobalt': '#1B5FA8',
                'sage': '#82C09A',
                'rose': '#E11D48',
                'alert': '#D9776C',
                'subtle': 'rgba(255, 255, 255, 0.04)',
                'card': 'rgba(255, 255, 255, 0.02)',
            }
        },
    },
    plugins: [],
};
