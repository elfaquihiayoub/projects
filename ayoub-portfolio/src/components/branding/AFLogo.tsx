import { cn } from "@/lib/cn";

type Props = {
  className?: string;
  label?: string;
};

export function AFLogo({ className, label = "AYOUB ELFAQUIHI" }: Props) {
  return (
    <div className={cn("inline-flex items-center gap-3", className)}>
      <div
        aria-hidden="true"
        className="relative grid h-10 w-10 place-items-center rounded-2xl border border-border bg-bg-2 shadow-glow"
      >
        <svg width="22" height="22" viewBox="0 0 24 24" className="text-text" role="img" aria-label="AF monogram">
          <path
            d="M6 18L10 6h4l4 12h-3l-1-3h-6l-1 3H6Zm5-6h4l-2-6-2 6Z"
            fill="currentColor"
            opacity="0.95"
          />
          <path
            d="M18.2 8.2c-1.2-1.2-3.1-1.2-4.3 0l-.7.7 1.8 1.8.7-.7c.2-.2.6-.2.8 0 .2.2.2.6 0 .8l-1.9 1.9 1.8 1.8 1.9-1.9c1.2-1.2 1.2-3.1 0-4.2Z"
            fill="currentColor"
            opacity="0.55"
          />
        </svg>
        <div className="pointer-events-none absolute -inset-3 rounded-[22px] bg-[radial-gradient(circle_at_top,rgba(0,207,255,0.22),transparent_60%)]" />
      </div>
      <div className="leading-tight">
        <div className="text-sm font-semibold tracking-tight">{label}</div>
        <div className="text-xs text-text-2">Portfolio</div>
      </div>
    </div>
  );
}

