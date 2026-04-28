import { useThemeContext } from "../../../app/providers/ThemeProvider";

export function useTheme() {
  const { theme, toggleTheme } = useThemeContext();
  return { theme, toggleTheme };
}
