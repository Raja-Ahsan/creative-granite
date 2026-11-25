import { Reveal } from "@/components/site/Reveal";
import { SplitText } from "@/components/site/SplitText";
import { useEstimateModal } from "@/contexts/EstimateModalContext";
import { useSection } from "@/contexts/SiteContentContext";
import { bodyCopyDark, bodyCopyLight, sectionHeadingDark, sectionHeadingLight } from "@/utils/typography";

type HeroIntroProps = {
  overlay?: boolean;
};

export function HeroIntro({ overlay = false }: HeroIntroProps) {
  const section = useSection("hero-intro");
  const { openEstimateModal } = useEstimateModal();

  const buttonLabel = section.buttonLabel || "Get an Estimate";
  const buttonUrl = section.buttonUrl || "#estimate";
  const isEstimate = buttonUrl === "#estimate" || buttonUrl.endsWith("#estimate");

  const buttonClass = overlay
    ? "btn-magnetic btn-magnetic-inverse inline-flex items-center gap-3 rounded-full border border-cream px-8 py-4 text-xs font-medium tracking-[0.2em] text-cream md:px-10 md:py-5"
    : "btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-8 py-4 text-xs font-medium tracking-[0.2em] text-cream md:px-10 md:py-5";

  const content = (
    <div className="mx-auto w-full max-w-[1100px]">
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
        className={`mt-2 md:mt-3 ${overlay ? sectionHeadingDark : sectionHeadingLight} mx-auto max-w-full text-[clamp(1.05rem,2.2vw,2.1rem)] leading-[1.15] tracking-[-0.01em]`}
      >
        {(section.heading ?? "")
          .split(/\n+/)
          .map((line) => line.trim())
          .filter(Boolean)
          .map((line, index) => (
            <span
              key={`${line}-${index}`}
              className="block px-1 [&>span]:!overflow-visible md:whitespace-nowrap"
            >
              <SplitText text={line} wrap dense />
            </span>
          ))}
      </h1>

      {section.subheading && (
        <Reveal delay={300} className={`mt-4 ${overlay ? bodyCopyDark : bodyCopyLight}`}>
          {section.subheading}
        </Reveal>
      )}

      {buttonLabel && (
        <Reveal delay={500} className="mt-7 flex justify-center md:mt-8">
          {isEstimate ? (
            <button
              type="button"
              onClick={openEstimateModal}
              data-cursor="estimate"
              className={buttonClass}
            >
              <span>{buttonLabel}</span>
              <span className="relative z-[2]">→</span>
            </button>
          ) : (
            <a href={buttonUrl} data-cursor="view" className={buttonClass}>
              <span>{buttonLabel}</span>
              <span className="relative z-[2]">→</span>
            </a>
          )}
        </Reveal>
      )}
    </div>
  );

  if (overlay) {
    return (
      <div className="w-full px-5 py-6 text-center sm:px-8 md:px-10 md:py-8">
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
