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
  }, [slides.length, active]);

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
            className={`absolute inset-0 h-full w-full object-cover object-[center_70%] transition-opacity duration-[1600ms] ease-in-out ${
              i === active ? "opacity-100" : "opacity-0"
            }`}
            style={{ transform: "scale(1.05)" }}
          />
        ))}
      </div>

      <div className="absolute bottom-28 left-1/2 z-30 flex -translate-x-1/2 items-center gap-2.5 md:bottom-32">
        {slides.map((_, i) => (
          <button
            key={i}
            type="button"
            onClick={() => setActive(i)}
            aria-label={`Go to slide ${i + 1}`}
            aria-current={i === active ? "true" : undefined}
            data-cursor="view"
            className={`h-2 rounded-full transition-all duration-500 ${
              i === active
                ? "w-9 bg-cream"
                : "w-2 bg-cream/45 hover:bg-cream/75"
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

  const scrollToNext = () => {
    const next = document.getElementById("who-we-are");
    if (!next) return;
    next.scrollIntoView({ behavior: "smooth", block: "start" });
  };

  return (
    <section
      ref={sectionRef}
      id="top"
      className="relative h-[86svh] min-h-[28rem] overflow-hidden bg-ink text-cream sm:h-[88svh] sm:min-h-[32rem] md:h-[90svh] md:min-h-[36rem]"
    >
      <HeroSlider parallaxRef={parallaxRef} slides={heroSlides} />

      <div
        className="pointer-events-none absolute inset-0 z-10 bg-gradient-to-b from-ink/80 via-ink/55 to-ink/75"
        aria-hidden
      />

      <div className="relative z-20 flex h-full items-center justify-center pb-24 md:pb-28">
        <HeroIntro overlay />
      </div>

      <div className="absolute inset-x-0 bottom-5 z-40 flex justify-center md:bottom-7">
        <button
          type="button"
          onClick={scrollToNext}
          data-cursor="view"
          aria-label="Scroll to next section"
          className="group flex flex-col items-center gap-2.5 rounded-full px-3 py-2 text-cream transition-transform duration-300 hover:-translate-y-0.5"
        >
          <span className="text-[11px] font-medium tracking-[0.32em] text-cream drop-shadow-[0_1px_8px_rgba(0,0,0,0.55)]">
            Scroll
          </span>
          <span className="flex h-11 w-11 items-center justify-center rounded-full border border-cream/80 bg-cream/15 text-cream shadow-[0_8px_24px_rgba(0,0,0,0.35)] backdrop-blur-sm transition-colors duration-300 group-hover:border-cream group-hover:bg-cream/25">
            <svg
              viewBox="0 0 24 24"
              className="h-4 w-4 animate-bounce"
              fill="none"
              stroke="currentColor"
              strokeWidth="1.75"
              aria-hidden
            >
              <path d="M6 9l6 6 6-6" strokeLinecap="round" strokeLinejoin="round" />
            </svg>
          </span>
        </button>
      </div>
    </section>
  );
}
