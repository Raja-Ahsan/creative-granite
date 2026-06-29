import { useEffect, useState } from "react";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";

export function Testimonial() {
  const { testimonials } = useSiteContent();
  const section = useSection("testimonial");
  const [i, setI] = useState(0);

  useEffect(() => {
    if (!testimonials.length) return;
    const t = setInterval(() => setI((v) => (v + 1) % testimonials.length), 6500);
    return () => clearInterval(t);
  }, [testimonials.length]);

  if (!testimonials.length) return null;

  const cur = testimonials[i];

  return (
    <section className="relative py-28">
      <div className="mx-auto max-w-[1100px] px-6 text-center md:px-10">
        <Reveal>
          <div className="eyebrow text-foreground/60">{section.eyebrow}</div>
          <div className="mt-4 flex justify-center gap-1 text-accent">
            {Array.from({ length: 5 }).map((_, k) => (
              <span key={k}>★</span>
            ))}
          </div>
          <blockquote
            key={i}
            className="mx-auto mt-4 max-w-3xl font-display text-[16px] leading-tight text-foreground md:text-[20px] animate-in fade-in slide-in-from-bottom-4 duration-700"
          >
            "{cur.q}"
          </blockquote>
          <div className="eyebrow mt-5 text-foreground/60">
            — {cur.a} · {cur.r}
          </div>
          <div className="mt-10 flex justify-center gap-2">
            {testimonials.map((_, k) => (
              <button
                key={k}
                onClick={() => setI(k)}
                aria-label={`Testimonial ${k + 1}`}
                className={`h-1.5 rounded-full transition-all duration-500 ${
                  k === i ? "w-10 bg-foreground" : "w-1.5 bg-foreground/30"
                }`}
              />
            ))}
          </div>
        </Reveal>
      </div>
    </section>
  );
}
