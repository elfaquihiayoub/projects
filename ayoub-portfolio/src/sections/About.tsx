import { m } from "framer-motion";
import { Container } from "@/components/layout/Container";
import { SectionHeading } from "@/components/ui/SectionHeading";

const stats = [
  { label: "Projects Completed", value: "15+" },
  { label: "Technologies Mastered", value: "12+" },
  { label: "Years Learning", value: "2+" }
] as const;

export function About() {
  return (
    <section id="about" aria-label="About" className="py-20 sm:py-24">
      <Container>
        <SectionHeading
          eyebrow="About"
          title="Building real-world solutions with modern web engineering."
          description="Student at Solicode Tanger, passionate about web development and aiming to become a professional Software Engineer—focused on creating impactful, production-ready experiences."
        />

        <div className="grid gap-6 lg:grid-cols-3">
          <m.div
            initial={{ opacity: 0, y: 14 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true, amount: 0.25 }}
            transition={{ duration: 0.35 }}
            className="card lg:col-span-2"
          >
            <h3 className="text-lg font-bold tracking-tight">What I care about</h3>
            <p className="mt-3 text-pretty text-text-2">
              I care about clean architecture, accessibility, performance, and UI polish. I enjoy turning complex requirements into
              simple, elegant interfaces, and I take ownership—from planning and implementation to testing and delivery.
            </p>
            <div className="mt-6 grid gap-3 sm:grid-cols-2">
              <div className="rounded-2xl border border-border bg-bg-2 p-4">
                <div className="text-sm font-semibold">Strengths</div>
                <ul className="mt-2 space-y-1 text-sm text-text-2">
                  <li>Reusable component systems</li>
                  <li>API-first thinking</li>
                  <li>High attention to UX detail</li>
                </ul>
              </div>
              <div className="rounded-2xl border border-border bg-bg-2 p-4">
                <div className="text-sm font-semibold">Currently improving</div>
                <ul className="mt-2 space-y-1 text-sm text-text-2">
                  <li>System design fundamentals</li>
                  <li>Testing strategy & tooling</li>
                  <li>Advanced accessibility patterns</li>
                </ul>
              </div>
            </div>
          </m.div>

          <div className="grid gap-4">
            {stats.map((s, idx) => (
              <m.div
                key={s.label}
                initial={{ opacity: 0, y: 14 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true, amount: 0.3 }}
                transition={{ duration: 0.3, delay: idx * 0.05 }}
                className="card"
              >
                <div className="text-3xl font-bold tracking-tight">{s.value}</div>
                <div className="mt-1 text-sm font-semibold text-text-2">{s.label}</div>
              </m.div>
            ))}
          </div>
        </div>
      </Container>
    </section>
  );
}

