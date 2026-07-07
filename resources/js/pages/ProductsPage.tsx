import { CTA, Footer, Header } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";
import { SiteLayout } from "@/layouts/SiteLayout";

export function ProductsPage() {
  const section = useSection("products");
  const { products } = useSiteContent();

  return (
    <SiteLayout>
      <main>
        <Header />

        <section className="relative overflow-hidden bg-cream pb-16 pt-[calc(4.25rem+7rem)] md:pb-24 md:pt-[calc(6.5rem+10rem)]">
          <div className="pointer-events-none absolute inset-0 noise-overlay opacity-60" />
          <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <div className="flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">{section.eyebrow}</span>
              </div>
              <h1 className={`mt-6 max-w-4xl ${sectionHeadingLight}`}>{section.heading}</h1>
              {section.subheading && (
                <p className={`mt-8 max-w-2xl ${bodyCopyLight}`}>{section.subheading}</p>
              )}
            </Reveal>
          </div>
        </section>

        <section id="products" className="relative bg-bone py-20 md:py-28">
          <div className="mx-auto max-w-[1400px] px-6 md:px-10">
            {products.length === 0 ? (
              <Reveal>
                <p className={`text-center ${bodyCopyLight}`}>No products available at the moment.</p>
              </Reveal>
            ) : (
              <div className="grid grid-cols-1 gap-px overflow-hidden rounded-sm bg-foreground/15 sm:grid-cols-2 lg:grid-cols-3">
                {products.map((product, i) => (
                  <Reveal key={product.slug} delay={i * 60}>
                    <a
                      href={`/products/${product.slug}`}
                      className="group flex h-full flex-col bg-cream p-8 transition-colors duration-500 hover:bg-foreground hover:text-cream md:p-10"
                      data-cursor="view"
                    >
                      <div className="img-zoom relative mb-8 aspect-[4/3] w-full overflow-hidden rounded-sm">
                        <img
                          src={product.image}
                          alt={product.name}
                          loading="lazy"
                          decoding="async"
                          className="h-full w-full object-cover"
                        />
                      </div>
                      <div className="flex flex-1 flex-col">
                        <span className="font-mono text-xs opacity-60">
                          {String(i + 1).padStart(2, "0")}
                        </span>
                        <h2 className="mt-4 font-display text-3xl uppercase leading-tight tracking-[-0.01em] md:text-4xl">
                          {product.name}
                        </h2>
                        <p className="mt-4 flex-1 text-sm font-light leading-relaxed opacity-80">
                          {product.desc}
                        </p>
                        <div className="mt-8 flex items-center justify-between border-t border-current/20 pt-6 opacity-70">
                          <span className="eyebrow">Learn more</span>
                          <span className="text-xl transition-transform duration-500 group-hover:translate-x-2">
                            →
                          </span>
                        </div>
                      </div>
                    </a>
                  </Reveal>
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
