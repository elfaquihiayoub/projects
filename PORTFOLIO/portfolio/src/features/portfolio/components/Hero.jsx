import { memo } from "react";
import { motion, useReducedMotion } from "framer-motion";
import { ArrowRight, Github, Linkedin, Mail } from "lucide-react";
import CVDownloadButton from "./ui/CVDownloadButton";

function Hero({ profile, onViewProjects }) {
  const prefersReducedMotion = useReducedMotion();
  const isUnsplashAvatar =
    typeof profile.avatar === "string" &&
    profile.avatar.includes("images.unsplash.com");
  const avatarSrcSet = isUnsplashAvatar
    ? `${profile.avatar.replace(/w=\d+/, "w=600")} 600w, ${profile.avatar} 900w`
    : undefined;
  const fadeIn = prefersReducedMotion
    ? { initial: false, animate: undefined }
    : {
        initial: { opacity: 0, y: 24 },
        animate: { opacity: 1, y: 0 },
      };

  return (
    <section
      id="home"
      className="mx-auto flex min-h-[88vh] max-w-6xl items-center px-4 pb-16 pt-28 sm:px-6"
    >
      <div className="grid w-full items-center gap-10 md:grid-cols-2">
        <motion.div
          {...fadeIn}
          transition={{ duration: 0.55, ease: "easeOut" }}
          className="space-y-6"
        >
          <span className="section-eyebrow">{profile.role}</span>
          <h1 className="font-heading text-4xl font-bold leading-[1.05] tracking-tight text-text-main dark:text-dark-text-main sm:text-5xl md:text-6xl">
            {profile.fullName}
          </h1>
          <p className="max-w-xl text-base leading-relaxed text-text-secondary dark:text-dark-text-secondary md:text-lg">
            {profile.tagline}
          </p>

          <div className="flex flex-wrap items-center gap-3">
            <CVDownloadButton
              fileUrl={profile.resumeFile}
              fileName={profile.resumeFileName}
            />
            <button onClick={onViewProjects} className="btn-secondary">
              View Projects
              <ArrowRight className="h-4 w-4" aria-hidden="true" />
            </button>
          </div>

          <div className="flex items-center gap-3 pt-2">
            <a
              href={profile.github}
              target="_blank"
              rel="noopener noreferrer"
              aria-label="GitHub"
              className="rounded-lg border border-text-secondary/25 p-2.5 text-text-secondary transition-colors hover:border-accent hover:text-accent dark:border-white/10 dark:text-dark-text-secondary"
            >
              <Github className="h-4 w-4" />
            </a>
            <a
              href={profile.linkedin}
              target="_blank"
              rel="noopener noreferrer"
              aria-label="LinkedIn"
              className="rounded-lg border border-text-secondary/25 p-2.5 text-text-secondary transition-colors hover:border-accent hover:text-accent dark:border-white/10 dark:text-dark-text-secondary"
            >
              <Linkedin className="h-4 w-4" />
            </a>
            <a
              href={`mailto:${profile.email}`}
              aria-label="Email"
              className="rounded-lg border border-text-secondary/25 p-2.5 text-text-secondary transition-colors hover:border-accent hover:text-accent dark:border-white/10 dark:text-dark-text-secondary"
            >
              <Mail className="h-4 w-4" />
            </a>
          </div>
        </motion.div>

        <motion.div
          {...fadeIn}
          transition={{ duration: 0.55, delay: 0.08, ease: "easeOut" }}
          className="relative mx-auto w-full max-w-md"
        >
          <div className="absolute -inset-4 -z-10 rounded-3xl bg-accent/10 blur-2xl" aria-hidden="true" />
          <div className="surface-card-static overflow-hidden p-3">
            <img
              alt={`${profile.fullName} workspace`}
              className="aspect-[4/5] w-full rounded-xl object-cover"
              src={profile.avatar}
              srcSet={avatarSrcSet}
              sizes="(min-width: 768px) 28rem, 90vw"
              loading="eager"
              decoding="async"
              fetchpriority="high"
              width="448"
              height="560"
            />
          </div>
        </motion.div>
      </div>
    </section>
  );
}

export default memo(Hero);
