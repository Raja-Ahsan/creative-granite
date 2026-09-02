import { useMemo, useState } from "react";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { materialDetailHref } from "@/router/SiteRouter";
import { cn } from "@/utils/cn";
import { bodyCopyLight } from "@/utils/typography";

export function Materials({
  className,
  columns = 2,
  showHelpCta = false,
}: {
  className?: string;
  columns?: 2 | 4;
  showHelpCta?: boolean;
}) {
  const { materials, settings } = useSiteContent();
  const section = useSection("materials");
  const [active, setActive] = useState(0);
  const compact = columns === 4;

  const { primaryMaterials, callout } = useMemo(() => {
    const ordered = [...materials].sort((a, b) => {
      const orderA = a.sortOrder ?? Number.MAX_SAFE_INTEGER;
      const orderB = b.sortOrder ?? Number.MAX_SAFE_INTEGER;
      if (orderA !== orderB) return orderA - orderB;
      return a.name.localeCompare(b.name);
    });

    return {
      primaryMaterials: ordered.filter((item) => !item.isCallout),
      callout: ordered.find((item) => item.isCallout) ?? null,
    };
  }, [materials]);

  if (!primaryMaterials.length && !callout) return null;

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

        {primaryMaterials.length > 0 && (
          <div
            className={cn(
              "mt-16 grid grid-cols-1 gap-px overflow-hidden rounded-sm bg-foreground/15",
              compact ? "sm:grid-cols-2 xl:grid-cols-4" : "md:grid-cols-2",
            )}
          >
            {primaryMaterials.map((material, i) => {
              const indexLabel = String(i + 1).padStart(2, "0");

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
                  <div
                    className={cn(
                      "img-zoom relative w-full overflow-hidden rounded-sm",
                      compact ? "mb-5 aspect-[4/3]" : "mb-8 aspect-[4/3]",
                    )}
                  >
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
                        compact ? "mt-8 pt-5" : "mt-10 pt-6",
                      )}
                    >
                      <span className="eyebrow">Explore</span>
                      <span className="text-xl transition-transform duration-500 group-hover:translate-x-2">
                        →
                      </span>
                    </div>
                  </div>
                </a>
              );
            })}
          </div>
        )}

        {showHelpCta ? (
          <Reveal delay={120} className="mt-14 md:mt-20">
            <div className="relative left-1/2 w-screen -translate-x-1/2 overflow-hidden bg-ink text-cream">
              <div className="pointer-events-none absolute inset-0 noise-overlay opacity-30" />
              <div className="relative mx-auto max-w-[1400px] px-6 py-16 md:px-10 md:py-24">
                {callout && (
                  <div className="border-b border-cream/15 pb-10 md:pb-12">
                    <div className="flex items-center gap-3 text-cream/55">
                      <span className="h-px w-12 bg-cream/40" />
                      <span className="eyebrow text-cream/55">{callout.name}</span>
                    </div>
                    <h3 className="mt-5 font-display text-3xl uppercase tracking-[-0.02em] text-cream md:text-5xl">
                      {callout.tagline || "Beyond the Core Collection"}
                    </h3>
                    <p className="mt-6 text-sm font-light leading-relaxed text-cream/70 md:text-base">
                      {callout.intro || callout.desc}
                    </p>
                  </div>
                )}

                <div className={callout ? "pt-10 md:pt-12" : ""}>
                  <p className="eyebrow text-cream/50">Need help choosing?</p>
                  <h2 className="mt-5 font-display text-3xl uppercase tracking-[-0.02em] text-cream md:text-5xl">
                    Not sure which material is right for your project?
                  </h2>
                  <p className="mt-7 text-sm font-light leading-relaxed text-cream/70 md:text-base">
                    The right surface depends on more than appearance. How the space will be used, maintenance
                    expectations, application, design direction, and the characteristics of the individual material
                    all matter. Our team can help you explore your options, understand the differences, and select a
                    surface that works beautifully for your project.
                  </p>

                  <div className="mt-10 flex flex-wrap items-center justify-center gap-3 md:gap-4">
                    <a
                      href="/contact"
                      className="btn-magnetic btn-magnetic-inverse inline-flex items-center gap-3 rounded-full border border-cream bg-cream px-7 py-3.5 text-xs font-medium tracking-[0.2em] text-ink"
                    >
                      Contact Us
                      <span className="relative z-[2]" aria-hidden="true">
                        →
                      </span>
                    </a>

                    <a
                      href="#estimate"
                      data-cursor="estimate"
                      className="inline-flex items-center gap-3 rounded-full border border-cream/30 px-7 py-3.5 text-xs font-medium tracking-[0.2em] text-cream transition hover:border-cream/60"
                    >
                      Start Your Project
                      <span aria-hidden="true">→</span>
                    </a>

                    <a
                      href={settings.showroomMapsUrl || "/contact"}
                      {...(settings.showroomMapsUrl
                        ? { target: "_blank", rel: "noopener noreferrer" }
                        : {})}
                      className="inline-flex items-center gap-3 rounded-full border border-cream/30 px-7 py-3.5 text-xs font-medium tracking-[0.2em] text-cream transition hover:border-cream/60"
                    >
                      Visit the Showroom
                      <span aria-hidden="true">→</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </Reveal>
        ) : (
          callout && (
            <Reveal delay={120} className="mt-10 md:mt-14">
              <div className="rounded-sm border border-foreground/10 bg-cream px-8 py-10 md:px-12 md:py-12">
                <div className="flex flex-col gap-8 md:flex-row md:items-end md:justify-between">
                  <div className="max-w-3xl">
                    <div className="flex items-center gap-3 text-foreground/60">
                      <span className="h-px w-12 bg-foreground/40" />
                      <span className="eyebrow">{callout.name}</span>
                    </div>
                    <h3 className="mt-5 font-display text-3xl uppercase tracking-[-0.02em] text-[#021E44] md:text-4xl">
                      {callout.tagline || "Beyond the Core Collection"}
                    </h3>
                    <p className={`mt-5 ${bodyCopyLight}`}>
                      {callout.intro || callout.desc}
                    </p>
                  </div>
                  <a
                    href="/contact"
                    className="inline-flex shrink-0 items-center gap-3 rounded-full border border-foreground/20 px-8 py-4 text-xs font-medium tracking-[0.22em] text-foreground transition hover:border-foreground/40"
                  >
                    Contact Us
                    <span aria-hidden="true">→</span>
                  </a>
                </div>
              </div>
            </Reveal>
          )
        )}
      </div>
    </section>
  );
}
