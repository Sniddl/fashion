module.exports = {
    theme: {
        extend: {
            colors: {
                gray: {
                    "100": "var(--gray-100)",
                    "200": "var(--gray-200)",
                    "300": "var(--gray-300)",
                    "400": "var(--gray-400)",
                    "500": "var(--gray-500)",
                    "600": "var(--gray-600)",
                    "700": "var(--gray-700)",
                    "800": "var(--gray-800)",
                    "900": "var(--gray-900)"
                },

                white: "var(--white)",
                black: "var(--black)"
            },
            zIndex: {
                '-1': '-1',
            },
        }
    },
    variants: {},
    plugins: [require("@tailwindcss/custom-forms")]
};
