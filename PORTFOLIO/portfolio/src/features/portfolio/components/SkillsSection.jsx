import { memo } from "react";
import SectionHeading from "./SectionHeading";
import TechIcon from "./icons/TechIcon";

function SkillsSection({ skills }) {
  return (
    <section
      id="skills"
      className="bg-background-secondary/60 py-20 transition-colors duration-300 dark:bg-dark-background-secondary/30"
    >
      <div className="mx-auto max-w-6xl px-4 sm:px-6">
        <SectionHeading
          eyebrow="Tech Stack"
          title="Skills"
          subtitle="Core stack and tools I use to ship production-ready products quickly."
        />
        <div className="mt-10 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
          {skills.map((item) => (
            <article
              key={item.name}
              className="surface-card flex items-center gap-3 p-4"
            >
              <span className="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-background-secondary ring-1 ring-text-secondary/15 dark:bg-dark-background dark:ring-white/5">
                <TechIcon
                  iconKey={item.iconKey}
                  className="h-5 w-5"
                  color={item.color}
                  title={item.name}
                />
              </span>
              <span className="text-sm font-medium text-text-main dark:text-dark-text-main">
                {item.name}
              </span>
            </article>
          ))}
        </div>
      </div>
    </section>
  );
}

export default memo(SkillsSection);
