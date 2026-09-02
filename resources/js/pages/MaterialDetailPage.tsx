import { useEffect, useMemo } from "react";
import { CTA, Footer, Header } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useSiteContent } from "@/contexts/SiteContentContext";
import { SiteLayout } from "@/layouts/SiteLayout";
import { useMaterialSlug } from "@/router/SiteRouter";
import type { Material } from "@/types/content";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

function materialGallery(material: Material) {
  if (material.images && material.images.length > 0) {
    return material.images;
  }

  if (material.image) {
    return [{ src: material.image, alt: material.name }];
  }

  return [];
}

const defaultCta = {
  eyebrow: "Need help choosing?",
  heading: "Not sure which material is right for your project?",
  body: "The right surface depends on more than appearance. How the space will be used, maintenance expectations, application, design direction, and the characteristics of the individual material all matter. Our team can help you explore your options, understand the differences, and select a surface that works beautifully for your project.",
  secondaryLabel: "Contact Us",
  secondaryUrl: "/contact",
};

function useMaterial() {
  const slug = useMaterialSlug();
  const { materials } = useSiteContent();

  return useMemo(() => materials.find((item) => item.slug === slug) ?? null, [materials, slug]);
}

export function MaterialDetailPage() {
  const material = useMaterial();
  const gallery = material ? materialGallery(material) : [];
  const whyChooseHeading =
    material?.whyChooseHeading?.trim() ||
    (material ? `Why choose ${material.name.toLowerCase()}` : "");
  const ctaEyebrow = material?.ctaEyebrow?.trim() || defaultCta.eyebrow;
  const ctaHeading = material?.ctaHeading?.trim() || defaultCta.heading;
  const ctaBody = material?.ctaBody?.trim() || defaultCta.body;
  const ctaSecondaryLabel = material?.ctaSecondaryLabel?.trim() || defaultCta.secondaryLabel;
  const ctaSecondaryUrl = material?.ctaSecondaryUrl?.trim() || defaultCta.secondaryUrl;

  useEffect(() => {
    if (material) {
      document.title = `${material.name} — Creative Granite & Design`;
    }
  }, [material]);

  if (!material) {
    return (
      <SiteLayout>
        <main>
          <Header />
          <section className="mx-auto max-w-[1400px] px-6 py-32 md:px-10">
            <h1 className={sectionHeadingLight}>Material not found</h1>
            <a href="/#materials" className="link-underline mt-6 inline-block text-sm tracking-[0.2em]">
              Back to materials
            </a>
          </section>
          <Footer />
        </main>
      </SiteLayout>
    );
  }

  return (
    <SiteLayout>
      <main>
        <Header />

        <section className="relative overflow-hidden bg-cream pt-[calc(4.25rem+5rem)] md:pt-[calc(6.5rem+7rem)]">
          <div className="pointer-events-none absolute inset-0 noise-overlay opacity-50" />
          <div className="relative mx-auto max-w-[1400px] px-6 pb-10 md:px-10 md:pb-14">
            <Reveal>
              <a href="/#materials" className="link-underline text-xs tracking-[0.22em] text-foreground/60">
                ← All materials
              </a>
              <div className="mt-8 flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">Material</span>
              </div>
              {material.tagline && (
                <p className="mt-6 text-sm font-medium uppercase tracking-[0.18em] text-foreground/55">
                  {material.tagline}
                </p>
              )}
              <h1 className={`mt-4 max-w-4xl scroll-mt-32 ${sectionHeadingLight}`}>{material.name}</h1>
              {material.intro && (
                <p className={`mt-8 max-w-3xl text-lg font-light leading-relaxed md:text-xl ${bodyCopyLight}`}>
                  {material.intro}
                </p>
              )}
            </Reveal>
          </div>
        </section>

        <section className="border-t border-foreground/10 bg-bone pb-20 md:pb-28">
          <div className="mx-auto max-w-[1400px] px-6 pt-12 md:px-10 md:pt-16">
            {gallery.length > 0 && (
              <Reveal>
                <div className={`grid gap-4 ${gallery.length > 1 ? "md:grid-cols-2" : ""}`}>
                  <div className={`overflow-hidden rounded-sm border border-foreground/10 bg-cream ${gallery.length > 1 ? "md:col-span-2 md:max-h-[520px]" : ""}`}>
                    <img
                      src={gallery[0].src}
                      alt={gallery[0].alt}
                      className="h-full w-full object-cover"
                      loading="eager"
                      decoding="async"
                    />
                  </div>
                  {gallery.slice(1).map((image) => (
                    <div key={image.src} className="overflow-hidden rounded-sm border border-foreground/10 bg-cream">
                      <img
                        src={image.src}
                        alt={image.alt}
                        className="aspect-[4/3] w-full object-cover"
                        loading="lazy"
                        decoding="async"
                      />
                    </div>
                  ))}
                </div>
              </Reveal>
            )}

            <div className="mt-16 grid gap-10 lg:grid-cols-12 lg:gap-16">
              {(material.whyChoose?.length ?? 0) > 0 && (
                <Reveal className="lg:col-span-7">
                  <div className="rounded-sm border border-foreground/10 bg-cream p-8 md:p-10">
                    <div className="flex items-center gap-3 text-foreground/60">
                      <span className="h-px w-12 bg-foreground/40" />
                      <span className="eyebrow">{whyChooseHeading}</span>
                    </div>
                    <ul className="mt-8 space-y-4">
                      {material.whyChoose?.map((point) => (
                        <li key={point} className="flex gap-3 text-base font-light leading-relaxed text-foreground/80">
                          <span className="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-accent" />
                          <span>{point}</span>
                        </li>
                      ))}
                    </ul>
                  </div>
                </Reveal>
              )}

              <Reveal delay={80} className="lg:col-span-5">
                <div className="space-y-6">
                  {material.whatToKnow && (
                    <div className="rounded-sm border border-foreground/10 bg-cream p-8">
                      <p className="eyebrow text-foreground/50">What to know</p>
                      <p className={`mt-4 ${bodyCopyLight}`}>{material.whatToKnow}</p>
                    </div>
                  )}

                  {material.bestFor && (
                    <div className="rounded-sm bg-ink p-8 text-cream">
                      <p className="eyebrow text-cream/50">Best for</p>
                      <p className="mt-4 text-sm font-light leading-relaxed text-cream/80">{material.bestFor}</p>
                    </div>
                  )}

                  {material.careGuideUrl && material.careGuideLabel && (
                    <a
                      href={material.careGuideUrl}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="inline-flex items-center gap-3 rounded-sm border border-foreground/15 bg-cream px-5 py-4 text-sm font-medium uppercase tracking-[0.16em] text-foreground transition hover:border-foreground/30"
                    >
                      <span>{material.careGuideLabel}</span>
                      <span aria-hidden="true">→</span>
                    </a>
                  )}
                </div>
              </Reveal>
            </div>

            <Reveal delay={120} className="mt-20">
              <div className="rounded-sm border border-foreground/10 bg-cream px-8 py-10 md:px-12 md:py-14">
                <p className="eyebrow text-foreground/50">{ctaEyebrow}</p>
                <h2 className="mt-4 font-display text-3xl uppercase tracking-[-0.02em] text-[#021E44] md:text-4xl">
                  {ctaHeading}
                </h2>
                <p className={`mt-6 max-w-3xl ${bodyCopyLight}`}>{ctaBody}</p>
                <div className="mt-8 flex flex-wrap gap-4">
                  <a
                    href={ctaSecondaryUrl}
                    className="inline-flex items-center gap-3 rounded-full border border-foreground/20 px-8 py-4 text-xs font-medium tracking-[0.22em] text-foreground transition hover:border-foreground/40"
                  >
                    {ctaSecondaryLabel}
                  </a>
                </div>
              </div>
            </Reveal>
          </div>
        </section>

        <CTA showEstimate={false} />
        <Footer />
      </main>
    </SiteLayout>
  );
}
