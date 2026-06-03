import { m } from "framer-motion";
import { Container } from "@/components/layout/Container";
import { SectionHeading } from "@/components/ui/SectionHeading";

const items = [
  { title: "Open for Internship Opportunities", desc: "Actively looking to join a team, learn fast, and ship features." },
  { title: "Available for Freelance Work", desc: "Small to medium web projects with premium UI and clean code." }
] as const;

export function Availability() {
  return (
    <section aria-label="Availability" className="py-20 sm:py-24">
      <Container>
        <SectionHeading eyebrow="Availability" title="Ready to collaborate" description="Clear status for recruiters and clients." />
        <div className="grid gap-6 md:grid-cols-2">
          {items.map((i, idx) => (
            <m.div
              key={i.title}
              initial={{ opacity: 0, y: 16 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, amount: 0.25 }}
              transition={{ duration: 0.35, delay: idx * 0.04 }}
              className="card"
            >
              <div className="flex items-start justify-between gap-3">
                <div>
                  <h3 className="text-lg font-bold tracking-tight">{i.title}</h3>
                  <p className="mt-2 text-text-2">{i.desc}</p>
                </div>
                <span aria-hidden="true" className="mt-1 inline-flex h-3 w-3 rounded-full bg-accent shadow-glow" />
              </div>
            </m.div>
          ))}
        </div>
      </Container>
    </section>
  );
}

