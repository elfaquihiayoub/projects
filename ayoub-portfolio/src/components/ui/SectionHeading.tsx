import { cn } from "@/lib/cn";

type Props = {
  eyebrow?: string;
  title: string;
  description?: string;
  className?: string;
};

export function SectionHeading({ eyebrow, title, description, className }: Props) {
  return (
    <div className={cn("mb-8", className)}>
      {eyebrow ? (
        <div className="mb-2 inline-flex items-center gap-2 text-xs font-semibold tracking-wider text-text-2">
          <span className="h-1.5 w-1.5 rounded-full bg-accent shadow-glow" />
          <span className="uppercase">{eyebrow}</span>
        </div>
      ) : null}
      <h2 className="text-balance text-2xl font-bold tracking-tight sm:text-3xl">{title}</h2>
      {description ? <p className="mt-2 max-w-2xl text-pretty text-text-2">{description}</p> : null}
    </div>
  );
}

