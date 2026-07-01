import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

export function WhoWeAre() {
  const { settings } = useSiteContent();
  const section = useSection("who-we-are");
  const image = section.image ?? settings.aboutStoneBath;

  return (
    <section className="relative mx-auto max-w-[1400px] px-6 py-16 md:px-10 md:py-24">
      <Reveal>
        <div className="flex items-center gap-3 text-foreground/60">
          <span className="h-px w-12 bg-foreground/40" />
          <span className="eyebrow">{section.eyebrow}</span>
        </div>
      </Reveal>
      <Reveal delay={100} className="overflow-visible">
        <h2 className={`mt-4 max-w-2xl md:mt-5 ${sectionHeadingLight}`}>
          {section.heading}{" "}
          <span className="font-sans font-light tracking-[-0.02em]">
            {section.highlightText ?? settings.foundedYear}
          </span>
        </h2>
      </Reveal>

      <div className="mt-8 grid grid-cols-1 items-stretch gap-6 md:mt-10 md:grid-cols-2 md:gap-8">
        <div className="group w-full min-w-0">
          <div className="relative min-h-[18rem] w-full overflow-hidden md:min-h-[28rem]">
            <img
              src={image}
              alt="Natural stone powder room with marble vanity crafted by Creative Granite + Design"
              loading="eager"
              decoding="async"
              fetchPriority="low"
              className="absolute inset-0 h-full w-full object-cover transition-transform duration-[1400ms] ease-out group-hover:scale-[1.04]"
            />
          </div>
        </div>

        <Reveal delay={300} className="flex w-full min-w-0 items-center">
          <p className={`w-full ${bodyCopyLight}`}>{section.body}</p>
        </Reveal>
      </div>
    </section>
  );
}
