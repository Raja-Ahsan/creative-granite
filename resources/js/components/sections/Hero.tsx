import { useEffect, useRef, useState } from "react";
import { useSiteContent } from "@/contexts/SiteContentContext";

function HeroSlider({ y, slides }: { y: number; slides: { src: string; alt: string }[] }) {
  const [active, setActive] = useState(0);

  useEffect(() => {
    if (!slides.length) return;
    const interval = window.setInterval(() => setActive((i) => (i + 1) % slides.length), 5500);
    return () => window.clearInterval(interval);
  }, [slides.length]);

  if (!slides.length) return null;

  return (
    <>
      <div
        className="pointer-events-none absolute inset-0"
        style={{ transform: `translateY(${y * 0.15}px) scale(1.05)` }}
      >
        {slides.map((slide, i) => (
          <img
            key={`${slide.src}-${i}`}
            src={slide.src}
            alt={slide.alt}
            className={`absolute inset-0 h-full w-full transition-opacity duration-[1600ms] ease-in-out ${
              i === active ? "opacity-80" : "opacity-0"
            }`}
          />
        ))}
      </div>

      <div className="pointer-events-none absolute bottom-8 left-1/2 z-20 flex -translate-x-1/2 gap-2.5 md:bottom-10">
        {slides.map((_, i) => (
          <span
            key={i}
            className={`h-1 rounded-full transition-all duration-500 ${
              i === active ? "w-8 bg-cream" : "w-1 bg-cream/40"
            }`}
          />
        ))}
      </div>
    </>
  );
}

export function Hero() {
  const { heroSlides } = useSiteContent();
  const ref = useRef<HTMLDivElement>(null);
  const [y, setY] = useState(0);

  useEffect(() => {
    const onScroll = () => {
      if (!ref.current) return;
      const rect = ref.current.getBoundingClientRect();
      setY(-rect.top * 0.25);
    };
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  return (
    <section
      ref={ref}
      id="top"
      className="relative min-h-[calc(100svh-4.25rem)] overflow-hidden bg-ink text-cream md:min-h-[calc(100svh-6.5rem)]"
    >
      <HeroSlider y={y} slides={heroSlides} />
    </section>
  );
}
