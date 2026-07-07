import { useEffect } from "react";
import { CTA, Footer, Header } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useSiteContent } from "@/contexts/SiteContentContext";
import { useProductSlug } from "@/router/SiteRouter";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";
import { SiteLayout } from "@/layouts/SiteLayout";

export function ProductDetailPage() {
  const slug = useProductSlug();
  const { products } = useSiteContent();
  const product = products.find((item) => item.slug === slug);

  useEffect(() => {
    if (product) {
      document.title = `${product.name} — Creative Granite & Design`;
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

  const showExcerpt = product.desc && product.desc !== product.description;

  return (
    <SiteLayout>
      <main>
        <Header />

        <section className="relative bg-cream pt-[calc(4.25rem+7rem)] md:pt-[calc(6.5rem+10rem)]">
          <div className="pointer-events-none absolute inset-0 noise-overlay opacity-50" />
          <div className="relative mx-auto max-w-[1400px] px-6 pb-12 md:px-10 md:pb-16">
            <Reveal>
              <a href="/products" className="link-underline text-xs tracking-[0.22em] text-foreground/60">
                ← All products
              </a>
              <div className="mt-8 flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">Product</span>
              </div>
              <h1 className={`mt-6 max-w-4xl scroll-mt-32 ${sectionHeadingLight}`}>{product.name}</h1>
              {showExcerpt && (
                <p className={`mt-6 max-w-2xl text-xl font-light leading-relaxed md:text-2xl ${bodyCopyLight}`}>
                  {product.desc}
                </p>
              )}
            </Reveal>
          </div>
        </section>

        {product.image && (
          <Reveal className="bg-cream py-12 md:py-16">
            <div className="mx-auto max-w-[1400px] px-6 md:px-10">
              <div className="aspect-[21/9] overflow-hidden rounded-sm bg-bone">
                <img
                  src={product.image}
                  alt={product.name}
                  loading="eager"
                  decoding="async"
                  fetchPriority="high"
                  className="h-full w-full object-cover"
                />
              </div>
            </div>
          </Reveal>
        )}

        <section className="border-t border-foreground/10 bg-cream pb-28 md:pb-40">
          <div className="mx-auto max-w-[800px] px-6 pt-14 md:px-10 md:pt-20">
            {product.description ? (
              <Reveal>
                <div className={`space-y-6 text-lg font-light leading-relaxed ${bodyCopyLight}`}>
                  {product.description.split(/\n\n+/).map((paragraph, i) => (
                    <p key={i}>{paragraph}</p>
                  ))}
                </div>
              </Reveal>
            ) : (
              <Reveal>
                <p className={`${bodyCopyLight} text-lg`}>
                  Full details for this product are coming soon. Contact us to discuss your project.
                </p>
              </Reveal>
            )}

            {(product.relatedImages ?? []).length > 0 && (
              <Reveal delay={80} className="mt-16">
                <div className="flex items-center gap-3 text-foreground/60">
                  <span className="h-px w-12 bg-foreground/40" />
                  <span className="eyebrow">Gallery</span>
                </div>
                <h2 className={`mt-6 ${sectionHeadingLight}`}>Related images</h2>
                <div className="mt-10 grid grid-cols-1 gap-4 sm:grid-cols-2">
                  {(product.relatedImages ?? []).map((img, i) => (
                    <div
                      key={`${img.src}-${i}`}
                      className="img-zoom aspect-[4/3] overflow-hidden rounded-sm bg-bone"
                      data-cursor="view"
                    >
                      <img
                        src={img.src}
                        alt={img.alt}
                        loading="lazy"
                        decoding="async"
                        className="h-full w-full object-cover"
                      />
                    </div>
                  ))}
                </div>
              </Reveal>
            )}

            <Reveal delay={150} className="mt-16 flex flex-col gap-4 border-t border-foreground/10 pt-10 sm:flex-row sm:items-center sm:justify-between">
              <p className="text-sm font-light text-foreground/65" style={{ fontFamily: "Inter, sans-serif" }}>
                Interested in {product.name.toLowerCase()}?
              </p>
              <a
                href="#estimate"
                data-cursor="estimate"
                className="btn-magnetic inline-flex shrink-0 items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream"
              >
                <span>Get an estimate</span>
                <span className="relative z-[2]">→</span>
              </a>
            </Reveal>
          </div>
        </section>

        <CTA />
        <Footer />
      </main>
    </SiteLayout>
  );
}
