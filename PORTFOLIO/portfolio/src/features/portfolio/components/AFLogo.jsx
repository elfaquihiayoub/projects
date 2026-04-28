import { memo } from "react";

function AFLogo() {
  return (
    <div className="flex h-10 w-10 items-center justify-center rounded-xl border border-accent/35 bg-background-secondary shadow-soft transition-colors duration-300 dark:bg-dark-background-secondary dark:shadow-soft-dark">
      <span className="font-heading text-sm font-bold tracking-[0.18em] text-accent">AF</span>
    </div>
  );
}

export default memo(AFLogo);
