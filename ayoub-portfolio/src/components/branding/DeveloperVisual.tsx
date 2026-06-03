export function DeveloperVisual() {
  return (
    <div className="relative mx-auto aspect-[4/3] w-full max-w-md">
      <div className="absolute -inset-6 rounded-[40px] bg-[radial-gradient(circle_at_top,rgba(0,207,255,0.22),transparent_55%)] blur-2xl" />
      <div className="card relative overflow-hidden">
        <div className="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(0,207,255,0.18),transparent_45%)]" />
        <svg viewBox="0 0 800 600" className="relative h-full w-full" role="img" aria-label="Developer illustration">
          <defs>
            <linearGradient id="g" x1="0" x2="1">
              <stop offset="0" stopColor="rgba(0,207,255,0.95)" />
              <stop offset="1" stopColor="rgba(0,207,255,0.25)" />
            </linearGradient>
          </defs>
          <rect x="80" y="120" width="640" height="360" rx="28" fill="rgba(17,24,39,0.12)" stroke="rgba(255,255,255,0.08)" />
          <rect x="110" y="150" width="580" height="40" rx="14" fill="rgba(245,247,250,0.18)" />
          <circle cx="140" cy="170" r="7" fill="rgba(255,255,255,0.25)" />
          <circle cx="165" cy="170" r="7" fill="rgba(255,255,255,0.18)" />
          <circle cx="190" cy="170" r="7" fill="rgba(255,255,255,0.12)" />
          <rect x="130" y="220" width="310" height="16" rx="8" fill="rgba(156,163,175,0.35)" />
          <rect x="130" y="250" width="420" height="16" rx="8" fill="rgba(156,163,175,0.25)" />
          <rect x="130" y="280" width="260" height="16" rx="8" fill="rgba(156,163,175,0.22)" />
          <rect x="130" y="330" width="520" height="120" rx="18" fill="rgba(0,207,255,0.08)" stroke="rgba(0,207,255,0.22)" />
          <path
            d="M190 410c34-32 68-48 102-48s70 16 108 48"
            stroke="url(#g)"
            strokeWidth="10"
            strokeLinecap="round"
            fill="none"
          />
          <rect x="520" y="230" width="140" height="18" rx="9" fill="rgba(0,207,255,0.35)" />
          <rect x="520" y="260" width="110" height="18" rx="9" fill="rgba(0,207,255,0.22)" />
          <rect x="520" y="290" width="160" height="18" rx="9" fill="rgba(0,207,255,0.18)" />
        </svg>
      </div>
    </div>
  );
}

