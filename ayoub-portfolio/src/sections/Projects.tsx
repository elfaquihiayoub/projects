import { m } from "framer-motion";
import { Container } from "@/components/layout/Container";
import { SectionHeading } from "@/components/ui/SectionHeading";
import { featuredProjects } from "@/data/projects";

export function Projects() {
  return (
    <section id="projects" aria-label="Projects" className="py-20 sm:py-24">
      <Container>
        <SectionHeading
          eyebrow="Featured Projects"
          title="Recruiter-friendly case studies with a product mindset."
          description="Problem → Solution → Result. Clean implementation, clear impact, and scalable foundations."
        />

        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {featuredProjects.map((p, idx) => (
            <m.article
              key={p.title}
              initial={{ opacity: 0, y: 18 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, amount: 0.22 }}
              transition={{ duration: 0.35, delay: idx * 0.04 }}
              className="group card overflow-hidden"
            >
              <div className="relative overflow-hidden rounded-2xl border border-border bg-bg-2">
                <div
                  aria-hidden="true"
                  className="aspect-[16/10] w-full bg-[radial-gradient(circle_at_top,rgba(0,207,255,0.22),transparent_60%),linear-gradient(135deg,rgba(17,24,39,0.25),transparent)]"
                />
                <div className="pointer-events-none absolute inset-0 opacity-0 transition group-hover:opacity-100">
                  <div className="absolute -inset-10 bg-[radial-gradient(circle_at_center,rgba(0,207,255,0.16),transparent_55%)]" />
                </div>
              </div>

              <h3 className="mt-5 text-lg font-bold tracking-tight">{p.title}</h3>
              <p className="mt-2 text-sm text-text-2">{p.description}</p>

              <div className="mt-4 flex flex-wrap gap-2">
                {p.tech.map((t) => (
                  <span key={t} className="rounded-full border border-border bg-bg-2 px-3 py-1 text-xs font-semibold text-text-2">
                    {t}
                  </span>
                ))}
              </div>

              <div className="mt-5 rounded-2xl border border-border bg-bg-2 p-4">
                <div className="text-xs font-semibold text-text-2">Case study</div>
                <dl className="mt-2 space-y-2 text-sm">
                  <div>
                    <dt className="font-semibold">Problem</dt>
                    <dd className="text-text-2">{p.caseStudy.problem}</dd>
                  </div>
                  <div>
                    <dt className="font-semibold">Solution</dt>
                    <dd className="text-text-2">{p.caseStudy.solution}</dd>
                  </div>
                  <div>
                    <dt className="font-semibold">Result</dt>
                    <dd className="text-text-2">{p.caseStudy.result}</dd>
                  </div>
                </dl>
              </div>

              <div className="mt-5 flex items-center gap-3">
                {p.githubUrl ? (
                  <a className="btn-ghost flex-1" href={p.githubUrl} target="_blank" rel="noopener noreferrer">
                    GitHub
                  </a>
                ) : null}
                {p.liveUrl ? (
                  <a className="btn-primary flex-1" href={p.liveUrl} target="_blank" rel="noopener noreferrer">
                    Live Demo
                  </a>
                ) : (
                  <span className="flex-1 rounded-xl border border-border bg-bg-2 px-4 py-2 text-center text-xs font-semibold text-text-2">
                    Live demo soon
                  </span>
                )}
              </div>
            </m.article>
          ))}
        </div>
      </Container>
    </section>
  );
}

