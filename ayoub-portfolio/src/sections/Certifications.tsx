import { m } from "framer-motion";
import { Container } from "@/components/layout/Container";
import { SectionHeading } from "@/components/ui/SectionHeading";

const certs = [
  { title: "Full Stack Foundations", org: "Solicode Tanger", year: "2026" },
  { title: "UI/UX Basics", org: "Self-learning", year: "2026" },
  { title: "Git & GitHub Workflow", org: "Practice projects", year: "2026" }
] as const;

export function Certifications() {
  return (
    <section aria-label="Certifications" className="py-20 sm:py-24">
      <Container>
        <SectionHeading
          eyebrow="Certifications"
          title="Learning achievements"
          description="Continuous learning with practical application through projects."
        />

        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {certs.map((c, idx) => (
            <m.div
              key={c.title}
              initial={{ opacity: 0, y: 16 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, amount: 0.25 }}
              transition={{ duration: 0.35, delay: idx * 0.04 }}
              className="card"
            >
              <div className="text-sm font-semibold text-text-2">{c.org}</div>
              <div className="mt-2 text-lg font-bold tracking-tight">{c.title}</div>
              <div className="mt-3 text-sm text-text-2">{c.year}</div>
            </m.div>
          ))}
        </div>
      </Container>
    </section>
  );
}

