import { memo } from "react";
import { ExternalLink, Github } from "lucide-react";
import SectionHeading from "./SectionHeading";

const ProjectCard = memo(function ProjectCard({ project }) {
  return (
    <article className="surface-card group overflow-hidden p-0">
      <div className="overflow-hidden">
        <img
          src={project.image}
          alt={project.title}
          className="aspect-video w-full object-cover transition-transform duration-500 ease-out group-hover:scale-[1.04]"
          loading="lazy"
          decoding="async"
          width="1000"
          height="563"
        />
      </div>
      <div className="space-y-3 p-5">
        <h3 className="font-heading text-lg font-semibold text-text-main dark:text-dark-text-main">
          {project.title}
        </h3>
        <p className="text-sm leading-relaxed text-text-secondary dark:text-dark-text-secondary">
          {project.description}
        </p>
        <div className="flex flex-wrap gap-1.5">
          {project.stack.map((item) => (
            <span
              key={item}
              className="rounded-full bg-accent/10 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-accent"
            >
              {item}
            </span>
          ))}
        </div>
        <div className="flex gap-2 pt-1">
          <a
            href={project.github}
            target="_blank"
            rel="noopener noreferrer"
            className="btn-secondary flex-1 text-xs"
            aria-label={`${project.title} GitHub`}
          >
            <Github className="h-3.5 w-3.5" aria-hidden="true" />
            GitHub
          </a>
          <a
            href={project.demo}
            target="_blank"
            rel="noopener noreferrer"
            className="btn-primary flex-1 text-xs"
            aria-label={`${project.title} live demo`}
          >
            <ExternalLink className="h-3.5 w-3.5" aria-hidden="true" />
            Live
          </a>
        </div>
      </div>
    </article>
  );
});

function ProjectsSection({ projects }) {
  return (
    <section id="projects" className="mx-auto max-w-6xl px-4 py-20 sm:px-6">
      <SectionHeading
        eyebrow="Selected Work"
        title="Featured Projects"
        subtitle="Selected products with clear business goals, clean UX, and measurable impact."
      />
      <div className="mt-10 grid gap-5 lg:grid-cols-3">
        {projects.map((project) => (
          <ProjectCard key={project.title} project={project} />
        ))}
      </div>
    </section>
  );
}

export default memo(ProjectsSection);
