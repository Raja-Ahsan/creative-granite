import { useEffect, useRef, useState } from "react";

export function CustomCursor() {
  const dot = useRef<HTMLDivElement>(null);
  const ring = useRef<HTMLDivElement>(null);
  const [hover, setHover] = useState(false);
  const [label, setLabel] = useState<string | null>(null);
  const pos = useRef({ x: 0, y: 0, tx: 0, ty: 0 });
  const raf = useRef(0);
  const running = useRef(false);
  const idleTimer = useRef(0);

  useEffect(() => {
    if (typeof window === "undefined") return;
    if (window.matchMedia("(pointer: coarse)").matches) return;
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

    const loop = () => {
      pos.current.x += (pos.current.tx - pos.current.x) * 0.12;
      pos.current.y += (pos.current.ty - pos.current.y) * 0.12;
      if (ring.current) {
        ring.current.style.transform = `translate3d(${pos.current.x}px, ${pos.current.y}px, 0) translate(-50%, -50%)`;
      }
      raf.current = requestAnimationFrame(loop);
    };

    const startLoop = () => {
      if (running.current) return;
      running.current = true;
      raf.current = requestAnimationFrame(loop);
    };

    const stopLoop = () => {
      running.current = false;
      cancelAnimationFrame(raf.current);
    };

    const onMove = (e: MouseEvent) => {
      pos.current.tx = e.clientX;
      pos.current.ty = e.clientY;
      if (dot.current) {
        dot.current.style.transform = `translate3d(${e.clientX}px, ${e.clientY}px, 0)`;
      }
      startLoop();
      window.clearTimeout(idleTimer.current);
      idleTimer.current = window.setTimeout(stopLoop, 120);
    };

    const onOver = (e: MouseEvent) => {
      const t = e.target as HTMLElement;
      const interactive = t.closest("a,button,[data-cursor]");
      if (interactive) {
        setHover(true);
        setLabel(interactive.getAttribute("data-cursor"));
      } else {
        setHover(false);
        setLabel(null);
      }
    };

    window.addEventListener("mousemove", onMove, { passive: true });
    window.addEventListener("mouseover", onOver);
    return () => {
      stopLoop();
      window.clearTimeout(idleTimer.current);
      window.removeEventListener("mousemove", onMove);
      window.removeEventListener("mouseover", onOver);
    };
  }, []);

  return (
    <>
      <div
        ref={dot}
        className="pointer-events-none fixed left-0 top-0 z-[100] hidden h-2 w-2 -translate-x-1/2 -translate-y-1/2 rounded-full bg-white mix-blend-difference md:block"
        style={{ transition: "width 0.2s, height 0.2s" }}
      />
      <div
        ref={ring}
        className={`pointer-events-none fixed left-0 top-0 z-[99] hidden items-center justify-center rounded-full border-2 border-white mix-blend-difference md:flex transition-[width,height,background] duration-300 ${
          hover ? "h-20 w-20 bg-white/10" : "h-10 w-10"
        }`}
      >
        {label && (
          <span className="text-[10px] tracking-[0.25em] text-white">{label}</span>
        )}
      </div>
    </>
  );
}
