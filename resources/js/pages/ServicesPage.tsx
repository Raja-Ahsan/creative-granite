import { CTA, Footer, Header } from "@/components/sections";
import { ServiceCard } from "@/components/sections/ServiceCard";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";
import { SiteLayout } from "@/layouts/SiteLayout";

export function ServicesPage() {
  const section = useSection("services");
  const { services, processSteps } = useSiteContent();

  return (
    <SiteLayout>
      <main>
        <Header />

        {/* Hero */}
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

            <Reveal delay={120} className="mt-12 flex flex-wrap gap-8 border-t border-foreground/10 pt-10 md:gap-16">
              <div>
                {/* <div className="font-display text-4xl text-[#021E44] md:text-5xl">{services.length}</div> */}
                <div className="eyebrow mt-2 text-foreground/50">Core services</div>
              </div>
              <div>
                {/* <div className="font-display text-4xl text-[#021E44] md:text-5xl">{processSteps.length}</div> */}
                <div className="eyebrow mt-2 text-foreground/50">Step process</div>
              </div>
              <div className="max-w-xs">
                <p className="text-sm font-light leading-relaxed text-foreground/65">
                  From new construction to remodels and multifamily — precision fabrication across Utah.
                </p>
              </div>
            </Reveal>
          </div>
        </section>

        {/* Service cards */}
        <section className="relative bg-ink py-20 text-cream md:py-28">
          <div className="pointer-events-none absolute inset-0 grain opacity-40" />
          <div className="relative mx-auto max-w-[1400px] space-y-6 px-6 md:space-y-8 md:px-10">
            {services.map((service, i) => (
              <ServiceCard
                key={service.slug}
                index={i}
                title={service.title}
                slug={service.slug}
                excerpt={service.excerpt}
                mainImage={service.mainImage}
                reversed={i % 2 === 1}
              />
            ))}
          </div>
        </section>

        {/* Quick process strip */}
        <section className="border-y border-foreground/10 bg-cream py-20 md:py-28">
          <div className="mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <div className="flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">How it works</span>
              </div>
              <h2 className={`mt-6 max-w-2xl ${sectionHeadingLight}`}>Four steps, no surprises.</h2>
            </Reveal>

            <div className="mt-14 grid grid-cols-1 gap-px overflow-hidden rounded-sm bg-foreground/10 sm:grid-cols-2 lg:grid-cols-4">
              {processSteps.map((step, i) => (
                <Reveal key={step.n} delay={i * 80}>
                  <div className="flex h-full flex-col bg-cream p-8 md:p-10">
                    <span className="font-mono text-sm text-foreground/40">{step.n}</span>
                    <h3 className="mt-4 font-display text-2xl uppercase leading-tight tracking-[-0.01em] text-[#021E44]">
                      {step.t}
                    </h3>
                    <p className="mt-4 flex-1 text-sm font-light leading-relaxed text-foreground/65">
                      {step.d}
                    </p>
                  </div>
                </Reveal>
              ))}
            </div>
          </div>
        </section>

        <CTA />
        <Footer />
      </main>
    </SiteLayout>
  );
}
