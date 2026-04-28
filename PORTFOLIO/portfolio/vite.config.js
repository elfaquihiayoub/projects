import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

export default defineConfig({
  plugins: [react()],
  build: {
    target: "es2020",
    sourcemap: false,
    cssCodeSplit: true,
    chunkSizeWarningLimit: 900,
    rollupOptions: {
      output: {
        manualChunks: {
          "react-vendor": ["react", "react-dom"],
          "motion-vendor": ["framer-motion"],
          "icons-vendor": ["lucide-react", "react-icons/si"],
          "email-vendor": ["@emailjs/browser", "react-hot-toast"],
        },
      },
    },
  },
  server: {
    port: 5173,
    open: false,
  },
});
