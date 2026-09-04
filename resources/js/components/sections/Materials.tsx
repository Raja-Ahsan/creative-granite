import { useMemo, useState } from "react";
import { Reveal } from "@/components/site/Reveal";
import { RichHtml } from "@/components/site/RichHtml";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { materialDetailHref } from "@/router/SiteRouter";
import { cn } from "@/utils/cn";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

export function Materials({
  className,
  previewOnly = false,
  showHelpCta = false,
}: {
  className?: string;
  previewOnly?: boolean;
  showHelpCta?: boolean;
}) {
  const { materials, settings } = useSiteContent();
  const homeSection = useSection("materials");
  const productsSection = useSection("materials-products");
  const calloutSection = useSection("materials-callout");
  const [active, setActive] = useState(0);

  const section = previewOnly
    ? {
        eyebrow: productsSection.eyebrow || "Materials",
        heading: productsSection.heading || "Explore Our Materials",
        subheading:
          productsSection.subheading ||
          homeSection.subheading ||
          "Explore our most requested natural and engineered surfaces.",
      }
    : homeSection;

  const { primaryMaterials, materialCallout } = useMemo(() => {
    const ordered = [...materials].sort((a, b) => {
      const orderA = a.sortOrder ?? Number.MAX_SAFE_INTEGER;
      const orderB = b.sortOrder ?? Number.MAX_SAFE_INTEGER;
      if (orderA !== orderB) return orderA - orderB;
      return a.name.localeCompare(b.name);
    });

    return {
      primaryMaterials: ordered.filter((item) => !item.isCallout),
      materialCallout: ordered.find((item) => item.isCallout) ?? null,
    };
  }, [materials]);

  const calloutContent = useMemo(() => {
    const eyebrow =
      calloutSection.eyebrow || materialCallout?.name || "Additional Materials";
    const heading =
      calloutSection.heading ||
      materialCallout?.tagline ||
      "Beyond the Core Collection";
    const body =
      calloutSection.body ||
      materialCallout?.intro ||
      materialCallout?.desc ||
      "";
    const buttonLabel = calloutSection.buttonLabel || "Contact Us";
    const buttonUrl = calloutSection.buttonUrl || "/contact";

    if (!heading && !body) return null;

    return { eyebrow, heading, body, buttonLabel, buttonUrl };
  }, [calloutSection, materialCallout]);

  if (!primaryMaterials.length && !calloutContent && !showHelpCta) return null;

  return (
    <section
      id="materials"
      className={cn(
        "relative bg-bone pt-28 md:pt-40",
        showHelpCta ? "pb-0" : "pb-28 md:pb-40",
        className,
      )}
    >
      <div className="mx-auto max-w-[1400px] px-6 md:px-10">
        <Reveal>
          <div className="flex items-center gap-3 text-foreground/60">
            <span className="h-px w-12 bg-foreground/40" />
            <span className="eyebrow">{section.eyebrow}</span>
          </div>
          {section.heading &&
            (previewOnly ? (
              <h1 className={`mt-6 max-w-4xl ${sectionHeadingLight}`}>{section.heading}</h1>
            ) : (
              <h2 className={`mt-6 max-w-4xl ${sectionHeadingLight}`}>{section.heading}</h2>
            ))}
          {section.subheading && (
            <RichHtml html={section.subheading} className={`mt-8 max-w-2xl ${bodyCopyLight}`} />
          )}
        </Reveal>

        {primaryMaterials.length > 0 && (
          <div className="mt-16 grid grid-cols-1 gap-px overflow-hidden rounded-sm bg-foreground/15 md:grid-cols-2">
            {primaryMaterials.map((material, i) => {
              const indexLabel = String(i + 1).padStart(2, "0");

              return (
                <a
                  key={`${material.slug}-${material.sortOrder ?? i}`}
                  href={materialDetailHref(material.slug)}
                  onMouseEnter={() => setActive(i)}
                  data-cursor="view"
                  className={cn(
                    "group relative flex cursor-pointer flex-col overflow-hidden bg-cream p-8 transition-colors duration-700 md:p-12",
                    active === i && "bg-foreground text-cream",
                  )}
                >
                  <div className="img-zoom relative mb-8 aspect-[4/3] w-full overflow-hidden rounded-sm">
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
                    <h3 className="mt-6 font-display text-5xl md:text-6xl">{material.name}</h3>
                    {material.desc && (
                      <p
                        className={cn(
                          "mt-6 max-w-md transition-opacity",
                          active === i ? "text-cream/90" : "text-foreground/70",
                        )}
                      >
                        {material.desc}
                      </p>
                    )}
                    <div className="mt-10 flex items-center justify-between border-t border-current/20 pt-6 opacity-70">
                      <span className="eyebrow">Explore</span>
                      <span className="text-xl transition-transform duration-500 group-hover:translate-x-2">→</span>
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
                {calloutContent && (
                  <div className="border-b border-cream/15 pb-10 md:pb-12">
                    <div className="flex items-center gap-3 text-cream/55">
                      <span className="h-px w-12 bg-cream/40" />
                      <span className="eyebrow text-cream/55">{calloutContent.eyebrow}</span>
                    </div>
                    <h3 className="mt-5 font-display text-3xl uppercase tracking-[-0.02em] text-cream md:text-5xl">
                      {calloutContent.heading}
                    </h3>
                    {calloutContent.body && (
                      <RichHtml
                        html={calloutContent.body}
                        className="mt-6 text-sm font-light leading-relaxed text-cream/70 md:text-base"
                      />
                    )}
                  </div>
                )}

                <div className={calloutContent ? "pt-10 md:pt-12" : ""}>
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
                      href="#estimate"
                      data-cursor="estimate"
                      className="btn-magnetic btn-magnetic-inverse inline-flex items-center gap-3 rounded-full border border-cream bg-cream px-7 py-3.5 text-xs font-medium tracking-[0.2em] text-ink"
                    >
                      Start Your Project
                      <span className="relative z-[2]" aria-hidden="true">
                        →
                      </span>
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
          !previewOnly &&
          calloutContent && (
            <Reveal delay={120} className="mt-10 md:mt-14">
              <div className="rounded-sm border border-foreground/10 bg-cream px-8 py-10 md:px-12 md:py-12">
                <div className="flex flex-col gap-8 md:flex-row md:items-end md:justify-between">
                  <div className="max-w-3xl">
                    <div className="flex items-center gap-3 text-foreground/60">
                      <span className="h-px w-12 bg-foreground/40" />
                      <span className="eyebrow">{calloutContent.eyebrow}</span>
                    </div>
                    <h3 className="mt-5 font-display text-3xl uppercase tracking-[-0.02em] text-[#021E44] md:text-4xl">
                      {calloutContent.heading}
                    </h3>
                    {calloutContent.body && (
                      <RichHtml html={calloutContent.body} className={`mt-5 ${bodyCopyLight}`} />
                    )}
                  </div>
                  {calloutContent.buttonLabel && (
                    <a
                      href={calloutContent.buttonUrl}
                      className="inline-flex shrink-0 items-center gap-3 rounded-full border border-foreground/20 px-8 py-4 text-xs font-medium tracking-[0.22em] text-foreground transition hover:border-foreground/40"
                    >
                      {calloutContent.buttonLabel}
                      <span aria-hidden="true">→</span>
                    </a>
                  )}
                </div>
              </div>
            </Reveal>
          )
        )}
      </div>
    </section>
  );
}
