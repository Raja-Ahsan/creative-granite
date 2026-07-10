import { useEffect, useRef, useState, type RefObject } from "react";
import { useSiteContent } from "@/contexts/SiteContentContext";
import { HeroIntro } from "./HeroIntro";

function HeroSlider({
  parallaxRef,
  slides,
}: {
  parallaxRef: RefObject<HTMLDivElement | null>;
  slides: { src: string; alt: string }[];
}) {
  const [active, setActive] = useState(0);

  useEffect(() => {
    if (!slides.length) return;
    const interval = window.setInterval(() => setActive((i) => (i + 1) % slides.length), 5500);
    return () => window.clearInterval(interval);
  }, [slides.length]);

  if (!slides.length) return null;

  return (
    <>
      <div ref={parallaxRef} className="pointer-events-none absolute inset-0 will-change-transform">
        {slides.map((slide, i) => (
          <img
            key={`${slide.src}-${i}`}
            src={slide.src}
            alt={slide.alt}
            fetchPriority={i === 0 ? "high" : "low"}
            loading={i === 0 ? "eager" : "lazy"}
            decoding="async"
            className={`absolute inset-0 h-full w-full object-cover object-[center_28%] transition-opacity duration-[1600ms] ease-in-out ${
              i === active ? "opacity-100" : "opacity-0"
            }`}
            style={{ transform: "scale(1.05)" }}
          />
        ))}
      </div>

      <div className="pointer-events-none absolute bottom-6 left-1/2 z-30 flex -translate-x-1/2 gap-2.5 md:bottom-8">
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
  const sectionRef = useRef<HTMLDivElement>(null);
  const parallaxRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const section = sectionRef.current;
    const layer = parallaxRef.current;
    if (!section || !layer) return;

    let raf = 0;
    const onScroll = () => {
      cancelAnimationFrame(raf);
      raf = requestAnimationFrame(() => {
        const top = section.getBoundingClientRect().top;
        const y = -top * 0.25;
        layer.style.transform = `translate3d(0, ${y * 0.15}px, 0) scale(1.05)`;
      });
    };

    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => {
      cancelAnimationFrame(raf);
      window.removeEventListener("scroll", onScroll);
    };
  }, []);

  return (
    <section
      ref={sectionRef}
      id="top"
      className="relative h-[58svh] min-h-[22rem] max-h-[36rem] overflow-hidden bg-ink text-cream sm:h-[62svh] sm:min-h-[26rem] sm:max-h-[42rem] md:h-[68svh] md:min-h-[30rem] md:max-h-[48rem]"
    >
      <HeroSlider parallaxRef={parallaxRef} slides={heroSlides} />

      <div
        className="pointer-events-none absolute inset-0 z-10 bg-gradient-to-b from-ink/80 via-ink/55 to-ink/75"
        aria-hidden
      />

      <div className="relative z-20 flex h-full items-center justify-center">
        <HeroIntro overlay />
      </div>
    </section>
  );
}
