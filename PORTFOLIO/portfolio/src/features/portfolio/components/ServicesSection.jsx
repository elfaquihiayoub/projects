import { memo } from "react";
import { Rocket, LayoutDashboard, Gauge } from "lucide-react";
import SectionHeading from "./SectionHeading";

const ICON_MAP = {
  rocket: Rocket,
  layout: LayoutDashboard,
  gauge: Gauge,
};

function ServicesSection({ services }) {
  return (
    <section id="services" className="mx-auto max-w-6xl px-4 py-20 sm:px-6">
      <SectionHeading
        eyebrow="What I Offer"
        title="Services"
        subtitle="Core services and credentials aligned with product-focused development."
      />
      <div className="mt-10 grid gap-4 md:grid-cols-3">
        {services.map((service) => {
          const Icon = ICON_MAP[service.iconKey];
          return (
            <article key={service.title} className="surface-card p-5">
              <div className="flex h-11 w-11 items-center justify-center rounded-xl bg-accent/10 text-accent">
                {Icon ? <Icon className="h-5 w-5" aria-hidden="true" /> : null}
              </div>
              <h3 className="mt-4 font-heading text-lg font-semibold text-text-main dark:text-dark-text-main">
                {service.title}
              </h3>
              <p className="mt-1.5 text-sm leading-relaxed text-text-secondary dark:text-dark-text-secondary">
                {service.description}
              </p>
            </article>
          );
        })}
      </div>
    </section>
  );
}

export default memo(ServicesSection);
