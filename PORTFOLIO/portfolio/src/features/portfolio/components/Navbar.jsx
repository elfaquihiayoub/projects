import { memo } from "react";
import { AnimatePresence, motion } from "framer-motion";
import { Menu, X, Sun, Moon, Download } from "lucide-react";
import AFLogo from "./AFLogo";

function Navbar({
  profile,
  navItems,
  activeSection,
  onNavigate,
  menuOpen,
  onToggleMenu,
  theme,
  onToggleTheme,
}) {
  const isDark = theme === "dark";

  return (
    <nav
      role="navigation"
      aria-label="Primary"
      className="fixed inset-x-0 top-0 z-50 border-b border-text-secondary/15 bg-background/80 backdrop-blur-md transition-colors duration-300 dark:border-white/5 dark:bg-dark-background/80"
    >
      <div className="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6">
        <button
          onClick={() => onNavigate("home")}
          className="flex items-center gap-3"
          aria-label="Go to home"
        >
          <AFLogo />
          <span className="hidden text-left md:block">
            <span className="block text-[10px] uppercase tracking-[0.2em] text-text-secondary dark:text-dark-text-secondary">
              Portfolio
            </span>
            <span className="block font-heading text-xs text-text-main dark:text-dark-text-main">
              {profile.fullName}
            </span>
          </span>
        </button>

        <div className="hidden items-center gap-5 text-[11px] font-semibold uppercase tracking-widest md:flex">
          {navItems.map((item) => {
            const isActive = activeSection === item.id;
            return (
              <button
                key={item.id}
                onClick={() => onNavigate(item.id)}
                className={`relative transition-colors ${
                  isActive
                    ? "text-accent"
                    : "text-text-secondary hover:text-text-main dark:text-dark-text-secondary dark:hover:text-dark-text-main"
                }`}
                aria-current={isActive ? "page" : undefined}
              >
                {item.label}
                {isActive && (
                  <motion.span
                    layoutId="activeNav"
                    className="absolute -bottom-2 left-0 right-0 h-0.5 rounded-full bg-accent"
                    transition={{ type: "spring", stiffness: 380, damping: 36 }}
                  />
                )}
              </button>
            );
          })}
        </div>

        <div className="flex items-center gap-1.5">
          <a
            href={profile.resumeFile}
            download={profile.resumeFileName}
            className="hidden items-center gap-1.5 rounded-lg bg-accent px-3 py-2 text-xs font-semibold text-[#04131a] shadow-[0_8px_22px_-8px_rgba(0,207,255,0.65)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-accent-strong md:inline-flex"
          >
            <Download className="h-3.5 w-3.5" aria-hidden="true" />
            Resume
          </a>
          <button
            type="button"
            onClick={onToggleTheme}
            className="rounded-lg border border-text-secondary/30 px-3 py-2 text-xs font-semibold text-text-main transition-colors duration-200 hover:border-accent hover:text-accent dark:border-white/15 dark:text-dark-text-main"
            aria-label={isDark ? "Switch to light mode" : "Switch to dark mode"}
            aria-pressed={!isDark}
          >
            <span className="inline-flex items-center gap-1">
              {isDark ? <Sun className="h-3.5 w-3.5" /> : <Moon className="h-3.5 w-3.5" />}
              <span className="hidden md:inline">{isDark ? "Light" : "Dark"}</span>
            </span>
          </button>
          <button
            type="button"
            onClick={onToggleMenu}
            className="rounded-lg border border-text-secondary/30 p-2 text-text-main dark:border-white/15 dark:text-dark-text-main md:hidden"
            aria-label={menuOpen ? "Close menu" : "Open menu"}
            aria-expanded={menuOpen}
          >
            {menuOpen ? <X className="h-4 w-4" /> : <Menu className="h-4 w-4" />}
          </button>
        </div>
      </div>

      <AnimatePresence initial={false}>
        {menuOpen && (
          <motion.div
            initial={{ opacity: 0, height: 0 }}
            animate={{ opacity: 1, height: "auto" }}
            exit={{ opacity: 0, height: 0 }}
            transition={{ duration: 0.22, ease: "easeInOut" }}
            className="space-y-2 overflow-hidden border-t border-text-secondary/15 bg-background px-4 pb-4 pt-2 transition-colors duration-300 dark:border-white/5 dark:bg-dark-background-secondary md:hidden"
          >
            {navItems.map((item) => (
              <button
                key={item.id}
                onClick={() => onNavigate(item.id)}
                className="block w-full rounded-lg px-3 py-2 text-left text-sm text-text-secondary transition-colors hover:bg-background-secondary hover:text-text-main dark:text-dark-text-secondary dark:hover:bg-white/5 dark:hover:text-dark-text-main"
              >
                {item.label}
              </button>
            ))}
            <a
              href={profile.resumeFile}
              download={profile.resumeFileName}
              className="mt-2 flex items-center justify-center gap-2 rounded-lg bg-accent px-3 py-2 text-center text-sm font-semibold text-[#04131a]"
            >
              <Download className="h-4 w-4" aria-hidden="true" />
              Download CV
            </a>
          </motion.div>
        )}
      </AnimatePresence>
    </nav>
  );
}

export default memo(Navbar);
