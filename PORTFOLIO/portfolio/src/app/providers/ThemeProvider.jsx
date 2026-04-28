import { createContext, useCallback, useContext, useEffect, useMemo, useState } from "react";

const THEME_KEY = "portfolio-theme-v2";
const ThemeContext = createContext(null);

function getInitialTheme() {
  if (typeof window === "undefined") return "dark";
  try {
    const savedTheme = window.localStorage.getItem(THEME_KEY);
    if (savedTheme === "light" || savedTheme === "dark") return savedTheme;
  } catch {
    // Keep default when storage is unavailable.
  }
  return "dark";
}

function applyTheme(theme) {
  if (typeof document === "undefined") return;

  const isDark = theme === "dark";
  document.documentElement.classList.toggle("dark", isDark);
  document.body.classList.toggle("dark", isDark);
  document.documentElement.setAttribute("data-theme", theme);
  document.documentElement.style.colorScheme = isDark ? "dark" : "light";
}

export function ThemeProvider({ children }) {
  const [theme, setTheme] = useState(getInitialTheme);

  useEffect(() => {
    applyTheme(theme);
    try {
      window.localStorage.setItem(THEME_KEY, theme);
    } catch {
      // Ignore write errors and keep runtime theme updates.
    }
  }, [theme]);

  const toggleTheme = useCallback(() => {
    setTheme((prev) => (prev === "dark" ? "light" : "dark"));
  }, []);

  const value = useMemo(
    () => ({
      theme,
      setTheme,
      toggleTheme,
    }),
    [theme, toggleTheme]
  );

  return <ThemeContext.Provider value={value}>{children}</ThemeContext.Provider>;
}

export function useThemeContext() {
  const context = useContext(ThemeContext);
  if (!context) {
    throw new Error("useThemeContext must be used within ThemeProvider.");
  }
  return context;
}
