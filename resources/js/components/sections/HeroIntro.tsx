import { Reveal } from "@/components/site/Reveal";
import { SplitText } from "@/components/site/SplitText";
import { useSection } from "@/contexts/SiteContentContext";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

export function HeroIntro() {
  const section = useSection("hero-intro");

  return (
    <section className="relative bg-cream px-6 py-10 text-center md:px-10 md:py-14">
      <div className="mx-auto max-w-[920px]">
        <Reveal>
          <div className="flex items-center justify-center gap-3 text-foreground/60">
            <span className="h-px w-12 bg-foreground/40" />
            <span className="eyebrow tracking-[0.2em]">{section.eyebrow}</span>
            <span className="h-px w-12 bg-foreground/40" />
          </div>
        </Reveal>

        <h1 className={`mt-4 md:mt-5 ${sectionHeadingLight}`}>
          <SplitText text={section.heading ?? ""} wrap dense />
        </h1>

        {section.subheading && (
          <Reveal delay={300} className={`mt-4 ${bodyCopyLight}`}>
            {section.subheading}
          </Reveal>
        )}

        {section.body && (
          <Reveal delay={400}>
            <p className={`mx-auto mt-5 max-w-2xl md:mt-6 ${bodyCopyLight}`}>{section.body}</p>
          </Reveal>
        )}

        <Reveal delay={500} className="mt-7 flex justify-center md:mt-8">
          <a
            href="#contact"
            data-cursor="estimate"
            className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-8 py-4 text-xs font-medium tracking-[0.2em] text-cream md:px-10 md:py-5"
          >
            <span>Get an estimate</span>
            <span className="relative z-[2]">→</span>
          </a>
        </Reveal>
      </div>
    </section>
  );
}
