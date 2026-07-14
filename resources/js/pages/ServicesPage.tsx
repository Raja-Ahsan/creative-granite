import { CTA, Footer, Header } from "@/components/sections";
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

           
            
          </div>
        </section>

        {/* Services list */}
        <section className="relative bg-ink py-20 text-cream md:py-28">
          <div className="pointer-events-none absolute inset-0 grain opacity-40" />
          <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
            <div className="divide-y divide-cream/15 border-y border-cream/15">
              {services.map((service, i) => (
                <Reveal key={service.slug} delay={i * 100}>
                  <a
                    href={`/services/${service.slug}`}
                    data-cursor="learn"
                    className="group relative grid cursor-pointer grid-cols-12 gap-6 py-10 transition-colors duration-500 hover:bg-cream/[0.04] md:py-14"
                  >
                    <div className="col-span-2 md:col-span-1">
                      <span className="font-mono text-sm opacity-50">0{i + 1}</span>
                    </div>
                    <div className="col-span-10 md:col-span-5">
                      <h2 className="font-display text-2xl transition-transform duration-500 group-hover:translate-x-2 md:text-5xl">
                        {service.title}
                      </h2>
                    </div>
                    <div className="col-span-12 md:col-span-5">
                      <p className="text-cream/70 md:text-lg">{service.excerpt}</p>
                    </div>
                    <div className="col-span-12 flex items-center justify-end md:col-span-1">
                      <span className="text-2xl transition-transform duration-500 group-hover:rotate-45">
                        +
                      </span>
                    </div>
                  </a>
                </Reveal>
              ))}
            </div>
          </div>
        </section>

        {/* Quick process strip */}
        {/* <section className="border-y border-foreground/10 bg-cream py-20 md:py-28">
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
        </section> */}

        <CTA />
        <Footer />
      </main>
    </SiteLayout>
  );
}
