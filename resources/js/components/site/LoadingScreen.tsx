import { useEffect, useState } from "react";
import { GraniteBlade } from "@/components/site/GraniteBlade";

const LOADING_SEEN_KEY = "cg_site_loaded";

export function LoadingScreen({ onDone }: { onDone?: () => void }) {
  const [hide, setHide] = useState(false);
  const [fade, setFade] = useState(false);

  useEffect(() => {
    if (sessionStorage.getItem(LOADING_SEEN_KEY)) {
      setHide(true);
      onDone?.();
      return;
    }

    const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    const fadeAt = reducedMotion ? 200 : 600;
    const hideAt = reducedMotion ? 400 : 900;

    const t1 = window.setTimeout(() => setFade(true), fadeAt);
    const t2 = window.setTimeout(() => {
      sessionStorage.setItem(LOADING_SEEN_KEY, "1");
      setHide(true);
      onDone?.();
    }, hideAt);

    return () => {
      window.clearTimeout(t1);
      window.clearTimeout(t2);
    };
  }, [onDone]);

  if (hide) return null;

  return (
    <div
      className={`fixed inset-0 z-[9999] flex items-center justify-center bg-ink transition-opacity duration-500 ${
        fade ? "opacity-0" : "opacity-100"
      }`}
      aria-hidden="true"
    >
      <div className="ls-blade relative flex items-center justify-center">
        <div className="ls-blade-glow pointer-events-none absolute inset-0 rounded-full bg-white/10 blur-3xl" />
        <GraniteBlade className="ls-blade-spin relative h-[clamp(7rem,28vw,14rem)] w-[clamp(7rem,28vw,14rem)]" />
      </div>

      <style>{`
        @keyframes ls-blade-swirl {
          from { transform: rotate(0deg); }
          to { transform: rotate(360deg); }
        }
        @keyframes ls-blade-in {
          0% { opacity: 0; transform: scale(0.5); }
          100% { opacity: 1; transform: scale(1); }
        }

        .ls-blade { animation: ls-blade-in 0.4s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }
        .ls-blade-spin {
          animation: ls-blade-swirl 1.2s linear infinite;
          transform-origin: center center;
        }
        .ls-blade-glow { animation: ls-blade-in 0.4s ease-out forwards; opacity: 0; }

        @media (prefers-reduced-motion: reduce) {
          .ls-blade, .ls-blade-glow { animation: none !important; opacity: 1 !important; transform: none !important; }
          .ls-blade-spin { animation: none !important; }
        }
      `}</style>
    </div>
  );
}
