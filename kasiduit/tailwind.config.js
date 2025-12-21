/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    red: '#dc2626', // Primary
                    dark: '#111827', // Navy/Footer
                    light: '#f9fafb', // Backgrounds
                }
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'], // Ensure you import Inter in layout
            }
        },
    },
    plugins: [],
}