import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    safelist: [
        {
            pattern:
                /^(bg|text)-(red|blue|green|indigo|purple|orange|pink|teal|cyan|lime|amber|sky|violet|fuchsia|rose|gray)-(100|800)$/,
        },
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Plus Jakarta Sans", "sans-serif"],
            },

            // ============================================
            // TAMBAHKAN INI: Warna Hijau PPID Custom
            // ============================================
            colors: {
                hijau: {
                    50: "#f0fdf4",
                    100: "#dcfce7",
                    200: "#bbf7d0",
                    300: "#86efac",
                    400: "#4ade80",
                    500: "#22c55e",
                    600: "#16a34a", // Primary
                    700: "#15803d", // Dark
                    800: "#166534", // Darker
                    900: "#14532d", // Darkest
                    950: "#052e16", // Extra dark (opsional)
                },
                putih: {
                    50: "#fafafa",
                    100: "#f5f5f5",
                    200: "#e5e5e5",
                    300: "#d4d4d4",
                },
            },

            // ============================================
            // TAMBAHKAN INI: Animasi (opsional tapi keren)
            // ============================================
            animation: {
                "fade-in": "fadeIn 0.5s ease-out",
                "slide-up": "slideUp 0.5s ease-out",
                "slide-down": "slideDown 0.3s ease-out",
                "pulse-slow": "pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite",
            },

            keyframes: {
                fadeIn: {
                    "0%": { opacity: "0" },
                    "100%": { opacity: "1" },
                },
                slideUp: {
                    "0%": { opacity: "0", transform: "translateY(20px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
                slideDown: {
                    "0%": { opacity: "0", transform: "translateY(-10px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
            },

            // ============================================
            // TAMBAHKAN INI: Line clamp (untuk teks terpotong)
            // ============================================
            lineHeight: {
                snug: "1.375",
            },
        },
    },

    plugins: [
        [forms],
        require("@tailwindcss/typography"),
        require("@tailwindcss/forms"), // <-- TAMBAHKAN INI
        // ← INI HARUS ADA
    ],
};
