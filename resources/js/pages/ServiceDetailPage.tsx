import { useEffect, useMemo } from "react";
import { CTA, Footer, Header } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useSiteContent } from "@/contexts/SiteContentContext";
import { useServiceSlug } from "@/router/SiteRouter";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";
import { isDuplicateExcerpt, prepareServiceBody } from "@/utils/serviceContent";
import { SiteLayout } from "@/layouts/SiteLayout";

export function ServiceDetailPage() {
  const slug = useServiceSlug();
  const { services } = useSiteContent();
  const service = services.find((item) => item.slug === slug);

  const showExcerpt = useMemo(
    () => (service?.excerpt ? !isDuplicateExcerpt(service.excerpt, service.body) : false),
    [service],
  );

  const bodyHtml = useMemo(
    () =>
      service
        ? prepareServiceBody(service.body, service.title, service.excerpt, service.mainImage)
        : "",
    [service],
  );

  useEffect(() => {
    if (service) {
      document.title = `${service.title} — Creative Granite & Design`;
    }
  }, [service]);

  if (!service) {
    return (
      <SiteLayout>
        <main>
          <Header />
          <section className="mx-auto max-w-[1400px] px-6 py-32 md:px-10">
            <h1 className={sectionHeadingLight}>Service not found</h1>
            <a href="/services" className="link-underline mt-6 inline-block text-sm tracking-[0.2em]">
              Back to services
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

        <section className="relative bg-cream pt-[calc(4.25rem+7rem)] md:pt-[calc(6.5rem+10rem)]">
          <div className="pointer-events-none absolute inset-0 noise-overlay opacity-50" />
          <div className="relative mx-auto max-w-[1400px] px-6 pb-12 md:px-10 md:pb-16">
            <Reveal>
              <a href="/services" className="link-underline text-xs tracking-[0.22em] text-foreground/60">
                ← All services
              </a>
              <div className="mt-8 flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">Service</span>
              </div>
              <h1 className={`mt-6 max-w-4xl scroll-mt-32 ${sectionHeadingLight}`}>{service.title}</h1>
              {showExcerpt && (
                <p className={`mt-6 max-w-2xl text-xl font-light leading-relaxed md:text-2xl ${bodyCopyLight}`}>
                  {service.excerpt}
                </p>
              )}
            </Reveal>
          </div>
        </section>

        {service.mainImage && (
          <Reveal className="bg-cream py-12 md:py-16">
            <div className="mx-auto max-w-[1400px] px-6 md:px-10">
              <div className="aspect-[21/9] overflow-hidden rounded-sm bg-bone">
                <img
                  src={service.mainImage}
                  alt={service.title}
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
            {bodyHtml ? (
              <Reveal>
                <article className="service-prose" dangerouslySetInnerHTML={{ __html: bodyHtml }} />
              </Reveal>
            ) : (
              <Reveal>
                <p className={`${bodyCopyLight} text-lg`}>
                  Full details for this service are coming soon. Contact us to discuss your project.
                </p>
              </Reveal>
            )}

            <Reveal delay={150} className="mt-16 flex flex-col gap-4 border-t border-foreground/10 pt-10 sm:flex-row sm:items-center sm:justify-between">
              <p className="text-sm font-light text-foreground/65" style={{ fontFamily: "Inter, sans-serif" }}>
                Ready to start your {service.title.toLowerCase()} project?
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
