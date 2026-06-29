import { useState } from "react";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

export function Materials() {
  const { materials } = useSiteContent();
  const section = useSection("materials");
  const [active, setActive] = useState(0);

  if (!materials.length) return null;

  return (
    <section id="materials" className="relative bg-bone py-28 md:py-40">
      <div className="mx-auto max-w-[1400px] px-6 md:px-10">
        <div className="flex flex-wrap items-end justify-between gap-6">
          <Reveal>
            <div className="flex items-center gap-3 text-foreground/60">
              <span className="h-px w-12 bg-foreground/40" />
              <span className="eyebrow">{section.eyebrow}</span>
            </div>
            <h2 className={`mt-6 max-w-2xl ${sectionHeadingLight}`}>{section.heading}</h2>
          </Reveal>
          {section.subheading && (
            <Reveal delay={200}>
              <p className={`max-w-sm ${bodyCopyLight}`}>{section.subheading}</p>
            </Reveal>
          )}
        </div>

        <div className="mt-16 grid grid-cols-1 gap-px overflow-hidden rounded-sm bg-foreground/15 md:grid-cols-2">
          {materials.map((m, i) => (
            <div
              key={m.name}
              onMouseEnter={() => setActive(i)}
              data-cursor="select"
              className={`group relative flex cursor-pointer flex-col overflow-hidden bg-cream p-8 transition-colors duration-700 md:p-12 ${
                active === i ? "bg-foreground text-cream" : ""
              }`}
            >
              <div className="img-zoom relative mb-8 aspect-[4/3] w-full overflow-hidden rounded-sm">
                <img src={m.image} alt={`${m.name} surface`} loading="lazy" className="h-full w-full object-cover" />
              </div>
              <div className="flex flex-1 flex-col">
                <div className="flex items-start justify-between">
                  <span className="font-mono text-xs opacity-60">0{i + 1}</span>
                  <span
                    className={`h-2 w-2 rounded-full transition-all duration-500 ${
                      active === i ? "bg-accent scale-150" : "bg-foreground/30"
                    }`}
                  />
                </div>
                <h3 className="mt-6 font-display text-5xl md:text-6xl">{m.name}</h3>
                <p
                  className={`mt-6 max-w-md transition-opacity ${
                    active === i ? "text-cream/90" : "text-foreground/70"
                  }`}
                >
                  {m.desc}
                </p>
                <div className="mt-10 flex items-center justify-between border-t border-current/20 pt-6 opacity-70">
                  <span className="eyebrow">Explore</span>
                  <span className="text-xl transition-transform duration-500 group-hover:translate-x-2">→</span>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
