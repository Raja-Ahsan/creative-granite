import { Reveal } from "@/components/site/Reveal";
import { SplitText } from "@/components/site/SplitText";
import { useSection } from "@/contexts/SiteContentContext";
import { bodyCopyDark, bodyCopyLight, sectionHeadingDark, sectionHeadingLight } from "@/utils/typography";

type HeroIntroProps = {
  overlay?: boolean;
};

export function HeroIntro({ overlay = false }: HeroIntroProps) {
  const section = useSection("hero-intro");

  const content = (
    <div className="mx-auto max-w-[920px]">
      <Reveal>
        <div
          className={`flex items-center justify-center gap-3 ${overlay ? "text-cream/60" : "text-foreground/60"}`}
        >
          {/* <span className={`h-px w-12 ${overlay ? "bg-cream/40" : "bg-foreground/40"}`} /> */}
          {/* <span className="eyebrow tracking-[0.2em]">{section.eyebrow}</span>
          <span className={`h-px w-12 ${overlay ? "bg-cream/40" : "bg-foreground/40"}`} /> */}
        </div>
      </Reveal>

      <h1
        className={`mt-4 md:mt-5 ${overlay ? sectionHeadingDark : sectionHeadingLight} text-[clamp(1.5rem,3.6vw,3rem)] max-w-[720px] mx-auto`}
      >
        <SplitText text={section.heading ?? ""} wrap dense />
      </h1>

      {section.subheading && (
        <Reveal delay={300} className={`mt-4 ${overlay ? bodyCopyDark : bodyCopyLight}`}>
          {section.subheading}
        </Reveal>
      )}

      <Reveal delay={500} className="mt-7 flex justify-center md:mt-8">
        <a
          href="#estimate"
          data-cursor="estimate"
          className={
            overlay
              ? "btn-magnetic btn-magnetic-inverse inline-flex items-center gap-3 rounded-full border border-cream px-8 py-4 text-xs font-medium tracking-[0.2em] text-cream md:px-10 md:py-5"
              : "btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-8 py-4 text-xs font-medium tracking-[0.2em] text-cream md:px-10 md:py-5"
          }
        >
          <span>Get an estimate</span>
          <span className="relative z-[2]">→</span>
        </a>
      </Reveal>
    </div>
  );

  if (overlay) {
    return (
      <div className="w-full px-6 py-10 text-center md:px-10 md:py-14">
        {content}
      </div>
    );
  }

  return (
    <section className="relative bg-cream px-6 py-10 text-center md:px-10 md:py-14">
      {content}
    </section>
  );
}
