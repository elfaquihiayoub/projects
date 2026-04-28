import { memo } from "react";
import { Github, Linkedin, Mail } from "lucide-react";
import AFLogo from "./AFLogo";

function Footer({ navItems, profile, onNavigate }) {
  return (
    <footer className="border-t border-text-secondary/15 py-10 transition-colors duration-300 dark:border-white/5">
      <div className="mx-auto flex max-w-6xl flex-col gap-6 px-4 sm:px-6 md:flex-row md:items-center md:justify-between">
        <div className="flex items-center gap-4">
          <AFLogo />
          <p className="text-[11px] uppercase tracking-wider text-text-secondary dark:text-dark-text-secondary">
            © {new Date().getFullYear()} {profile.fullName}. Built with React, Tailwind & Framer Motion.
          </p>
        </div>

        <div className="flex flex-wrap items-center gap-4">
          {navItems.slice(0, 6).map((item) => (
            <button
              key={item.id}
              onClick={() => onNavigate(item.id)}
              className="text-[11px] font-medium uppercase tracking-wider text-text-secondary transition-colors hover:text-accent dark:text-dark-text-secondary"
            >
              {item.label}
            </button>
          ))}
          <div className="flex items-center gap-2 pl-1">
            <a
              href={profile.github}
              target="_blank"
              rel="noopener noreferrer"
              className="rounded-lg border border-text-secondary/25 p-1.5 text-text-secondary transition-colors hover:border-accent hover:text-accent dark:border-white/10 dark:text-dark-text-secondary"
              aria-label="GitHub"
            >
              <Github className="h-3.5 w-3.5" />
            </a>
            <a
              href={profile.linkedin}
              target="_blank"
              rel="noopener noreferrer"
              className="rounded-lg border border-text-secondary/25 p-1.5 text-text-secondary transition-colors hover:border-accent hover:text-accent dark:border-white/10 dark:text-dark-text-secondary"
              aria-label="LinkedIn"
            >
              <Linkedin className="h-3.5 w-3.5" />
            </a>
            <a
              href={`mailto:${profile.email}`}
              className="rounded-lg border border-text-secondary/25 p-1.5 text-text-secondary transition-colors hover:border-accent hover:text-accent dark:border-white/10 dark:text-dark-text-secondary"
              aria-label="Email"
            >
              <Mail className="h-3.5 w-3.5" />
            </a>
          </div>
        </div>
      </div>
    </footer>
  );
}

export default memo(Footer);
