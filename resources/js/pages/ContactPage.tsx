import { Footer, Header } from "@/components/sections";
import { ContactForm } from "@/components/site/ContactForm";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { SiteLayout } from "@/layouts/SiteLayout";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

export function ContactPage() {
  const section = useSection("cta");
  const { settings } = useSiteContent();

  return (
    <SiteLayout>
      <main>
        <Header />
        <section className="relative pb-28 pt-[calc(4.25rem+7rem)] md:pb-40 md:pt-[calc(6.5rem+10rem)]">
          <div className="mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <div className="flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">{section.eyebrow}</span>
              </div>
              <h1 className={`mt-6 max-w-3xl ${sectionHeadingLight}`}>{section.heading}</h1>
              {section.body && <p className={`mt-6 max-w-2xl ${bodyCopyLight}`}>{section.body}</p>}
            </Reveal>
          </div>
        </section>

        <section id="contact" className="relative overflow-hidden bg-cream pb-28 md:pb-40">
          <div className="pointer-events-none absolute inset-0 noise-overlay" />
          <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
            <div className="grid grid-cols-12 gap-12 border-y border-foreground/10 py-16 md:gap-16 md:py-20">
              <Reveal className="col-span-12 md:col-span-5">
                <div className="eyebrow text-foreground/50">Visit</div>
                <div className="mt-8 space-y-2 text-foreground/85">
                  {settings.addressLine1 && <div>{settings.addressLine1}</div>}
                  {settings.addressLine2 && <div>{settings.addressLine2}</div>}
                </div>

                {settings.hours && (
                  <div className="mt-10">
                    <div className="eyebrow text-foreground/50">Hours</div>
                    <p className="mt-4 leading-relaxed text-foreground/85">{settings.hours}</p>
                  </div>
                )}

                <div className="footer-sans mt-10 space-y-2">
                  {settings.phone && (
                    <div>
                      <a href={`tel:${settings.phone}`} className="link-underline text-foreground/85">
                        {settings.phone}
                      </a>
                    </div>
                  )}
                  {settings.email && (
                    <div>
                      <a href={`mailto:${settings.email}`} className="link-underline text-foreground/85">
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
                    className="link-underline mt-10 inline-block text-sm tracking-[0.2em] text-foreground/70 transition-colors hover:text-foreground"
                  >
                    Get directions
                  </a>
                )}
              </Reveal>

              <Reveal delay={150} className="col-span-12 md:col-span-6 md:col-start-7">
                <div className="eyebrow text-foreground/50">Send a message</div>
                <p className={`mt-8 max-w-md ${bodyCopyLight}`}>
                  Tell us about your project — we will follow up with next steps, timing, and a path to estimate.
                </p>
                <div className="mt-10">
                  <ContactForm />
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
