import { memo } from "react";
import SectionHeading from "./SectionHeading";

function AboutSection({ profile, statCards }) {
  return (
    <section id="about" className="mx-auto max-w-6xl px-4 py-20 sm:px-6">
      <SectionHeading
        eyebrow="Who I Am"
        title="About Me"
        subtitle={profile.shortBio}
      />
      <div className="mt-10 grid gap-4 sm:grid-cols-3">
        {statCards.map((card) => (
          <article key={card.label} className="surface-card p-5">
            <p className="font-heading text-3xl font-bold text-text-main dark:text-dark-text-main">
              {card.value}
            </p>
            <p className="mt-1 text-xs font-semibold uppercase tracking-[0.16em] text-text-secondary dark:text-dark-text-secondary">
              {card.label}
            </p>
          </article>
        ))}
      </div>
    </section>
  );
}

export default memo(AboutSection);
