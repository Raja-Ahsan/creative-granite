type GraniteBladeProps = {
  className?: string;
};

export function GraniteBlade({ className = "" }: GraniteBladeProps) {
  const id = "granite-blade";
  return (
    <svg
      viewBox="0 0 200 200"
      className={className}
      aria-hidden="true"
    >
      <defs>
        <radialGradient id={`${id}-face`} cx="38%" cy="32%" r="68%">
          <stop offset="0%" stopColor="#f4f4f4" />
          <stop offset="45%" stopColor="#b8b8b8" />
          <stop offset="100%" stopColor="#6a6a6a" />
        </radialGradient>
        <linearGradient id={`${id}-tooth`} x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stopColor="#e8e8e8" />
          <stop offset="100%" stopColor="#8a8a8a" />
        </linearGradient>
        <filter id={`${id}-shadow`} x="-20%" y="-20%" width="140%" height="140%">
          <feDropShadow dx="0" dy="2" stdDeviation="3" floodColor="#000" floodOpacity="0.35" />
        </filter>
      </defs>

      <g filter={`url(#${id}-shadow)`}>
        {/* Segmented diamond blade teeth */}
        {Array.from({ length: 48 }).map((_, i) => {
          const angle = (i * 360) / 48;
          const rad = (angle * Math.PI) / 180;
          const inner = 78;
          const outer = 96;
          const width = 4.2;
          const x1 = 100 + inner * Math.cos(rad);
          const y1 = 100 + inner * Math.sin(rad);
          const x2 = 100 + outer * Math.cos(rad);
          const y2 = 100 + outer * Math.sin(rad);
          const perp = rad + Math.PI / 2;
          const dx = (width / 2) * Math.cos(perp);
          const dy = (width / 2) * Math.sin(perp);
          return (
            <polygon
              key={i}
              points={`${x1 - dx},${y1 - dy} ${x1 + dx},${y1 + dy} ${x2 + dx},${y2 + dy} ${x2 - dx},${y2 - dy}`}
              fill={`url(#${id}-tooth)`}
              stroke="#5a5a5a"
              strokeWidth="0.3"
            />
          );
        })}

        {/* Main disc */}
        <circle cx="100" cy="100" r="78" fill={`url(#${id}-face)`} stroke="#707070" strokeWidth="1.5" />

        {/* Spoke cuts */}
        {Array.from({ length: 8 }).map((_, i) => {
          const angle = ((i * 360) / 8 + 22.5) * (Math.PI / 180);
          const x1 = 100 + 18 * Math.cos(angle);
          const y1 = 100 + 18 * Math.sin(angle);
          const x2 = 100 + 62 * Math.cos(angle);
          const y2 = 100 + 62 * Math.sin(angle);
          return (
            <line
              key={i}
              x1={x1}
              y1={y1}
              x2={x2}
              y2={y2}
              stroke="#8a8a8a"
              strokeWidth="2.5"
              strokeLinecap="round"
              opacity="0.55"
            />
          );
        })}

        {/* Center arbor */}
        <circle cx="100" cy="100" r="18" fill="#3a3a3a" stroke="#1a1a1a" strokeWidth="2" />
        <circle cx="100" cy="100" r="8" fill="#111" />
      </g>
    </svg>
  );
}
