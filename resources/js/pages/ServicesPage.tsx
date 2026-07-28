import { Footer, Header } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useEstimateModal } from "@/contexts/EstimateModalContext";
import { SiteLayout } from "@/layouts/SiteLayout";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

const IMG = "/images/services";

const primaryServices = [
  {
    n: "01",
    title: "New Construction & Residential",
    body: "Partnering with builders, designers, and homeowners to fabricate and install custom stone surfaces with precision from planning through installation.",
    hero: `${IMG}/new-construction-hero.jpg`,
    supporting: [
      `${IMG}/new-construction-1.jpg`,
      `${IMG}/new-construction-2.jpg`,
      `${IMG}/new-construction-3.jpg`,
    ],
  },
  {
    n: "02",
    title: "Remodel & Renovation",
    body: "Transform kitchens, bathrooms, fireplaces, and living spaces with expertly fabricated stone tailored to your vision.",
    hero: `${IMG}/remodel-hero.png`,
    supporting: [`${IMG}/remodel-1.jpg`, `${IMG}/remodel-2.jpg`, `${IMG}/remodel-3.jpg`],
  },
  {
    n: "03",
    title: "Multifamily & Commercial",
    body: "Reliable stone fabrication and installation for multifamily developments, hospitality, retail, healthcare, office, and commercial environments.",
    hero: `${IMG}/commercial-hero.jpg`,
    supporting: [
      `${IMG}/commercial-1.jpg`,
      `${IMG}/commercial-2.jpg`,
      `${IMG}/commercial-3.jpg`,
    ],
  },
] as const;

const warrantyPoints = [
  "One-year workmanship warranty",
  "Warranty support for qualifying fabrication and installation issues",
  "Dedicated service team",
] as const;

const repairPoints = [
  "Repair services available by request",
  "Contact us for an evaluation and quote",
] as const;

export function ServicesPage() {
  const { openEstimateModal } = useEstimateModal();

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
                <span className="eyebrow">Services</span>
              </div>
              <h1 className={`mt-6 max-w-4xl ${sectionHeadingLight}`}>
                Stone Fabrication for Every Stage of Your Project.
              </h1>
              <p className={`mt-8 max-w-2xl ${bodyCopyLight}`}>
                From custom homes and remodels to multifamily and commercial spaces, we fabricate,
                install, and support premium stone surfaces built to last.
              </p>
            </Reveal>
          </div>

          <Reveal delay={120} className="relative mt-12 md:mt-16">
            <div className="aspect-[16/9] w-full overflow-hidden bg-bone md:aspect-[21/9]">
              <img
                src={`${IMG}/hero.png`}
                alt="Custom stone kitchen fabrication by Creative Granite"
                className="h-full w-full object-cover"
                fetchPriority="high"
                decoding="async"
              />
            </div>
          </Reveal>
        </section>

        {/* Primary services 01–03 */}
        {primaryServices.map((service, index) => (
          <section
            key={service.n}
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
                      {service.n}
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
                  <Reveal key={src} delay={140 + i * 60}>
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

        {/* 04. Repairs & Warranty */}
        <section className="relative bg-ink pb-20 pt-10 text-cream md:pb-28 md:pt-10">
          <div className="pointer-events-none absolute inset-0 grain opacity-40" />
          <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <div className="grid grid-cols-12 gap-6 md:gap-10">
                <div className="col-span-12 md:col-span-2">
                  <span className="font-mono text-sm tracking-[0.16em] text-cream/45">04</span>
                </div>
                <div className="col-span-12 md:col-span-10">
                  <p className="eyebrow text-cream/50">Repairs &amp; Warranty</p>
                  <h2 className="mt-4 max-w-3xl font-display text-[clamp(1.75rem,3.8vw,3.25rem)] uppercase leading-[0.95] tracking-[-0.02em] text-cream">
                    Stand Behind Every Installation
                  </h2>
                  <p className="mt-6 max-w-2xl text-base leading-relaxed text-cream/70 md:text-lg">
                    Our commitment doesn&apos;t end after installation. We provide warranty support
                    for qualifying workmanship and offer repair services to help keep your stone
                    surfaces looking their best.
                  </p>
                </div>
              </div>
            </Reveal>

            <Reveal delay={100} className="mt-10 md:mt-14">
              <div className="aspect-[16/10] w-full overflow-hidden bg-bone md:aspect-[21/9]">
                <img
                  src={`${IMG}/repairs-hero-blue.png`}
                  alt="Stone cutting and fabrication with diamond blade"
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
                    Warranty
                  </h3>
                  <ul className="mt-8 space-y-4 text-cream/75">
                    {warrantyPoints.map((point) => (
                      <li key={point} className="flex gap-3 text-sm leading-relaxed md:text-base">
                        <span className="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-accent" />
                        <span>{point}</span>
                      </li>
                    ))}
                  </ul>
                  <div className="mt-auto pt-10">
                    <a
                      href={`${IMG}/cgd-warranty.pdf`}
                      target="_blank"
                      rel="noopener noreferrer"
                      data-cursor="view"
                      className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-cream bg-transparent px-8 py-4 text-xs font-medium tracking-[0.22em] text-cream"
                    >
                      <span>Download Warranty PDF</span>
                      <span className="relative z-[2]">→</span>
                    </a>
                  </div>
                </div>
              </Reveal>

              <Reveal delay={180}>
                <div className="flex h-full flex-col border border-cream/15 bg-cream/[0.04] p-8 md:p-10">
                  <h3 className="font-display text-2xl uppercase tracking-[-0.01em] text-cream md:text-3xl">
                    Repairs
                  </h3>
                  <ul className="mt-8 space-y-4 text-cream/75">
                    {repairPoints.map((point) => (
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
                      <span>Request a Repair Estimate</span>
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
              <h2 className={`mx-auto max-w-4xl ${sectionHeadingLight}`}>
                Ready to Start Your Project?
              </h2>
              <p className={`mx-auto mt-8 max-w-[750px] text-lg ${bodyCopyLight}`}>
                Whether you&apos;re building a custom home, remodeling an existing space, or managing
                a multifamily or commercial project, our team is ready to bring your vision to life.
              </p>
              <div className="mt-12 flex justify-center">
                <button
                  type="button"
                  onClick={openEstimateModal}
                  data-cursor="estimate"
                  className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream"
                >
                  <span>Get an Estimate</span>
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
