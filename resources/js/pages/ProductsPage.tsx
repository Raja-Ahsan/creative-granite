import { useMemo, useState } from "react";
import { CTA, Footer, Header } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import type { Product, ProductImage } from "@/types/content";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";
import { SiteLayout } from "@/layouts/SiteLayout";

const MATERIAL_ORDER = ["Stainless Steel", "Porcelain", "Fireclay", "Quartz Composite"];

function productVariants(product: Product): ProductImage[] {
  if (product.images.length > 0) {
    return product.images;
  }

  if (product.image) {
    return [{ src: product.image, alt: product.name, label: "Standard" }];
  }

  return [];
}

function ProductCard({ product, index }: { product: Product; index: number }) {
  const variants = productVariants(product);
  const [activeIndex, setActiveIndex] = useState(0);
  const [swatchHover, setSwatchHover] = useState(false);
  const activeVariant = variants[activeIndex] ?? variants[0];

  const handleCardEnter = () => {
    if (!swatchHover && variants.length > 1) {
      setActiveIndex(1);
    }
  };

  const handleCardLeave = () => {
    setSwatchHover(false);
    setActiveIndex(0);
  };

  const handleSwatchEnter = (variantIndex: number) => {
    setSwatchHover(true);
    setActiveIndex(variantIndex);
  };

  const handleSwatchLeave = () => {
    setSwatchHover(false);
    setActiveIndex(variants.length > 1 ? 1 : 0);
  };

  return (
    <Reveal delay={index * 50}>
      <div
        className="group flex h-full flex-col overflow-hidden rounded-sm border border-foreground/10 bg-cream transition-all duration-500 hover:-translate-y-1 hover:border-foreground/25 hover:shadow-[0_24px_60px_-30px_rgba(2,30,68,0.35)]"
        onMouseLeave={handleCardLeave}
      >
        <div
          className="relative bg-[linear-gradient(180deg,#f7f4ef_0%,#ece7de_100%)] p-6 md:p-8"
          onMouseEnter={handleCardEnter}
        >
          <span className="absolute left-5 top-5 z-[2] rounded-full border border-foreground/15 bg-cream/90 px-3 py-1 font-mono text-[10px] tracking-[0.18em] text-foreground/70 backdrop-blur-sm">
            {product.model ?? product.name}
          </span>
          {product.material && (
            <span className="absolute right-5 top-5 z-[2] rounded-full bg-ink px-3 py-1 text-[10px] font-medium uppercase tracking-[0.18em] text-cream">
              {product.material}
            </span>
          )}

          {activeVariant ? (
            <a
              href={`/products/${product.slug}`}
              className="img-zoom mx-auto block aspect-[4/3] max-w-[320px] overflow-hidden"
              data-cursor="view"
            >
              <img
                key={activeVariant.src}
                src={activeVariant.src}
                alt={`${product.name}${activeVariant.label ? ` — ${activeVariant.label}` : ""}`}
                loading="lazy"
                decoding="async"
                className="h-full w-full object-contain transition-all duration-500 group-hover:scale-[1.03]"
              />
            </a>
          ) : (
            <div className="mx-auto flex aspect-[4/3] max-w-[320px] items-center justify-center rounded-sm border border-dashed border-foreground/15">
              <span className="font-mono text-[10px] tracking-[0.2em] text-foreground/40">Image coming soon</span>
            </div>
          )}

          {activeVariant?.label && variants.length > 1 && (
            <p className="mt-3 text-center text-[10px] font-medium uppercase tracking-[0.18em] text-foreground/50">
              {activeVariant.label}
            </p>
          )}

          {variants.length > 1 && (
            <div className="mt-4 flex flex-wrap items-center justify-center gap-2">
              {variants.map((variant, variantIndex) => (
                <div
                  key={`${variant.src}-${variantIndex}`}
                  role="presentation"
                  onMouseEnter={() => handleSwatchEnter(variantIndex)}
                  onMouseLeave={handleSwatchLeave}
                  className={`h-10 w-10 cursor-pointer overflow-hidden rounded-full border bg-cream p-1 shadow-sm transition-all duration-300 ${
                    activeIndex === variantIndex
                      ? "scale-110 border-foreground ring-2 ring-foreground/15"
                      : "border-foreground/15 hover:border-foreground/40"
                  }`}
                  title={variant.label}
                >
                  <img
                    src={variant.src}
                    alt={variant.label ?? product.name}
                    className="pointer-events-none h-full w-full object-contain"
                  />
                </div>
              ))}
            </div>
          )}
        </div>

        <a
          href={`/products/${product.slug}`}
          className="flex flex-1 flex-col px-6 pb-7 pt-5 md:px-8 md:pb-8"
          data-cursor="view"
        >
          <h2 className="font-display text-2xl uppercase leading-[0.98] tracking-[-0.02em] text-[#021E44] md:text-[1.65rem]">
            {product.bowlDescription ?? product.name}
          </h2>
          <p className="mt-3 line-clamp-2 text-sm font-light leading-relaxed text-foreground/65">
            {product.mount}
            {product.dimensions ? ` · ${product.dimensions}` : ""}
          </p>
          {product.colorsFinish && (
            <p className="mt-3 text-xs uppercase tracking-[0.16em] text-foreground/45">
              {product.colorsFinish}
            </p>
          )}
          <div className="mt-auto flex items-center justify-between border-t border-foreground/10 pt-5">
            <span className="text-[10px] font-medium uppercase tracking-[0.22em] text-foreground/55">
              View specifications
            </span>
            <span className="text-lg text-foreground/70 transition-transform duration-500 group-hover:translate-x-1">
              →
            </span>
          </div>
        </a>
      </div>
    </Reveal>
  );
}

export function ProductsPage() {
  const section = useSection("products");
  const { products } = useSiteContent();
  const [activeMaterial, setActiveMaterial] = useState<string>("All");

  const materials = useMemo(() => {
    const found = Array.from(new Set(products.map((p) => p.material).filter(Boolean))) as string[];
    return ["All", ...MATERIAL_ORDER.filter((m) => found.includes(m)), ...found.filter((m) => !MATERIAL_ORDER.includes(m))];
  }, [products]);

  const filtered = useMemo(
    () => (activeMaterial === "All" ? products : products.filter((p) => p.material === activeMaterial)),
    [products, activeMaterial],
  );

  const grouped = useMemo(() => {
    if (activeMaterial !== "All") {
      return [{ material: activeMaterial, items: filtered }];
    }

    return MATERIAL_ORDER.map((material) => ({
      material,
      items: products.filter((p) => p.material === material),
    })).filter((group) => group.items.length > 0);
  }, [products, filtered, activeMaterial]);

  return (
    <SiteLayout>
      <main>
        <Header />

        <section className="relative overflow-hidden bg-cream pb-10 pt-[calc(4.25rem+5rem)] md:pb-14 md:pt-[calc(6.5rem+7rem)]">
          <div className="pointer-events-none absolute inset-0 noise-overlay opacity-60" />
          <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <div className="flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">{section.eyebrow}</span>
              </div>
              <div className="mt-6">
                <h1 className={`max-w-4xl ${sectionHeadingLight}`}>{section.heading}</h1>
                {section.subheading && (
                  <p className={`mt-8 max-w-2xl ${bodyCopyLight}`}>{section.subheading}</p>
                )}
              </div>
            </Reveal>
          </div>
        </section>

        <section className="sticky top-[4.25rem] z-20 border-y border-foreground/10 bg-cream/95 backdrop-blur-md md:top-[6.5rem]">
          <div className="mx-auto flex max-w-[1400px] gap-2 overflow-x-auto px-6 py-4 md:px-10">
            {materials.map((material) => (
              <button
                key={material}
                type="button"
                onClick={() => setActiveMaterial(material)}
                className={`shrink-0 rounded-full border px-5 py-2.5 text-[10px] font-medium uppercase tracking-[0.2em] transition-colors duration-300 ${
                  activeMaterial === material
                    ? "border-foreground bg-foreground text-cream"
                    : "border-foreground/15 bg-transparent text-foreground/65 hover:border-foreground/35 hover:text-foreground"
                }`}
              >
                {material}
              </button>
            ))}
          </div>
        </section>

        <section id="products" className="relative bg-bone py-16 md:py-24">
          <div className="mx-auto max-w-[1400px] px-6 md:px-10">
            {filtered.length === 0 ? (
              <Reveal>
                <p className={`text-center ${bodyCopyLight}`}>No products available at the moment.</p>
              </Reveal>
            ) : (
              <div className="space-y-20 md:space-y-28">
                {grouped.map((group, groupIndex) => (
                  <div key={group.material}>
                    {activeMaterial === "All" && (
                      <Reveal delay={groupIndex * 40}>
                        <div className="mb-10 flex items-end justify-between gap-6 border-b border-foreground/10 pb-6">
                          <div>
                            <p className="eyebrow text-foreground/50">{String(groupIndex + 1).padStart(2, "0")}</p>
                            <h2 className="mt-3 font-display text-3xl uppercase tracking-[-0.02em] text-[#021E44] md:text-4xl">
                              {group.material}
                            </h2>
                          </div>
                          <span className="font-mono text-xs tracking-[0.16em] text-foreground/45">
                            {group.items.length} models
                          </span>
                        </div>
                      </Reveal>
                    )}

                    <div className="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                      {group.items.map((product, i) => (
                        <ProductCard key={product.slug} product={product} index={i} />
                      ))}
                    </div>
                  </div>
                ))}
              </div>
            )}
          </div>
        </section>

        <CTA />
        <Footer />
      </main>
    </SiteLayout>
  );
}
