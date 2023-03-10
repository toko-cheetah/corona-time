/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                inter: ["Inter", "sans-serif"],
                firago: ["FiraGO", "sans-serif"],
            },
            width: {
                "screen-3/4": "75vw",
            },
            boxShadow: {
                "card-shadow": "1px 2px 8px rgba(0, 0, 0, 0.04);",
            },
        },
    },
    plugins: [],
};
