import { CTA, Footer, Header, Services } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useSection } from "@/contexts/SiteContentContext";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";
import { SiteLayout } from "@/layouts/SiteLayout";

export function ServicesPage() {
  const section = useSection("services");

  return (
    <SiteLayout>
      <main>
        <Header />
        <section className="relative py-28 md:py-40">
          <div className="mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <div className="flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">{section.eyebrow}</span>
              </div>
              <h1 className={`mt-6 max-w-3xl ${sectionHeadingLight}`}>{section.heading}</h1>
              {section.subheading && (
                <p className={`mt-6 max-w-2xl ${bodyCopyLight}`}>{section.subheading}</p>
              )}
            </Reveal>
          </div>
        </section>
        <Services standalone />
        <CTA />
        <Footer />
      </main>
    </SiteLayout>
  );
}
