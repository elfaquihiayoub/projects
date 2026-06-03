import type { Config } from "tailwindcss";

export default {
  darkMode: "class",
  content: ["./index.html", "./src/**/*.{js,ts,jsx,tsx}"],
  theme: {
    extend: {
      colors: {
        bg: "var(--bg)",
        "bg-2": "var(--bg-2)",
        text: "var(--text)",
        "text-2": "var(--text-2)",
        accent: "#00CFFF",
        border: "#D1D5DB"
      },
      boxShadow: {
        glow: "0 0 0 1px color-mix(in oklab, var(--accent), transparent 65%), 0 18px 60px -30px color-mix(in oklab, var(--accent), transparent 70%)"
      }
    }
  },
  plugins: []
} satisfies Config;

