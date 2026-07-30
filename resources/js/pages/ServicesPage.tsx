import { Footer, Header } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useEstimateModal } from "@/contexts/EstimateModalContext";
import { useSiteContent } from "@/contexts/SiteContentContext";
import { SiteLayout } from "@/layouts/SiteLayout";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

export function ServicesPage() {
  const { openEstimateModal } = useEstimateModal();
  const { servicesPage } = useSiteContent();
  const { repairs, cta } = servicesPage;

  return (
    <SiteLayout>
      <main>
        <Header />

        {/* Page hero */}
        <section className="relative overflow-hidden bg-cream pb-10 pt-[calc(4.25rem+5rem)] md:pb-14 md:pt-[calc(6.5rem+7rem)]">
          <div className="pointer-events-none absolute inset-0 noise-overlay opacity-60" />
          <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <div className="flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">{servicesPage.eyebrow}</span>
              </div>
              <h1 className={`mt-6 max-w-4xl ${sectionHeadingLight}`}>{servicesPage.heading}</h1>
              <p className={`mt-8 max-w-2xl ${bodyCopyLight}`}>{servicesPage.body}</p>
            </Reveal>
          </div>

          <Reveal delay={120} className="relative mt-12 md:mt-16">
            <div className="aspect-[16/9] w-full overflow-hidden bg-bone md:aspect-[21/9]">
              <img
                src={servicesPage.heroImage}
                alt={servicesPage.heading}
                className="h-full w-full object-cover"
                fetchPriority="high"
                decoding="async"
              />
            </div>
          </Reveal>
        </section>

        {/* Primary services */}
        {servicesPage.sections.map((service, index) => (
          <section
            key={`${service.number}-${service.title}`}
            className={`relative py-20 md:py-28 ${index % 2 === 0 ? "bg-ink text-cream" : "bg-cream text-foreground"}`}
          >
            <div
              className={`pointer-events-none absolute inset-0 ${index % 2 === 0 ? "grain opacity-40" : "noise-overlay opacity-50"}`}
            />
            <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
              <Reveal>
                <div className="grid grid-cols-12 gap-6 md:gap-10">
                  <div className="col-span-12 md:col-span-2">
                    <span
                      className={`font-mono text-sm tracking-[0.16em] ${index % 2 === 0 ? "text-cream/45" : "text-foreground/40"}`}
                    >
                      {service.number}
                    </span>
                  </div>
                  <div className="col-span-12 md:col-span-10">
                    <h2
                      className={`max-w-3xl font-display text-[clamp(1.75rem,3.8vw,3.25rem)] uppercase leading-[0.95] tracking-[-0.02em] ${index % 2 === 0 ? "text-cream" : "text-[#021E44]"}`}
                    >
                      {service.title}
                    </h2>
                    <p
                      className={`mt-6 max-w-2xl text-base leading-relaxed md:text-lg ${index % 2 === 0 ? "text-cream/70" : "text-foreground/70"}`}
                    >
                      {service.body}
                    </p>
                  </div>
                </div>
              </Reveal>

              <Reveal delay={100} className="mt-10 md:mt-14">
                <div className="aspect-[16/10] w-full overflow-hidden bg-bone md:aspect-[21/9]">
                  <img
                    src={service.hero}
                    alt={service.title}
                    className="h-full w-full object-cover"
                    loading="lazy"
                    decoding="async"
                  />
                </div>
              </Reveal>

              <div className="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-3 md:mt-4 md:gap-4">
                {service.supporting.map((src, i) => (
                  <Reveal key={`${src}-${i}`} delay={140 + i * 60}>
                    <div className="aspect-[4/3] overflow-hidden bg-bone">
                      <img
                        src={src}
                        alt={`${service.title} project ${i + 1}`}
                        className="h-full w-full object-cover"
                        loading="lazy"
                        decoding="async"
                      />
                    </div>
                  </Reveal>
                ))}
              </div>
            </div>
          </section>
        ))}

        {/* Repairs & Warranty */}
        <section className="relative bg-ink pb-20 pt-10 text-cream md:pb-28 md:pt-10">
          <div className="pointer-events-none absolute inset-0 grain opacity-40" />
          <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <div className="grid grid-cols-12 gap-6 md:gap-10">
                <div className="col-span-12 md:col-span-2">
                  <span className="font-mono text-sm tracking-[0.16em] text-cream/45">{repairs.number}</span>
                </div>
                <div className="col-span-12 md:col-span-10">
                  <p className="eyebrow text-cream/50">{repairs.eyebrow}</p>
                  <h2 className="mt-4 max-w-3xl font-display text-[clamp(1.75rem,3.8vw,3.25rem)] uppercase leading-[0.95] tracking-[-0.02em] text-cream">
                    {repairs.heading}
                  </h2>
                  <p className="mt-6 max-w-2xl text-base leading-relaxed text-cream/70 md:text-lg">{repairs.body}</p>
                </div>
              </div>
            </Reveal>

            <Reveal delay={100} className="mt-10 md:mt-14">
              <div className="aspect-[16/10] w-full overflow-hidden bg-bone md:aspect-[21/9]">
                <img
                  src={repairs.image}
                  alt={repairs.heading}
                  className="h-full w-full object-cover"
                  loading="lazy"
                  decoding="async"
                />
              </div>
            </Reveal>

            <div className="mt-10 grid grid-cols-1 gap-6 md:mt-14 md:grid-cols-2 md:gap-8">
              <Reveal delay={120}>
                <div className="flex h-full flex-col border border-cream/15 bg-cream/[0.04] p-8 md:p-10">
                  <h3 className="font-display text-2xl uppercase tracking-[-0.01em] text-cream md:text-3xl">
                    {repairs.warrantyTitle}
                  </h3>
                  <ul className="mt-8 space-y-4 text-cream/75">
                    {repairs.warrantyPoints.map((point) => (
                      <li key={point} className="flex gap-3 text-sm leading-relaxed md:text-base">
                        <span className="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-accent" />
                        <span>{point}</span>
                      </li>
                    ))}
                  </ul>
                  <div className="mt-auto pt-10">
                    <button
                      type="button"
                      onClick={openEstimateModal}
                      data-cursor="estimate"
                      className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-cream bg-transparent px-8 py-4 text-xs font-medium tracking-[0.22em] text-cream"
                    >
                      <span>{repairs.warrantyCta}</span>
                      <span className="relative z-[2]">→</span>
                    </button>
                  </div>
                </div>
              </Reveal>

              <Reveal delay={180}>
                <div className="flex h-full flex-col border border-cream/15 bg-cream/[0.04] p-8 md:p-10">
                  <h3 className="font-display text-2xl uppercase tracking-[-0.01em] text-cream md:text-3xl">
                    {repairs.repairsTitle}
                  </h3>
                  <ul className="mt-8 space-y-4 text-cream/75">
                    {repairs.repairsPoints.map((point) => (
                      <li key={point} className="flex gap-3 text-sm leading-relaxed md:text-base">
                        <span className="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-accent" />
                        <span>{point}</span>
                      </li>
                    ))}
                  </ul>
                  <div className="mt-auto pt-10">
                    <button
                      type="button"
                      onClick={openEstimateModal}
                      data-cursor="estimate"
                      className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-cream bg-cream px-8 py-4 text-xs font-medium tracking-[0.22em] text-ink"
                    >
                      <span>{repairs.repairsCta}</span>
                      <span className="relative z-[2]">→</span>
                    </button>
                  </div>
                </div>
              </Reveal>
            </div>
          </div>
        </section>

        {/* Final CTA */}
        <section className="relative overflow-hidden bg-cream py-28 md:py-36">
          <div className="pointer-events-none absolute inset-0 noise-overlay" />
          <div className="relative mx-auto max-w-[1400px] px-6 text-center md:px-10">
            <Reveal>
              <h2 className={`mx-auto max-w-4xl ${sectionHeadingLight}`}>{cta.heading}</h2>
              <p className={`mx-auto mt-8 max-w-[750px] text-lg ${bodyCopyLight}`}>{cta.body}</p>
              <div className="mt-12 flex justify-center">
                <button
                  type="button"
                  onClick={openEstimateModal}
                  data-cursor="estimate"
                  className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream"
                >
                  <span>{cta.button}</span>
                  <span className="relative z-[2]">→</span>
                </button>
              </div>
            </Reveal>
          </div>
        </section>

        <Footer />
      </main>
    </SiteLayout>
  );
}
