import { useEffect, useState } from "react";
import { Footer, Header } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useEstimateModal } from "@/contexts/EstimateModalContext";
import { SiteLayout } from "@/layouts/SiteLayout";
import { bodyCopyDark, bodyCopyLight, sectionHeadingDark, sectionHeadingLight } from "@/utils/typography";

type GuideButton = { label: string; url: string };
type GuideMaterial = { name: string; body: string; image?: string | null };
type GuideFaq = { question: string; answer: string };
type GuideStep = { number?: string | null; title: string; body: string };

export type ServiceGuidePayload = {
  title: string;
  slug: string;
  metaTitle?: string | null;
  heroImage?: string | null;
  heroBody?: string | null;
  heroButtons?: GuideButton[];
  processEyebrow?: string | null;
  processHeading?: string | null;
  processBody?: string | null;
  processImage?: string | null;
  processSteps?: GuideStep[];
  processButtons?: GuideButton[];
  workEyebrow?: string | null;
  workHeading?: string | null;
  workBody?: string | null;
  workImage?: string | null;
  workButtons?: GuideButton[];
  materialsEyebrow?: string | null;
  materialsHeading?: string | null;
  materialsIntro?: string | null;
  materials: GuideMaterial[];
  additionalEyebrow?: string | null;
  additionalHeading?: string | null;
  additionalBody?: string | null;
  additionalHelpText?: string | null;
  additionalImage?: string | null;
  additionalButtons: GuideButton[];
  advantagesHeading?: string | null;
  advantagesBody?: string | null;
  advantagesImage?: string | null;
  advantagesButtons?: GuideButton[];
  faqHeading?: string | null;
  faqs: GuideFaq[];
  ctaHeading?: string | null;
  ctaBody?: string | null;
  ctaButtons: GuideButton[];
};

declare global {
  interface Window {
    __SITE_SERVICE_GUIDE__?: ServiceGuidePayload | null;
  }
}

function GuideButtons({
  buttons,
  dark = false,
  align = "center",
}: {
  buttons: GuideButton[];
  dark?: boolean;
  align?: "center" | "start";
}) {
  const { openEstimateModal } = useEstimateModal();

  if (!buttons.length) return null;

  return (
    <div
      className={`mt-10 flex flex-col gap-4 sm:flex-row sm:flex-wrap ${
        align === "center" ? "items-center sm:justify-center" : "items-start sm:justify-start"
      }`}
    >
      {buttons.map((button) => {
        const isEstimate = button.url === "#estimate" || button.url.endsWith("#estimate");
        const className = dark
          ? "btn-magnetic btn-magnetic-inverse inline-flex items-center gap-3 rounded-full border border-cream px-8 py-4 text-xs font-medium tracking-[0.2em] text-cream"
          : "btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-8 py-4 text-xs font-medium tracking-[0.2em] text-cream";

        if (isEstimate) {
          return (
            <button
              key={`${button.label}-${button.url}`}
              type="button"
              onClick={openEstimateModal}
              data-cursor="estimate"
              className={className}
            >
              <span>{button.label}</span>
              <span className="relative z-[2]">→</span>
            </button>
          );
        }

        return (
          <a
            key={`${button.label}-${button.url}`}
            href={button.url}
            data-cursor="view"
            className={className}
          >
            <span>{button.label}</span>
            <span className="relative z-[2]">→</span>
          </a>
        );
      })}
    </div>
  );
}

function hasText(...values: Array<string | null | undefined>) {
  return values.some((value) => Boolean(value && String(value).trim()));
}

export function ServiceGuidePage() {
  const guide = window.__SITE_SERVICE_GUIDE__ ?? null;
  const [openFaq, setOpenFaq] = useState<number | null>(0);
  const [activeMaterial, setActiveMaterial] = useState(0);

  useEffect(() => {
    if (guide?.metaTitle) {
      document.title = guide.metaTitle;
    } else if (guide?.title) {
      document.title = `${guide.title} — Creative Granite & Design`;
    }
  }, [guide]);

  if (!guide) {
    return (
      <SiteLayout>
        <main>
          <Header />
          <section className="mx-auto max-w-[1400px] px-6 py-32 md:px-10">
            <h1 className={sectionHeadingLight}>Page not found</h1>
            <a href="/services" className="link-underline mt-6 inline-block text-sm tracking-[0.2em]">
              Back to services
            </a>
          </section>
          <Footer />
        </main>
      </SiteLayout>
    );
  }

  const heroButtons = guide.heroButtons ?? [];
  const processSteps = guide.processSteps ?? [];
  const processButtons = guide.processButtons ?? [];
  const workButtons = guide.workButtons ?? [];
  const showProcess = hasText(guide.processEyebrow, guide.processHeading, guide.processBody) || processSteps.length > 0;
  const showWork = hasText(guide.workEyebrow, guide.workHeading, guide.workBody) || Boolean(guide.workImage);

  return (
    <SiteLayout>
      <main>
        <Header />

        <section className="relative overflow-hidden bg-cream pb-10 pt-[calc(4.25rem+5rem)] md:pb-14 md:pt-[calc(6.5rem+7rem)]">
          <div className="pointer-events-none absolute inset-0 noise-overlay opacity-60" />
          <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <a href="/services" className="link-underline text-xs tracking-[0.22em] text-foreground/60">
                ← All services
              </a>
              <div className="mt-8 flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">Services</span>
              </div>
              <h1 className={`mt-6 max-w-4xl ${sectionHeadingLight}`}>{guide.title}</h1>
              {guide.heroBody && (
                <p className={`mt-8 max-w-3xl whitespace-pre-line ${bodyCopyLight}`}>{guide.heroBody}</p>
              )}
              <div className="flex justify-start">
                <GuideButtons buttons={heroButtons} align="start" />
              </div>
            </Reveal>
          </div>

          {guide.heroImage && (
            <Reveal delay={120} className="relative mt-12 md:mt-16">
              <div className="aspect-[16/9] w-full overflow-hidden bg-bone md:aspect-[21/9]">
                <img
                  src={guide.heroImage}
                  alt={guide.title}
                  className="h-full w-full object-cover"
                  fetchPriority="high"
                  decoding="async"
                />
              </div>
            </Reveal>
          )}
        </section>

        {showProcess && (
          <section className="relative overflow-hidden bg-ink py-24 text-cream md:py-32">
            <div className="pointer-events-none absolute inset-0 grain opacity-40" />
            <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
              <div className="grid grid-cols-1 items-start gap-12 lg:grid-cols-12 lg:gap-14">
                <Reveal className="lg:col-span-5">
                  <div className="flex items-center gap-3 text-cream/60">
                    <span className="h-px w-12 bg-cream/40" />
                    <span className="eyebrow text-cream/60">{guide.processEyebrow}</span>
                  </div>
                  {guide.processHeading && (
                    <h2 className={`mt-6 max-w-3xl ${sectionHeadingDark}`}>{guide.processHeading}</h2>
                  )}
                  {guide.processBody && (
                    <p className={`mt-8 max-w-2xl whitespace-pre-line ${bodyCopyDark}`}>{guide.processBody}</p>
                  )}
                  {guide.processImage && (
                    <div className="mt-10 aspect-[4/5] overflow-hidden bg-bone md:aspect-[5/6]">
                      <img
                        src={guide.processImage}
                        alt={guide.processHeading || guide.title}
                        className="h-full w-full object-cover"
                        loading="lazy"
                        decoding="async"
                      />
                    </div>
                  )}
                  <div className="flex justify-start">
                    <GuideButtons buttons={processButtons} dark align="start" />
                  </div>
                </Reveal>

                {processSteps.length > 0 && (
                  <div className="space-y-8 lg:col-span-7">
                    {processSteps.map((step, index) => (
                      <Reveal key={`${step.title}-${index}`} delay={Math.min(index * 80, 240)}>
                        <div className="border-t border-cream/15 pt-8">
                          <div className="flex items-baseline gap-4">
                            <span className="font-mono text-xs tracking-[0.2em] text-cream/50">
                              {step.number || String(index + 1).padStart(2, "0")}
                            </span>
                            <h3 className="font-display text-2xl text-cream md:text-3xl">{step.title}</h3>
                          </div>
                          {step.body && (
                            <p className={`mt-4 max-w-2xl ${bodyCopyDark}`}>{step.body}</p>
                          )}
                        </div>
                      </Reveal>
                    ))}
                  </div>
                )}
              </div>
            </div>
          </section>
        )}

        {showWork && (
          <section className="relative bg-cream py-24 md:py-32">
            <div className="pointer-events-none absolute inset-0 noise-overlay opacity-40" />
            <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
              <div className="grid grid-cols-1 items-center gap-10 lg:grid-cols-12 lg:gap-14">
                <Reveal className={guide.workImage ? "lg:col-span-6" : "lg:col-span-10"}>
                  <div className="flex items-center gap-3 text-foreground/60">
                    <span className="h-px w-12 bg-foreground/40" />
                    <span className="eyebrow">{guide.workEyebrow}</span>
                  </div>
                  {guide.workHeading && (
                    <h2 className={`mt-6 max-w-3xl ${sectionHeadingLight}`}>{guide.workHeading}</h2>
                  )}
                  {guide.workBody && (
                    <p className={`mt-8 max-w-2xl ${bodyCopyLight}`}>{guide.workBody}</p>
                  )}
                  <div className="flex justify-start">
                    <GuideButtons buttons={workButtons} align="start" />
                  </div>
                </Reveal>
                {guide.workImage && (
                  <Reveal delay={120} className="lg:col-span-6">
                    <div className="aspect-[4/5] overflow-hidden bg-bone md:aspect-[5/6]">
                      <img
                        src={guide.workImage}
                        alt={guide.workHeading || guide.title}
                        className="h-full w-full object-cover"
                        loading="lazy"
                        decoding="async"
                      />
                    </div>
                  </Reveal>
                )}
              </div>
            </div>
          </section>
        )}

        <section className="relative bg-bone py-24 md:py-32">
          <div className="mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <div className="flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">{guide.materialsEyebrow}</span>
              </div>
              <h2 className={`mt-6 max-w-4xl ${sectionHeadingLight}`}>{guide.materialsHeading}</h2>
              {guide.materialsIntro && (
                <p className={`mt-8 max-w-3xl ${bodyCopyLight}`}>{guide.materialsIntro}</p>
              )}
            </Reveal>

            {guide.materials.length > 0 && (
              <div className="mt-16 grid grid-cols-1 gap-px overflow-hidden rounded-sm bg-foreground/15 md:grid-cols-2">
                {guide.materials.map((material, i) => (
                  <div
                    key={`${material.name}-${i}`}
                    onMouseEnter={() => setActiveMaterial(i)}
                    className={`group relative flex flex-col overflow-hidden bg-cream p-8 transition-colors duration-700 md:p-12 ${
                      activeMaterial === i ? "bg-foreground text-cream" : ""
                    }`}
                  >
                    {material.image && (
                      <div className="img-zoom relative mb-8 aspect-[4/3] w-full overflow-hidden rounded-sm">
                        <img
                          src={material.image}
                          alt={`${material.name} surface`}
                          loading="lazy"
                          decoding="async"
                          className="h-full w-full object-cover"
                        />
                      </div>
                    )}
                    <div className="flex items-start justify-between">
                      <span className="font-mono text-xs opacity-60">
                        {String(i + 1).padStart(2, "0")}
                      </span>
                      <span
                        className={`h-2 w-2 rounded-full transition-all duration-500 ${
                          activeMaterial === i ? "scale-150 bg-accent" : "bg-foreground/30"
                        }`}
                      />
                    </div>
                    <h3 className="mt-6 font-display text-4xl md:text-5xl">{material.name}</h3>
                    <p
                      className={`mt-6 max-w-md leading-relaxed ${
                        activeMaterial === i ? "text-cream/90" : "text-foreground/70"
                      }`}
                    >
                      {material.body}
                    </p>
                  </div>
                ))}
              </div>
            )}
          </div>
        </section>

        <section className="relative overflow-hidden bg-ink py-24 text-cream md:py-32">
          <div className="pointer-events-none absolute inset-0 grain opacity-40" />
          <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
            <div className="grid grid-cols-1 items-center gap-10 lg:grid-cols-12 lg:gap-14">
              <Reveal className="lg:col-span-6">
                <div className="flex items-center gap-3 text-cream/60">
                  <span className="h-px w-12 bg-cream/40" />
                  <span className="eyebrow text-cream/60">{guide.additionalEyebrow}</span>
                </div>
                <h2 className={`mt-6 max-w-3xl ${sectionHeadingDark}`}>{guide.additionalHeading}</h2>
                {guide.additionalBody && (
                  <p className={`mt-8 max-w-2xl ${bodyCopyDark}`}>{guide.additionalBody}</p>
                )}
                {guide.additionalHelpText && (
                  <p className={`mt-6 max-w-2xl ${bodyCopyDark}`}>{guide.additionalHelpText}</p>
                )}
                <div className="flex justify-start">
                  <GuideButtons buttons={guide.additionalButtons} dark align="start" />
                </div>
              </Reveal>
              {guide.additionalImage && (
                <Reveal delay={120} className="lg:col-span-6">
                  <div className="aspect-[4/5] overflow-hidden bg-bone md:aspect-[5/6]">
                    <img
                      src={guide.additionalImage}
                      alt={guide.additionalHeading || guide.title}
                      className="h-full w-full object-cover"
                      loading="lazy"
                      decoding="async"
                    />
                  </div>
                </Reveal>
              )}
            </div>
          </div>
        </section>

        <section className="relative bg-cream py-24 md:py-32">
          <div className="pointer-events-none absolute inset-0 noise-overlay opacity-40" />
          <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
            <div className="grid grid-cols-1 items-center gap-10 lg:grid-cols-12 lg:gap-14">
              {guide.advantagesImage && (
                <Reveal className="order-2 lg:order-1 lg:col-span-5">
                  <div className="overflow-hidden bg-bone">
                    <img
                      src={guide.advantagesImage}
                      alt={guide.advantagesHeading || guide.title}
                      className="h-auto w-full object-cover"
                      loading="lazy"
                      decoding="async"
                    />
                  </div>
                </Reveal>
              )}
              <Reveal className={`order-1 lg:order-2 ${guide.advantagesImage ? "lg:col-span-7" : "lg:col-span-12"}`}>
                <h2 className={`max-w-3xl ${sectionHeadingLight}`}>{guide.advantagesHeading}</h2>
                {guide.advantagesBody && (
                  <p className={`mt-8 max-w-2xl ${bodyCopyLight}`}>{guide.advantagesBody}</p>
                )}
                <div className="flex justify-start">
                  <GuideButtons buttons={guide.advantagesButtons ?? []} align="start" />
                </div>
              </Reveal>
            </div>
          </div>
        </section>

        {guide.faqs.length > 0 && (
          <section className="relative overflow-hidden bg-ink py-24 text-cream md:py-32">
            <div className="pointer-events-none absolute inset-0 grain opacity-40" />
            <div className="relative mx-auto max-w-[1200px] px-6 md:px-10">
              <Reveal>
                <h2 className={`text-center ${sectionHeadingDark}`}>{guide.faqHeading}</h2>
              </Reveal>
              <div className="mt-14 divide-y divide-cream/15 border-y border-cream/15 bg-cream/[0.03]">
                {guide.faqs.map((item, index) => {
                  const open = openFaq === index;
                  return (
                    <Reveal key={`${item.question}-${index}`} delay={Math.min(index * 60, 240)}>
                      <div className={open ? "bg-cream/[0.04]" : ""}>
                        <button
                          type="button"
                          aria-expanded={open}
                          onClick={() => setOpenFaq(open ? null : index)}
                          className="group flex w-full items-start justify-between gap-6 px-5 py-6 text-left md:px-7 md:py-7"
                          data-cursor="view"
                        >
                          <span className="font-display text-xl leading-tight text-cream md:text-2xl">
                            {item.question}
                          </span>
                          <span
                            className={`mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-cream/25 text-2xl leading-none text-cream/80 transition-transform duration-300 ${
                              open ? "rotate-45 border-cream/50 bg-cream/10" : ""
                            }`}
                            style={{ fontFamily: "sans-serif" }}
                            aria-hidden
                          >
                            +
                          </span>
                        </button>
                        <div
                          className={`grid transition-[grid-template-rows] duration-400 ease-out ${
                            open ? "grid-rows-[1fr]" : "grid-rows-[0fr]"
                          }`}
                        >
                          <div className="overflow-hidden">
                            <p className={`max-w-3xl whitespace-pre-line px-5 pb-7 md:px-7 ${bodyCopyDark}`}>{item.answer}</p>
                          </div>
                        </div>
                      </div>
                    </Reveal>
                  );
                })}
              </div>
            </div>
          </section>
        )}

        <section className="relative overflow-hidden bg-cream py-28 md:py-36">
          <div className="pointer-events-none absolute inset-0 noise-overlay" />
          <div className="relative mx-auto max-w-[1400px] px-6 text-center md:px-10">
            <Reveal>
              <h2 className={`mx-auto max-w-4xl ${sectionHeadingLight}`}>{guide.ctaHeading}</h2>
              {guide.ctaBody && (
                <p className={`mx-auto mt-8 max-w-3xl whitespace-pre-line ${bodyCopyLight}`}>
                  {guide.ctaBody}
                </p>
              )}
              <GuideButtons buttons={guide.ctaButtons} />
            </Reveal>
          </div>
        </section>

        <Footer />
      </main>
    </SiteLayout>
  );
}
