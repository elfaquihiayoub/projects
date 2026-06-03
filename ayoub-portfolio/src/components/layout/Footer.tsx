import { Container } from "@/components/layout/Container";
import { AFLogo } from "@/components/branding/AFLogo";
import { profile } from "@/data/profile";

export function Footer() {
  const year = new Date().getFullYear();
  return (
    <footer className="border-t border-border/60 py-12">
      <Container>
        <div className="grid gap-8 lg:grid-cols-3">
          <div>
            <AFLogo label="AYOUB" />
            <p className="mt-3 max-w-sm text-sm text-text-2">
              Premium, recruiter-friendly portfolio built with React, Tailwind, and Framer Motion.
            </p>
          </div>

          <div className="grid gap-2 text-sm">
            <div className="font-semibold">Quick links</div>
            <a className="text-text-2 hover:text-text focus-ring w-fit rounded-lg" href="#about">
              About
            </a>
            <a className="text-text-2 hover:text-text focus-ring w-fit rounded-lg" href="#projects">
              Projects
            </a>
            <a className="text-text-2 hover:text-text focus-ring w-fit rounded-lg" href="#contact">
              Contact
            </a>
          </div>

          <div className="grid gap-2 text-sm">
            <div className="font-semibold">Social</div>
            <a
              className="text-text-2 hover:text-text focus-ring w-fit rounded-lg"
              href={profile.github.url}
              target="_blank"
              rel="noopener noreferrer"
            >
              GitHub
            </a>
            <a className="text-text-2 hover:text-text focus-ring w-fit rounded-lg" href={`mailto:${profile.email}`}>
              Email
            </a>
            <a className="text-text-2 hover:text-text focus-ring w-fit rounded-lg" href={profile.resume.href} download={profile.resume.fileName}>
              Resume
            </a>
          </div>
        </div>

        <div className="mt-10 flex flex-wrap items-center justify-between gap-3 border-t border-border/60 pt-6 text-xs text-text-2">
          <span>© {year} {profile.name}. All rights reserved.</span>
          <span>Built for performance, accessibility, and modern hiring.</span>
        </div>
      </Container>
    </footer>
  );
}

