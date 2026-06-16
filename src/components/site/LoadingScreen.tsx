import { useEffect, useState } from "react";

export function LoadingScreen({ onDone }: { onDone?: () => void }) {
  const [hide, setHide] = useState(false);
  const [fade, setFade] = useState(false);
  const [mounted, setMounted] = useState(false);

  useEffect(() => setMounted(true), []);

  useEffect(() => {
    if (!mounted) return;
    const t1 = window.setTimeout(() => setFade(true), 4300);
    const t2 = window.setTimeout(() => {
      setHide(true);
      onDone?.();
    }, 5000);
    return () => {
      window.clearTimeout(t1);
      window.clearTimeout(t2);
    };
  }, [onDone, mounted]);

  if (hide || !mounted) return null;

  return (
    <div
      className={`fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-ink text-white transition-opacity duration-700 ${
        fade ? "opacity-0" : "opacity-100"
      }`}
      aria-hidden="true"
    >
      <div
        className="flex items-end justify-center ls-logo leading-none"
        style={{
          fontFamily: "Luxerie, serif",
          fontSize: "clamp(5rem, 16vw, 13rem)",
          color: "#ffffff",
        }}
      >
        <span className="ls-letter ls-c inline-block">C</span>
        <span className="ls-letter ls-g inline-block">G</span>
        <span
          className="ls-letter ls-plus inline-block text-center"
          style={{ fontSize: "0.7em", margin: "0 0.05em 0.15em", transform: "translateY(-0.55em)" }}
        >
          +
        </span>
        <span className="ls-letter ls-d inline-block">D</span>
      </div>
      <div
        className="ls-tagline mt-8"
        style={{
          fontFamily: '"Biondi Sans", sans-serif',
          fontWeight: 400,
          color: "#ffffff",
          letterSpacing: "0.25em",
          fontSize: "clamp(0.9rem, 1.8vw, 1.6rem)",
        }}
      >
        CREATIVE GRANITE <span style={{ fontFamily: "sans-serif" }}>+</span> DESIGN
      </div>

      <style>{`
        @keyframes ls-slide-left {
          0% { opacity: 0; transform: translateX(-120%); }
          100% { opacity: 1; transform: translateX(0); }
        }
        @keyframes ls-slide-right {
          0% { opacity: 0; transform: translateX(120%); }
          100% { opacity: 1; transform: translateX(0); }
        }
        @keyframes ls-flip-up {
          0% { opacity: 0; transform: translateY(120%) rotate(180deg); }
          55% { opacity: 1; transform: translateY(0) rotate(180deg); }
          100% { opacity: 1; transform: translateY(0) rotate(0deg); }
        }
        @keyframes ls-pop {
          0% { opacity: 0; transform: scale(0.2); }
          70% { opacity: 1; transform: scale(1.15); }
          100% { opacity: 1; transform: scale(1); }
        }
        @keyframes ls-fade-up {
          0% { opacity: 0; transform: translateY(12px); }
          100% { opacity: 1; transform: translateY(0); }
        }
        /* images are already pure white on transparent bg, no filter needed */
        .ls-letter { opacity: 0; will-change: transform, opacity; }
        .ls-c { animation: ls-slide-left 0.9s cubic-bezier(0.2,0.8,0.2,1) 0.1s forwards; }
        .ls-g { animation: ls-flip-up 1.3s cubic-bezier(0.2,0.8,0.2,1) 0.9s forwards; transform-origin: center; }
        .ls-plus { animation: ls-pop 0.6s cubic-bezier(0.2,0.8,0.2,1) 2.05s forwards; }
        .ls-d { animation: ls-slide-right 0.9s cubic-bezier(0.2,0.8,0.2,1) 2.4s forwards; }
        .ls-tagline { opacity: 0; animation: ls-fade-up 0.9s ease-out 3s forwards; }
      `}</style>
    </div>
  );
}