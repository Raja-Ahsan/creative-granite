import { useMemo, useState } from "react";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { materialDetailHref } from "@/router/SiteRouter";
import { cn } from "@/utils/cn";
import { bodyCopyLight } from "@/utils/typography";

export function Materials({
  className,
  columns = 2,
}: {
  className?: string;
  columns?: 2 | 4;
}) {
  const { materials } = useSiteContent();
  const section = useSection("materials");
  const [active, setActive] = useState(0);
  const compact = columns === 4;

  const orderedMaterials = useMemo(
    () =>
      [...materials].sort((a, b) => {
        const orderA = a.sortOrder ?? Number.MAX_SAFE_INTEGER;
        const orderB = b.sortOrder ?? Number.MAX_SAFE_INTEGER;
        if (orderA !== orderB) return orderA - orderB;
        return a.name.localeCompare(b.name);
      }),
    [materials],
  );

  if (!orderedMaterials.length) return null;

  return (
    <section id="materials" className={cn("relative bg-bone py-28 md:py-40", className)}>
      <div className="mx-auto max-w-[1400px] px-6 md:px-10">
        <Reveal>
          <div className="flex items-center gap-3 text-foreground/60">
            <span className="h-px w-12 bg-foreground/40" />
            <span className="eyebrow">{section.eyebrow}</span>
          </div>
          {section.subheading && (
            <p className={`mt-8 max-w-2xl ${bodyCopyLight}`}>{section.subheading}</p>
          )}
        </Reveal>

        <div
          className={cn(
            "mt-16 grid grid-cols-1 gap-px overflow-hidden rounded-sm bg-foreground/15",
            compact ? "sm:grid-cols-2 xl:grid-cols-4" : "md:grid-cols-2",
          )}
        >
          {orderedMaterials.map((material, i) => {
            const indexLabel = String(material.sortOrder || i + 1).padStart(2, "0");

            return (
              <a
                key={`${material.slug}-${material.sortOrder ?? i}`}
                href={materialDetailHref(material.slug)}
                onMouseEnter={() => setActive(i)}
                data-cursor="view"
                className={cn(
                  "group relative flex cursor-pointer flex-col overflow-hidden bg-cream transition-colors duration-700",
                  compact ? "p-6 md:p-7" : "p-8 md:p-12",
                  active === i && "bg-foreground text-cream",
                )}
              >
                <div className={cn("img-zoom relative w-full overflow-hidden rounded-sm", compact ? "mb-5 aspect-[4/3]" : "mb-8 aspect-[4/3]")}>
                  <img
                    src={material.image}
                    alt={`${material.name} surface`}
                    loading="lazy"
                    decoding="async"
                    className="h-full w-full object-cover"
                  />
                </div>
                <div className="flex flex-1 flex-col">
                  <div className="flex items-start justify-between">
                    <span className="font-mono text-xs opacity-60">{indexLabel}</span>
                    <span
                      className={`h-2 w-2 rounded-full transition-all duration-500 ${
                        active === i ? "scale-150 bg-accent" : "bg-foreground/30"
                      }`}
                    />
                  </div>
                  <h3
                    className={cn(
                      "mt-4 font-display",
                      compact ? "text-3xl md:text-4xl" : "mt-6 text-5xl md:text-6xl",
                    )}
                  >
                    {material.name}
                  </h3>
                  <p
                    className={cn(
                      "mt-4 transition-opacity",
                      compact ? "text-sm leading-relaxed" : "mt-6 max-w-md",
                      active === i ? "text-cream/90" : "text-foreground/70",
                    )}
                  >
                    {material.desc}
                  </p>
                  <div
                    className={cn(
                      "mt-auto flex items-center justify-between border-t border-current/20 opacity-70",
                      compact ? "pt-5 mt-8" : "mt-10 pt-6",
                    )}
                  >
                    <span className="eyebrow">Explore</span>
                    <span className="text-xl transition-transform duration-500 group-hover:translate-x-2">→</span>
                  </div>
                </div>
              </a>
            );
          })}
        </div>
      </div>
    </section>
  );
}
