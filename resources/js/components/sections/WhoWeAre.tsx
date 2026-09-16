import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

export function WhoWeAre() {
  const { settings } = useSiteContent();
  const section = useSection("who-we-are");
  const image = section.image ?? settings.aboutStoneBath;
  const founded = section.highlightText ?? settings.foundedYear;

  return (
    <section id="who-we-are" className="relative overflow-hidden bg-cream">
      <div className="pointer-events-none absolute inset-0 noise-overlay opacity-30" />
      <div className="relative mx-auto max-w-[1400px] px-6 py-20 md:px-10 md:py-28 lg:py-32">
        <div className="grid grid-cols-1 items-center gap-10 md:gap-12 lg:grid-cols-12 lg:gap-16">
          <Reveal className="order-2 lg:order-1 lg:col-span-5">
            <div className="group relative overflow-hidden bg-bone">
              <img
                src={image}
                alt="Natural stone powder room with marble vanity crafted by Creative Granite + Design"
                loading="eager"
                decoding="async"
                fetchPriority="low"
                className="block h-auto w-full max-w-full object-contain transition-transform duration-[1400ms] ease-out group-hover:scale-[1.02]"
              />
            </div>
          </Reveal>

          <div className="order-1 flex flex-col justify-center lg:order-2 lg:col-span-7">
            <Reveal>
              <div className="flex items-center gap-3 text-black/55">
                <span className="h-px w-12 bg-black/35" />
                <span className="eyebrow text-black/55">{section.eyebrow}</span>
              </div>
            </Reveal>

            <Reveal delay={80}>
              <h2 className={`mt-5 max-w-xl md:mt-6 ${sectionHeadingLight}`}>
                {section.heading}{" "}
                <span className="font-heading font-normal tracking-[-0.005em] text-black">
                  {founded}
                </span>
              </h2>
            </Reveal>

            <Reveal delay={140}>
              <div className="mt-8 h-px w-16 bg-black/20 md:mt-10" />
            </Reveal>

            <Reveal delay={180} className="order-3 mt-8 md:mt-10 lg:order-none">
              <p className={`max-w-xl text-pretty leading-relaxed md:leading-7 ${bodyCopyLight}`}>
                {section.body}
              </p>
            </Reveal>

            {founded && (
              <Reveal delay={220}>
                <p className="mt-8 text-[11px] font-medium uppercase tracking-[0.28em] text-black/45 md:mt-10">
                  Est. {founded}
                </p>
              </Reveal>
            )}
          </div>
        </div>
      </div>
    </section>
  );
}
