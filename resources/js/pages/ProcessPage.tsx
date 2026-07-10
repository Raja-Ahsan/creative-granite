import { CTA, Footer, Header } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { bodyCopyLight, bodyCopySmall, sectionHeadingLight } from "@/utils/typography";
import { SiteLayout } from "@/layouts/SiteLayout";

export function ProcessPage() {
  const section = useSection("process");
  const { processSteps } = useSiteContent();

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

        <section id="process" className="relative bg-bone py-20 md:py-28">
          <div className="mx-auto max-w-[1400px] px-6 md:px-10">
            {processSteps.length === 0 ? (
              <Reveal>
                <p className={`text-center ${bodyCopyLight}`}>Process steps are being updated. Please check back soon.</p>
              </Reveal>
            ) : (
              <div className="grid grid-cols-1 gap-px overflow-hidden rounded-sm bg-foreground/15 sm:grid-cols-2 lg:grid-cols-4">
                {processSteps.map((step, i) => (
                  <Reveal key={step.n} delay={i * 80}>
                    <div className="group flex h-full flex-col bg-cream p-8 md:p-10">
                      <div className="flex items-center justify-between">
                        <span className="font-mono text-xs text-foreground/50">{step.n}</span>
                        <span className="h-px w-8 bg-foreground/20 transition-all duration-500 group-hover:w-16 group-hover:bg-foreground" />
                      </div>
                      <h2 className="mt-12 font-display text-3xl uppercase leading-tight tracking-[-0.01em] md:mt-16 md:text-4xl">
                        {step.t}
                      </h2>
                      <p className={`mt-4 flex-1 ${bodyCopySmall}`}>{step.d}</p>
                    </div>
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
