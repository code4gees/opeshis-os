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
                'sage': '#82C09A',
                'alert': '#D9776C',
                'subtle': 'rgba(255, 255, 255, 0.04)',
                'card': 'rgba(255, 255, 255, 0.02)',
            }
        },
    },
    plugins: [],
};
