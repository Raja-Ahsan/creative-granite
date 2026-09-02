import { useCallback, useEffect, useState } from "react";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";

export function Testimonial() {
  const { testimonials } = useSiteContent();
  const section = useSection("testimonial");
  const [i, setI] = useState(0);
  const [animKey, setAnimKey] = useState(0);

  const total = testimonials.length;

  const goTo = useCallback(
    (next: number) => {
      if (!total) return;
      setI(((next % total) + total) % total);
      setAnimKey((k) => k + 1);
    },
    [total],
  );

  useEffect(() => {
    if (!total) return;
    const t = setInterval(() => goTo(i + 1), 7500);
    return () => clearInterval(t);
  }, [total, i, goTo]);

  if (!total) return null;

  const cur = testimonials[i];

  return (
    <section className="testimonial-section relative overflow-hidden py-20 md:py-28">
      <div className="mx-auto max-w-[1400px] px-6 md:px-10">
        <div className="grid min-h-[28rem] overflow-hidden md:min-h-[32rem] md:grid-cols-12">
          {/* Rating panel */}
          <Reveal className="relative flex flex-col justify-between bg-ink px-8 py-10 text-cream md:col-span-5 md:px-10 md:py-14 lg:px-14">
            <div>
              <div className="flex items-center gap-3 text-cream/50">
                <span className="h-px w-8 bg-cream/30" />
                <span className="text-[11px] font-light tracking-[0.18em]">Google reviews</span>
              </div>

              <h2 className="testimonial-heading mt-6 max-w-[14ch] text-[clamp(2rem,4vw,3.25rem)] font-normal uppercase leading-[0.95] tracking-[-0.02em] text-cream">
                {section.heading || "Trusted across Utah"}
              </h2>

              <p className="mt-6 max-w-xs text-sm font-light leading-relaxed tracking-[0.04em] text-cream/60">
                Real feedback from homeowners, builders, and designers across Utah.
              </p>
            </div>

            <div className="mt-12 flex items-end justify-between gap-6 md:mt-16">
              <div className="flex min-w-0 items-end gap-4">
                <span className="font-heading text-[clamp(4.5rem,10vw,6.5rem)] leading-none tracking-[-0.04em] text-cream">
                  5.0
                </span>
                <div className="mb-2">
                  <div className="flex gap-1 text-accent" aria-label="5 star rating">
                    {Array.from({ length: 5 }).map((_, k) => (
                      <span key={k} className="text-base">
                        ★
                      </span>
                    ))}
                  </div>
                  <div className="mt-2 text-[11px] font-light tracking-[0.18em] text-cream/45">
                    Average rating
                  </div>
                  <div className="mt-4 flex items-center gap-2.5" aria-label="Google Reviews">
                    <svg
                      viewBox="0 0 48 48"
                      className="h-6 w-6 shrink-0"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden
                    >
                      <path
                        fill="#FFC107"
                        d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 12.955 4 4 12.955 4 24s8.955 20 20 20 20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"
                      />
                      <path
                        fill="#FF3D00"
                        d="M6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 16.318 4 9.656 8.337 6.306 14.691z"
                      />
                      <path
                        fill="#4CAF50"
                        d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238C29.211 35.091 26.715 36 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z"
                      />
                      <path
                        fill="#1976D2"
                        d="M43.611 20.083H42V20H24v8h11.303c-.792 2.237-2.231 4.166-4.087 5.571l.003-.002 6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"
                      />
                    </svg>
                    <span className="text-[12px] font-light tracking-[0.06em] text-cream/80">
                      Google Reviews
                    </span>
                  </div>
                </div>
              </div>

              <img
                src="/images/utah-valley-best-of-2026.png"
                alt="Utah Valley Magazine Best of Winner 2026"
                className="h-24 w-24 shrink-0 object-contain sm:h-28 sm:w-28 md:h-32 md:w-32 lg:h-36 lg:w-36"
                loading="lazy"
                decoding="async"
              />
            </div>
          </Reveal>

          {/* Quote panel */}
          <Reveal
            delay={120}
            className="relative flex flex-col justify-between border border-ink/10 border-t-0 bg-cream md:col-span-7 md:border-l-0 md:border-t"
          >
            <div className="relative flex flex-1 flex-col justify-center px-8 py-12 md:px-12 md:py-16 lg:px-16">
              <div
                aria-hidden
                className="pointer-events-none absolute right-6 top-4 select-none text-[8rem] leading-none text-ink/[0.05] md:right-10 md:top-6 md:text-[11rem]"
                style={{ fontFamily: "var(--font-heading)" }}
              >
                ”
              </div>

              <div className="relative">
                <div className="mb-6 flex items-center gap-2 text-accent md:mb-8">
                  {Array.from({ length: 5 }).map((_, k) => (
                    <span key={k} className="text-sm">
                      ★
                    </span>
                  ))}
                </div>

                <blockquote
                  key={animKey}
                  className="testimonial-quote testimonial-quote--panel max-w-[38rem] animate-in fade-in slide-in-from-bottom-2 duration-700"
                >
                  {cur.q}
                </blockquote>

                <div className="mt-8 flex flex-wrap items-end justify-between gap-4 border-t border-ink/10 pt-6 md:mt-10">
                  <cite className="testimonial-author not-italic">
                    <span className="testimonial-author__name block text-base font-light text-ink md:text-lg">
                      {cur.a.replace(/\.$/, "")}
                    </span>
                    {cur.r ? (
                      <span className="mt-1 block text-[11px] font-light tracking-[0.14em] text-ink/45">
                        {cur.r}
                      </span>
                    ) : null}
                  </cite>

                  <div className="flex items-center gap-3">
                    <button
                      type="button"
                      onClick={() => goTo(i - 1)}
                      aria-label="Previous review"
                      data-cursor="view"
                      className="flex h-11 w-11 items-center justify-center border border-ink/15 text-ink/55 transition-all duration-300 hover:border-ink hover:bg-ink hover:text-cream"
                    >
                      ←
                    </button>
                    <button
                      type="button"
                      onClick={() => goTo(i + 1)}
                      aria-label="Next review"
                      data-cursor="view"
                      className="flex h-11 w-11 items-center justify-center border border-ink/15 text-ink/55 transition-all duration-300 hover:border-ink hover:bg-ink hover:text-cream"
                    >
                      →
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div className="flex items-center justify-between border-t border-ink/10 px-8 py-4 md:px-12 lg:px-16">
              <span className="text-[11px] font-light tracking-[0.2em] text-ink/40">
                Review {String(i + 1).padStart(2, "0")} of {String(total).padStart(2, "0")}
              </span>
              <div className="h-px flex-1 mx-6 bg-ink/10" />
              <span className="text-[11px] font-light tracking-[0.16em] text-ink/40">Utah clients</span>
            </div>
          </Reveal>
        </div>
      </div>
    </section>
  );
}
