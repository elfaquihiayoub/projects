import { memo, useMemo } from "react";
import SectionHeading from "./SectionHeading";

const CELL_COUNT = 52 * 7;

function getCellColor(level) {
  if (level === 0) return "bg-text-secondary/15 dark:bg-white/5";
  if (level === 1) return "bg-accent/25";
  if (level === 2) return "bg-accent/45";
  if (level === 3) return "bg-accent/70";
  return "bg-accent";
}

function generateContributionLevels() {
  const levels = new Array(CELL_COUNT);
  for (let i = 0; i < CELL_COUNT; i++) {
    const seeded = Math.sin(i * 12.9898) * 43758.5453;
    const fractional = seeded - Math.floor(seeded);
    levels[i] = Math.floor(fractional * 5);
  }
  return levels;
}

function ActivitySection({ githubStats }) {
  const contributionCells = useMemo(generateContributionLevels, []);

  return (
    <section
      id="stats"
      className="bg-background-secondary/60 py-20 transition-colors duration-300 dark:bg-dark-background-secondary/30"
    >
      <div className="mx-auto max-w-6xl px-4 sm:px-6">
        <SectionHeading
          eyebrow="Open Source"
          title="GitHub Activity"
          subtitle="A lightweight snapshot of coding consistency and open-source activity."
        />
        <div className="mt-10 grid gap-4 md:grid-cols-3">
          {githubStats.map((item) => (
            <article key={item.label} className="surface-card p-5">
              <p className="text-[11px] font-semibold uppercase tracking-[0.16em] text-text-secondary dark:text-dark-text-secondary">
                {item.label}
              </p>
              <p className="mt-2 font-heading text-2xl font-bold text-text-main dark:text-dark-text-main">
                {item.value}
              </p>
            </article>
          ))}
        </div>
        <div className="surface-card-static mt-5 p-5">
          <h3 className="text-xs font-semibold uppercase tracking-[0.16em] text-accent">
            Contribution Activity
          </h3>
          <div className="mt-4 grid min-w-[620px] grid-cols-[repeat(52,minmax(0,1fr))] gap-1 overflow-x-auto pb-1">
            {contributionCells.map((level, index) => (
              <div
                key={index}
                className={`h-2.5 w-2.5 rounded-sm ${getCellColor(level)}`}
                aria-hidden="true"
              />
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}

export default memo(ActivitySection);
