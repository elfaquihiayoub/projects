import { cn } from "@/lib/cn";
import type { Theme } from "@/hooks/useTheme";

type Props = {
  theme: Theme;
  onToggle: () => void;
  className?: string;
};

export function ThemeToggle({ theme, onToggle, className }: Props) {
  const isDark = theme === "dark";
  return (
    <button
      type="button"
      className={cn(
        "group inline-flex h-10 items-center gap-2 rounded-xl border border-border bg-bg bg-opacity-70 px-3 text-sm font-semibold backdrop-blur-xl transition hover:bg-bg-2 focus-ring",
        className
      )}
      onClick={onToggle}
      aria-label={isDark ? "Switch to light mode" : "Switch to dark mode"}
      aria-pressed={isDark}
    >
      <span
        aria-hidden="true"
        className={cn(
          "grid h-7 w-7 place-items-center rounded-lg border border-border bg-bg-2 transition group-hover:shadow-glow"
        )}
      >
        {isDark ? "☀️" : "🌙"}
      </span>
      <span className="hidden sm:inline">{isDark ? "Light Mode" : "Dark Mode"}</span>
    </button>
  );
}

