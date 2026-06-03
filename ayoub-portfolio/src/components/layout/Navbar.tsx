import { useEffect, useMemo, useState } from "react";
import { m, AnimatePresence } from "framer-motion";
import { AFLogo } from "@/components/branding/AFLogo";
import { Container } from "@/components/layout/Container";
import { ThemeToggle } from "@/components/ui/ThemeToggle";
import { profile } from "@/data/profile";
import type { Theme } from "@/hooks/useTheme";
import { cn } from "@/lib/cn";

type Props = {
  theme: Theme;
  onToggleTheme: () => void;
};

const navItems = [
  { href: "#home", label: "Home" },
  { href: "#about", label: "About" },
  { href: "#skills", label: "Skills" },
  { href: "#projects", label: "Projects" },
  { href: "#github", label: "GitHub Stats" },
  { href: "#contact", label: "Contact" }
] as const;

export function Navbar({ theme, onToggleTheme }: Props) {
  const [open, setOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 8);
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  const resumeHref = useMemo(() => profile.resume.href, []);

  return (
    <header className="fixed left-0 top-0 z-50 w-full">
      <div
        className={cn(
          "pointer-events-none absolute inset-0",
          scrolled ? "bg-bg bg-opacity-50 backdrop-blur-2xl" : "bg-transparent"
        )}
      />
      <Container className="relative">
        <div
          className={cn(
            "flex h-16 items-center justify-between gap-4",
            scrolled ? "border-b border-border/60" : "border-b border-transparent"
          )}
        >
          <a href="#home" className="focus-ring rounded-xl">
            <AFLogo label="AYOUB" />
          </a>

          <nav className="hidden items-center gap-1 lg:flex" aria-label="Primary">
            {navItems.map((item) => (
              <a
                key={item.href}
                href={item.href}
                className="rounded-xl px-3 py-2 text-sm font-semibold text-text-2 transition hover:text-text focus-ring"
              >
                {item.label}
              </a>
            ))}
          </nav>

          <div className="flex items-center gap-2">
            <a
              className="btn-ghost hidden sm:inline-flex"
              href={resumeHref}
              download={profile.resume.fileName}
              rel="noopener noreferrer"
            >
              Resume
            </a>
            <ThemeToggle theme={theme} onToggle={onToggleTheme} />
            <button
              type="button"
              className="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-border bg-bg bg-opacity-70 backdrop-blur-xl transition hover:bg-bg-2 focus-ring lg:hidden"
              aria-label={open ? "Close menu" : "Open menu"}
              aria-expanded={open}
              onClick={() => setOpen((v) => !v)}
            >
              <span aria-hidden="true" className="text-lg">
                {open ? "✕" : "☰"}
              </span>
            </button>
          </div>
        </div>

        <AnimatePresence>
          {open ? (
            <m.nav
              aria-label="Mobile"
              initial={{ opacity: 0, y: -6 }}
              animate={{ opacity: 1, y: 0 }}
              exit={{ opacity: 0, y: -6 }}
              transition={{ duration: 0.18 }}
              className="lg:hidden"
            >
              <div className="mt-2 rounded-2xl border border-border bg-bg bg-opacity-85 p-2 backdrop-blur-2xl">
                {navItems.map((item) => (
                  <a
                    key={item.href}
                    href={item.href}
                    className="block rounded-xl px-3 py-3 text-sm font-semibold text-text-2 transition hover:text-text hover:bg-bg-2 focus-ring"
                    onClick={() => setOpen(false)}
                  >
                    {item.label}
                  </a>
                ))}
                <a
                  className="mt-1 block rounded-xl px-3 py-3 text-sm font-semibold text-text transition hover:bg-bg-2 focus-ring sm:hidden"
                  href={resumeHref}
                  download={profile.resume.fileName}
                  rel="noopener noreferrer"
                  onClick={() => setOpen(false)}
                >
                  Download Resume
                </a>
              </div>
            </m.nav>
          ) : null}
        </AnimatePresence>
      </Container>
    </header>
  );
}

