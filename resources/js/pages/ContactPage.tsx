import { Footer, Header } from "@/components/sections";
import { ContactForm } from "@/components/site/ContactForm";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { SiteLayout } from "@/layouts/SiteLayout";
import { sectionHeadingLight } from "@/utils/typography";

export function ContactPage() {
  const section = useSection("cta");
  const { settings } = useSiteContent();
  const bannerImage = settings.contactBannerImage?.trim() || "";
  const directionsImage = settings.contactDirectionsImage?.trim() || "";

  return (
    <SiteLayout>
      <main className="overflow-x-hidden">
        <Header />
        <section className="relative overflow-hidden pb-28 pt-[calc(4.25rem+7rem)] md:pb-40 md:pt-[calc(6.5rem+10rem)]">
          {bannerImage ? (
            <div className="absolute inset-0">
              <img
                src={bannerImage}
                alt=""
                className="h-full w-full object-cover object-center"
                fetchPriority="high"
                decoding="async"
              />
            </div>
          ) : null}

          <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <div className="mt-6 max-w-3xl bg-cream/55 px-6 py-8 backdrop-blur-[2px] md:px-10 md:py-10">
                <h1 className={sectionHeadingLight}>{section.heading}</h1>
                {section.body && <p className="mt-6 max-w-2xl text-[#2a2622]/85">{section.body}</p>}
              </div>
            </Reveal>
          </div>
        </section>

        <section id="contact" className="relative overflow-hidden bg-cream pb-28 text-[#2a2622] md:pb-40">
          <div className="pointer-events-none absolute inset-0 noise-overlay" />
          <div className="relative mx-auto w-full min-w-0 max-w-[1400px] px-4 sm:px-6 md:px-10">
            <div className="grid min-w-0 grid-cols-1 items-stretch gap-10 border-y border-foreground/10 py-12 md:grid-cols-12 md:gap-10 md:py-20 lg:gap-12">
              <Reveal className="min-w-0 md:col-span-6 md:h-full">
                {directionsImage ? (
                  <div className="relative h-full min-h-[28rem] overflow-hidden sm:min-h-[34rem] md:min-h-0">
                    <img
                      src={directionsImage}
                      alt="Creative Granite showroom and project detail"
                      className="absolute inset-0 h-full w-full object-cover"
                      loading="lazy"
                      decoding="async"
                    />
                  </div>
                ) : null}
              </Reveal>

              <Reveal delay={150} className="min-w-0 w-full md:col-span-6">
                <div className="eyebrow text-[#2a2622]">Visit</div>
                <div className="footer-sans mt-4 space-y-2 font-light text-[#2a2622]">
                  {settings.addressLine1 && <div>{settings.addressLine1}</div>}
                  {settings.addressLine2 && <div>{settings.addressLine2}</div>}
                </div>

                {settings.hours && (
                  <div className="mt-5">
                    <div className="eyebrow text-[#2a2622]">Hours</div>
                    <p className="footer-sans mt-2 font-light leading-relaxed text-[#2a2622]">{settings.hours}</p>
                  </div>
                )}

                <div className="footer-sans mt-5 space-y-2 font-light">
                  {settings.phone && (
                    <div>
                      <a href={`tel:${settings.phone}`} className="footer-sans link-underline font-light text-[#2a2622]">
                        {settings.phone}
                      </a>
                    </div>
                  )}
                  {settings.email && (
                    <div>
                      <a href={`mailto:${settings.email}`} className="footer-sans link-underline font-light text-[#2a2622]">
                        {settings.email}
                      </a>
                    </div>
                  )}
                </div>

                {settings.showroomMapsUrl && (
                  <a
                    href={settings.showroomMapsUrl}
                    target="_blank"
                    rel="noopener noreferrer"
                    data-cursor="view"
                    className="footer-sans link-underline mt-5 inline-block text-sm tracking-[0.2em] text-[#2a2622] transition-colors hover:text-foreground"
                  >
                    Get directions
                  </a>
                )}

                <div className="mt-12 border-t border-foreground/15 pt-10 md:mt-14 md:pt-12">
                  <div className="eyebrow text-[#2a2622]">Send a message</div>
                  <p className="mt-6 max-w-full break-words text-pretty text-[#2a2622]/85 sm:mt-8 md:max-w-md">
                    {settings.contactFormIntro}
                  </p>
                  <a
                    href="#estimate"
                    data-cursor="estimate"
                    className="btn-magnetic mt-6 inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-8 py-4 text-xs font-medium tracking-[0.2em] text-cream"
                  >
                    <span>Get an Estimate</span>
                    <span className="relative z-[2]">→</span>
                  </a>
                  <div className="contact-form-shell mt-8 min-w-0 w-full sm:mt-10">
                    <ContactForm />
                  </div>
                </div>
              </Reveal>
            </div>
          </div>
        </section>
        <Footer />
      </main>
    </SiteLayout>
  );
}
