import { useEffect, useMemo, useState } from "react";
import { CTA, Footer, Header } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useSiteContent } from "@/contexts/SiteContentContext";
import { useProductSlug } from "@/router/SiteRouter";
import type { Product, ProductImage } from "@/types/content";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";
import { SiteLayout } from "@/layouts/SiteLayout";

type SpecRow = {
  label: string;
  value?: string | null;
};

function productSpecs(product: Product): SpecRow[] {
  return [
    { label: "Model", value: product.model ?? product.name },
    { label: "Material", value: product.material },
    { label: "Bowl Configuration", value: product.bowlDescription },
    { label: "Mount", value: product.mount },
    { label: "Gauge", value: product.gauge },
    { label: "Construction", value: product.construction },
    { label: "Dimensions", value: product.dimensions },
    { label: "Colors / Finish", value: product.colorsFinish },
    { label: "Optional Accessories", value: product.optionalAccessories },
  ].filter((row) => row.value && row.value.trim() !== "");
}

function productGallery(product: Product): ProductImage[] {
  if (product.images.length > 0) {
    return product.images;
  }

  if (product.image) {
    return [{ src: product.image, alt: product.name, label: "Standard" }];
  }

  return [];
}

export function ProductDetailPage() {
  const slug = useProductSlug();
  const { products } = useSiteContent();
  const product = products.find((item) => item.slug === slug);
  const specs = product ? productSpecs(product) : [];
  const gallery = product ? productGallery(product) : [];
  const [activeIndex, setActiveIndex] = useState(0);
  const colorLabels = useMemo(
    () => gallery.map((image) => image.label).filter(Boolean),
    [gallery],
  );
  const activeImage = gallery[activeIndex] ?? gallery[0];

  useEffect(() => {
    setActiveIndex(0);
  }, [slug]);

  useEffect(() => {
    if (product) {
      document.title = `${product.model ?? product.name} — Creative Granite & Design`;
    }
  }, [product]);

  if (!product) {
    return (
      <SiteLayout>
        <main>
          <Header />
          <section className="mx-auto max-w-[1400px] px-6 py-32 md:px-10">
            <h1 className={sectionHeadingLight}>Product not found</h1>
            <a href="/products" className="link-underline mt-6 inline-block text-sm tracking-[0.2em]">
              Back to products
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
              <a href="/products" className="link-underline text-xs tracking-[0.22em] text-foreground/60">
                ← All products
              </a>
              <div className="mt-8 flex flex-wrap items-center gap-3">
                <span className="rounded-full border border-foreground/15 px-3 py-1 font-mono text-[10px] tracking-[0.18em] text-foreground/65">
                  {product.model ?? product.name}
                </span>
                {product.material && (
                  <span className="rounded-full bg-ink px-3 py-1 text-[10px] font-medium uppercase tracking-[0.18em] text-cream">
                    {product.material}
                  </span>
                )}
              </div>
              <h1 className={`mt-6 max-w-4xl scroll-mt-32 ${sectionHeadingLight}`}>
                {product.bowlDescription ?? product.name}
              </h1>
              {product.dimensions && (
                <p className={`mt-5 max-w-2xl text-lg font-light ${bodyCopyLight}`}>{product.dimensions}</p>
              )}
            </Reveal>
          </div>
        </section>

        <section className="border-t border-foreground/10 bg-bone pb-28 md:pb-40">
          <div className="mx-auto max-w-[1400px] px-6 pt-12 md:px-10 md:pt-16">
            <div className="grid grid-cols-1 gap-12 lg:grid-cols-12 lg:gap-16">
              <div className="lg:col-span-6 lg:sticky lg:top-32 lg:self-start">
                <Reveal>
                  {activeImage ? (
                    <div className="overflow-hidden rounded-sm border border-foreground/10 bg-[linear-gradient(180deg,#faf8f4_0%,#efeae2_100%)]">
                      <div className="aspect-square p-8 md:p-12">
                        <img
                          key={activeImage.src}
                          src={activeImage.src}
                          alt={`${product.model ?? product.name} — ${activeImage.label ?? "view"}`}
                          loading="eager"
                          decoding="async"
                          fetchPriority="high"
                          className="h-full w-full object-contain transition-opacity duration-300"
                        />
                      </div>
                      {activeImage.label && (
                        <div className="border-t border-foreground/10 px-6 py-4">
                          <p className="text-[10px] font-medium uppercase tracking-[0.22em] text-foreground/55">
                            Selected finish
                          </p>
                          <p className="mt-1 font-display text-2xl uppercase tracking-[-0.01em] text-[#021E44]">
                            {activeImage.label}
                          </p>
                        </div>
                      )}
                    </div>
                  ) : (
                    <div className="flex aspect-square items-center justify-center rounded-sm border border-dashed border-foreground/15 bg-cream">
                      <span className="font-mono text-xs tracking-[0.2em] text-foreground/45">Image coming soon</span>
                    </div>
                  )}

                  {gallery.length > 1 && (
                    <div className="mt-5">
                      <p className="mb-3 text-[10px] font-medium uppercase tracking-[0.22em] text-foreground/50">
                        Color variations ({gallery.length})
                      </p>
                      <div className="grid grid-cols-4 gap-3 sm:grid-cols-5 md:grid-cols-6">
                        {gallery.map((image, index) => (
                          <button
                            key={image.src}
                            type="button"
                            onClick={() => setActiveIndex(index)}
                            className={`group overflow-hidden rounded-sm border bg-cream p-2 transition-all duration-300 ${
                              activeIndex === index
                                ? "border-foreground ring-2 ring-foreground/15"
                                : "border-foreground/10 hover:border-foreground/30"
                            }`}
                            title={image.label}
                          >
                            <div className="aspect-square overflow-hidden">
                              <img
                                src={image.src}
                                alt={image.label ?? product.name}
                                className="h-full w-full object-contain"
                              />
                            </div>
                            {image.label && (
                              <span className="mt-2 block truncate text-[9px] uppercase tracking-[0.14em] text-foreground/55">
                                {image.label}
                              </span>
                            )}
                          </button>
                        ))}
                      </div>
                    </div>
                  )}
                </Reveal>
              </div>

              <Reveal delay={80} className="lg:col-span-6">
                <div className="rounded-sm border border-foreground/10 bg-cream p-8 md:p-10">
                  <div className="flex items-center gap-3 text-foreground/60">
                    <span className="h-px w-12 bg-foreground/40" />
                    <span className="eyebrow">Specifications</span>
                  </div>

                  {colorLabels.length > 1 && (
                    <div className="mt-8 flex flex-wrap gap-2">
                      {colorLabels.map((label) => (
                        <span
                          key={label}
                          className="rounded-full border border-foreground/10 px-3 py-1 text-[10px] uppercase tracking-[0.16em] text-foreground/55"
                        >
                          {label}
                        </span>
                      ))}
                    </div>
                  )}

                  <dl className="mt-8 divide-y divide-foreground/10">
                    {specs.map((row) => (
                      <div key={row.label} className="grid gap-2 py-5 md:grid-cols-[minmax(0,190px)_1fr] md:gap-8">
                        <dt className="text-[10px] font-medium uppercase tracking-[0.18em] text-foreground/45">
                          {row.label}
                        </dt>
                        <dd className={`text-base font-light leading-relaxed ${bodyCopyLight}`}>{row.value}</dd>
                      </div>
                    ))}
                  </dl>
                </div>

                <div className="mt-8 rounded-sm bg-ink p-8 text-cream md:p-10">
                  <p className="eyebrow text-cream/50">Need this model?</p>
                  <p className="mt-4 font-display text-2xl uppercase leading-tight tracking-[-0.01em] md:text-3xl">
                    Request pricing for {product.model ?? product.name}
                  </p>
                  <p className="mt-4 text-sm font-light leading-relaxed text-cream/70">
                    Share your project details and our team will follow up with availability, lead times, and next steps.
                  </p>
                  <a
                    href="#estimate"
                    data-cursor="estimate"
                    className="btn-magnetic mt-8 inline-flex items-center gap-3 rounded-full border border-cream bg-cream px-10 py-5 text-xs font-medium tracking-[0.25em] text-ink"
                  >
                    <span>Get an Estimate</span>
                    <span className="relative z-[2]">→</span>
                  </a>
                </div>
              </Reveal>
            </div>
          </div>
        </section>

        <CTA />
        <Footer />
      </main>
    </SiteLayout>
  );
}
