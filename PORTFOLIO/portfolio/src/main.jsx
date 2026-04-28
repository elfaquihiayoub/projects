import React from "react";
import ReactDOM from "react-dom/client";
import { Toaster } from "react-hot-toast";
import App from "./app/App";
import { ThemeProvider } from "./app/providers/ThemeProvider";
import "./index.css";

ReactDOM.createRoot(document.getElementById("root")).render(
  <React.StrictMode>
    <ThemeProvider>
      <App />
      <Toaster
        position="bottom-right"
        gutter={10}
        toastOptions={{
          duration: 4000,
          style: {
            background: "#111827",
            color: "#fff",
            border: "1px solid rgba(255,255,255,0.08)",
            borderRadius: "12px",
            fontSize: "14px",
          },
          success: {
            iconTheme: { primary: "#00CFFF", secondary: "#0B0F19" },
          },
          error: {
            iconTheme: { primary: "#ef4444", secondary: "#0B0F19" },
          },
        }}
      />
    </ThemeProvider>
  </React.StrictMode>
);
