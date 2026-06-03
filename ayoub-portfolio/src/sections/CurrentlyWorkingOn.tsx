import { m } from "framer-motion";
import { Container } from "@/components/layout/Container";
import { SectionHeading } from "@/components/ui/SectionHeading";

export function CurrentlyWorkingOn() {
  return (
    <section aria-label="Currently Working On" className="py-20 sm:py-24">
      <Container>
        <SectionHeading
          eyebrow="Now"
          title="Currently working on"
          description="Active focus areas and what I’m building right now."
        />

        <div className="grid gap-6 lg:grid-cols-3">
          <m.div
            initial={{ opacity: 0, y: 16 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true, amount: 0.25 }}
            transition={{ duration: 0.35 }}
            className="card lg:col-span-2"
          >
            <div className="text-sm font-semibold text-text-2">Active project</div>
            <h3 className="mt-2 text-xl font-bold tracking-tight">Premium Portfolio System</h3>
            <p className="mt-2 text-text-2">
              Building a scalable portfolio architecture with reusable sections, smooth motion, and a recruiter-friendly narrative.
            </p>
            <div className="mt-5 flex flex-wrap gap-2">
              {["Clean Architecture", "Performance", "Accessibility", "SEO"].map((t) => (
                <span key={t} className="rounded-full border border-border bg-bg-2 px-3 py-1 text-xs font-semibold text-text-2">
                  {t}
                </span>
              ))}
            </div>
          </m.div>

          <m.div
            initial={{ opacity: 0, y: 16 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true, amount: 0.25 }}
            transition={{ duration: 0.35, delay: 0.05 }}
            className="card"
          >
            <div className="text-sm font-semibold text-text-2">Development focus</div>
            <ul className="mt-3 space-y-2 text-sm text-text-2">
              <li>• Strong UI/UX polish and spacing</li>
              <li>• Component reusability and scaling</li>
              <li>• Better API design thinking</li>
              <li>• Real-world project structure</li>
            </ul>
          </m.div>
        </div>
      </Container>
    </section>
  );
}

