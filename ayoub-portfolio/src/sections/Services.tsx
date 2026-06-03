import { m } from "framer-motion";
import { Container } from "@/components/layout/Container";
import { SectionHeading } from "@/components/ui/SectionHeading";

const services = [
  {
    title: "Web Development",
    icon: "💻",
    desc: "Modern, responsive websites with clean code, strong UX, and production-ready performance."
  },
  {
    title: "UI Design",
    icon: "🧠",
    desc: "Minimal, premium interfaces with clear hierarchy, accessibility basics, and smooth interactions."
  }
] as const;

export function Services() {
  return (
    <section aria-label="Services" className="py-20 sm:py-24">
      <Container>
        <SectionHeading eyebrow="Services" title="What I can help you build" description="Simple, high-quality services with a product mindset." />
        <div className="grid gap-6 md:grid-cols-2">
          {services.map((s, idx) => (
            <m.div
              key={s.title}
              initial={{ opacity: 0, y: 16 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, amount: 0.25 }}
              transition={{ duration: 0.35, delay: idx * 0.04 }}
              className="card"
            >
              <div className="flex items-center gap-3">
                <div className="grid h-12 w-12 place-items-center rounded-2xl border border-border bg-bg-2 text-xl shadow-glow">
                  <span aria-hidden="true">{s.icon}</span>
                </div>
                <div>
                  <h3 className="text-lg font-bold tracking-tight">{s.title}</h3>
                  <p className="text-sm text-text-2">{s.desc}</p>
                </div>
              </div>
            </m.div>
          ))}
        </div>
      </Container>
    </section>
  );
}

