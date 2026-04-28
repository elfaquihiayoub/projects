/** @type {import("tailwindcss").Config} */
export default {
  darkMode: "class",
  content: ["./index.html", "./src/**/*.{js,jsx}"],
  theme: {
    extend: {
      colors: {
        accent: "#00CFFF",
        "accent-strong": "#00A8D6",
        background: "#FFFFFF",
        "background-secondary": "#F5F7FA",
        "text-main": "#111827",
        "text-secondary": "#6B7280",
        "dark-background": "#0B0F19",
        "dark-background-secondary": "#111827",
        "dark-text-main": "#FFFFFF",
        "dark-text-secondary": "#9CA3AF",
      },
      fontFamily: {
        body: ["Inter", "Poppins", "Sora", "sans-serif"],
        heading: ["Sora", "Inter", "sans-serif"],
      },
      boxShadow: {
        soft: "0 6px 20px -8px rgba(17, 24, 39, 0.10), 0 2px 6px -2px rgba(17, 24, 39, 0.06)",
        "soft-lg": "0 18px 40px -12px rgba(17, 24, 39, 0.18), 0 6px 14px -4px rgba(17, 24, 39, 0.10)",
        "soft-dark": "0 6px 20px -8px rgba(2, 6, 23, 0.55), 0 2px 6px -2px rgba(2, 6, 23, 0.40)",
        "soft-dark-lg": "0 18px 50px -12px rgba(2, 6, 23, 0.70), 0 6px 18px -4px rgba(2, 6, 23, 0.55)",
        glow: "0 10px 40px rgba(0, 207, 255, 0.20)",
        "glow-lg": "0 20px 60px rgba(0, 207, 255, 0.32)",
      },
      keyframes: {
        "fade-up": {
          "0%": { opacity: "0", transform: "translateY(12px)" },
          "100%": { opacity: "1", transform: "translateY(0)" },
        },
      },
      animation: {
        "fade-up": "fade-up 0.45s ease-out both",
      },
    },
  },
  plugins: [],
};
