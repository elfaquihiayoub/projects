import { memo } from "react";
import { Award } from "lucide-react";
import SectionHeading from "./SectionHeading";

function CertificationsSection({ certifications }) {
  if (!certifications?.length) return null;
  return (
    <section id="certifications" className="mx-auto max-w-6xl px-4 py-16 sm:px-6">
      <SectionHeading
        eyebrow="Recognition"
        title="Certifications"
        subtitle="Validated learning paths and recognitions in modern web development."
      />
      <div className="mt-8 grid gap-4 md:grid-cols-3">
        {certifications.map((item) => (
          <article key={item} className="surface-card flex items-start gap-3 p-5">
            <div className="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-accent/10 text-accent">
              <Award className="h-4 w-4" aria-hidden="true" />
            </div>
            <p className="text-sm font-medium leading-relaxed text-text-main dark:text-dark-text-main">
              {item}
            </p>
          </article>
        ))}
      </div>
    </section>
  );
}

export default memo(CertificationsSection);
