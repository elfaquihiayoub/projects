import { m } from "framer-motion";
import { profile } from "@/data/profile";
import { Container } from "@/components/layout/Container";
import { DeveloperVisual } from "@/components/branding/DeveloperVisual";

export function Hero() {
  return (
    <section id="home" aria-label="Hero" className="relative pt-28 sm:pt-32">
      <div aria-hidden="true" className="pointer-events-none absolute inset-x-0 -top-24 h-96 bg-[radial-gradient(circle_at_top,rgba(0,207,255,0.14),transparent_62%)]" />
      <Container>
        <div className="grid items-center gap-10 lg:grid-cols-2">
          <div>
            <m.p
              initial={{ opacity: 0, y: 10 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.35 }}
              className="inline-flex items-center gap-2 rounded-full border border-border bg-bg bg-opacity-70 px-4 py-2 text-xs font-semibold text-text-2 backdrop-blur-xl"
            >
              <span className="h-1.5 w-1.5 rounded-full bg-accent shadow-glow" />
              {profile.school} • {profile.location}
            </m.p>

            <m.h1
              initial={{ opacity: 0, y: 12 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.4, delay: 0.05 }}
              className="mt-5 text-balance text-4xl font-bold tracking-tight sm:text-5xl"
            >
              {profile.name}
            </m.h1>

            <m.p
              initial={{ opacity: 0, y: 12 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.4, delay: 0.1 }}
              className="mt-3 text-lg font-semibold text-text-2"
            >
              {profile.title}
            </m.p>

            <m.p
              initial={{ opacity: 0, y: 12 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.4, delay: 0.15 }}
              className="mt-6 max-w-xl text-pretty text-text-2"
            >
              <span className="font-semibold text-text">“</span>
              {profile.tagline}
              <span className="font-semibold text-text">”</span>
            </m.p>

            <m.div
              initial={{ opacity: 0, y: 12 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.4, delay: 0.2 }}
              className="mt-8 flex flex-wrap items-center gap-3"
            >
              <a className="btn-primary" href="#contact">
                Hire Me
              </a>
              <a className="btn-ghost" href={profile.resume.href} download={profile.resume.fileName} rel="noopener noreferrer">
                Download CV
              </a>
              <a className="btn-ghost" href="#projects">
                View Projects
              </a>
            </m.div>

            <div className="mt-8 flex flex-wrap items-center gap-3 text-sm text-text-2">
              <a className="hover:text-text focus-ring rounded-lg" href={profile.github.url} target="_blank" rel="noopener noreferrer">
                GitHub: {profile.github.username}
              </a>
              <span aria-hidden="true">•</span>
              <a className="hover:text-text focus-ring rounded-lg" href={`mailto:${profile.email}`}>
                {profile.email}
              </a>
            </div>
          </div>

          <m.div initial={{ opacity: 0, y: 16 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.5, delay: 0.1 }}>
            <DeveloperVisual />
          </m.div>
        </div>
      </Container>
    </section>
  );
}

