import { Footer, Header } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { SiteLayout } from "@/layouts/SiteLayout";
import type { Remnant } from "@/types/content";
import { cn } from "@/utils/cn";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

function RemnantCard({ remnant }: { remnant: Remnant }) {
  const specs = [
    remnant.material ? { label: "Material", value: remnant.material } : null,
    remnant.finish ? { label: "Finish", value: remnant.finish } : null,
    remnant.dimensions ? { label: "Size", value: remnant.dimensions } : null,
    remnant.thickness ? { label: "Thickness", value: remnant.thickness } : null,
    remnant.priceLabel ? { label: "Pricing", value: remnant.priceLabel } : null,
  ].filter(Boolean) as { label: string; value: string }[];

  const available = remnant.isAvailable !== false;

  return (
    <article className="flex h-full w-full max-w-md flex-col overflow-hidden border border-foreground/10 bg-cream shadow-[0_12px_40px_rgba(42,38,34,0.06)]">
      <div className="relative aspect-[4/3] overflow-hidden bg-bone">
        {remnant.image ? (
          <img
            src={remnant.image}
            alt={remnant.name}
            className="h-full w-full object-cover"
            loading="lazy"
            decoding="async"
          />
        ) : (
          <div className="flex h-full items-center justify-center text-xs tracking-[0.2em] text-foreground/35">
            No photo
          </div>
        )}
        <span
          className={cn(
            "absolute left-4 top-4 rounded-full px-3 py-1 text-[10px] font-medium uppercase tracking-[0.18em]",
            available ? "bg-cream text-[#2a2622]" : "bg-foreground/80 text-cream",
          )}
        >
          {available ? "Available" : "Unavailable"}
        </span>
      </div>

      <div className="flex flex-1 flex-col px-6 pb-6 pt-5 md:px-7 md:pb-7 md:pt-6">
        <h3 className="font-display text-2xl uppercase leading-[1.05] tracking-[-0.02em] text-[#2a2622]">
          {remnant.name}
        </h3>

        {remnant.suitability && (
          <p className="mt-3 text-sm font-light leading-relaxed text-[#2a2622]/65">{remnant.suitability}</p>
        )}

        {specs.length > 0 && (
          <div className="mt-5 border-t border-foreground/10 pt-4">
            <ul className="m-0 list-none space-y-2.5 p-0">
              {specs.map((spec) => (
                <li key={spec.label} className="flex items-baseline justify-between gap-4 text-sm">
                  <span className="shrink-0 text-[11px] font-medium uppercase tracking-[0.16em] text-[#2a2622]/45">
                    {spec.label}
                  </span>
                  <span className="text-right font-light text-[#2a2622]">{spec.value}</span>
                </li>
              ))}
            </ul>
          </div>
        )}

        {remnant.description && (
          <p className="mt-4 text-sm font-light leading-relaxed text-[#2a2622]/70">{remnant.description}</p>
        )}

        <div className="mt-auto border-t border-foreground/10 pt-5">
          <a
            href="/contact"
            className="inline-flex w-full items-center justify-center gap-3 rounded-full border border-foreground bg-foreground px-6 py-3.5 text-xs font-medium tracking-[0.2em] text-cream transition hover:bg-transparent hover:text-foreground"
          >
            <span>View Details</span>
            <span aria-hidden="true">→</span>
          </a>
        </div>
      </div>
    </article>
  );
}

export function RemnantsPage() {
  const { remnants } = useSiteContent();
  const section = useSection("remnants");
  const hasListings = remnants.length > 0;

  return (
    <SiteLayout>
      <main>
        <Header />

        <section className="relative overflow-hidden bg-cream pb-8 pt-[calc(4.25rem+4.5rem)] md:pb-10 md:pt-[calc(6.5rem+6rem)]">
          <div className="pointer-events-none absolute inset-0 noise-overlay opacity-40" />
          <div className="relative mx-auto max-w-[1400px] px-6 text-center md:px-10">
            <Reveal>
              <div className="flex items-center justify-center gap-3 text-foreground/55">
                <span className="h-px w-10 bg-foreground/35" />
                <span className="eyebrow">{section.eyebrow || "Remnants"}</span>
                <span className="h-px w-10 bg-foreground/35" />
              </div>
              <h1 className={`mx-auto mt-5 max-w-4xl ${sectionHeadingLight}`}>{section.heading}</h1>
              {section.subheading && (
                <p className={`mx-auto mt-5 max-w-2xl ${bodyCopyLight}`}>{section.subheading}</p>
              )}
            </Reveal>
          </div>
        </section>

        <section className="relative bg-bone py-10 md:py-14">
          <div className="mx-auto max-w-[1400px] px-6 md:px-10">
            {hasListings ? (
              <div
                className={cn(
                  "grid gap-8",
                  remnants.length === 1
                    ? "mx-auto max-w-md grid-cols-1 justify-items-center"
                    : remnants.length === 2
                      ? "mx-auto max-w-3xl grid-cols-1 justify-items-center sm:grid-cols-2"
                      : "grid-cols-1 justify-items-center sm:grid-cols-2 lg:grid-cols-3",
                )}
              >
                {remnants.map((remnant, index) => (
                  <Reveal key={remnant.slug} delay={index * 60} className="w-full max-w-md">
                    <RemnantCard remnant={remnant} />
                  </Reveal>
                ))}
              </div>
            ) : (
              <Reveal>
                <div className="mx-auto flex max-w-3xl flex-col items-center border border-foreground/10 bg-cream px-8 py-12 text-center md:px-14 md:py-14">
                  <h2 className="max-w-2xl font-display text-3xl uppercase leading-[1.1] tracking-[-0.02em] text-[#2a2622] md:text-4xl">
                    {section.note || "Available Remnants — Coming Soon"}
                  </h2>
                  {section.body && (
                    <p className="mx-auto mt-6 max-w-xl text-center text-sm font-light leading-relaxed text-[#2a2622]/75 md:text-base md:leading-7">
                      {section.body}
                    </p>
                  )}
                </div>
              </Reveal>
            )}
          </div>
        </section>

        <Footer />
      </main>
    </SiteLayout>
  );
}
