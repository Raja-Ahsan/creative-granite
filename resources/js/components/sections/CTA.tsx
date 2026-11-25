import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { bodyCopyCta, sectionHeadingLight } from "@/utils/typography";

export function CTA({ showEstimate = true }: { showEstimate?: boolean }) {
  const { settings } = useSiteContent();
  const section = useSection("cta");

  const heading = section.heading || "Start your project";
  const body = section.body || "";
  const buttonLabel = section.buttonLabel || "Get an Estimate";
  const buttonUrl = section.buttonUrl || "#estimate";
  const showroomLabel = section.secondaryButtonLabel || "Visit our showroom";
  const appointmentLabel = section.appointmentLabel || "Or book an appointment";
  const appointmentUrl = section.secondaryButtonUrl || "/contact";

  return (
    <section id="contact" className="relative overflow-hidden bg-cream py-32">
      <div className="pointer-events-none absolute inset-0 noise-overlay" />
      <div className="relative mx-auto max-w-[1400px] px-6 text-center md:px-10">
        <Reveal>
          <h2 className={`mx-auto mt-8 max-w-4xl ${sectionHeadingLight}`}>{heading}</h2>
          {body && <p className={`mx-auto mt-10 max-w-[750px] ${bodyCopyCta}`}>{body}</p>}
          <div className="mt-12 flex flex-col items-center gap-5">
            {showEstimate && buttonLabel && (
              <a
                href={buttonUrl}
                data-cursor="estimate"
                className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream"
              >
                <span>{buttonLabel}</span>
                <span className="relative z-[2]">→</span>
              </a>
            )}

            {settings.showroomMapsUrl && showroomLabel && (
              <a
                href={settings.showroomMapsUrl}
                target="_blank"
                rel="noopener noreferrer"
                data-cursor="view"
                className="link-underline text-sm tracking-[0.2em] text-foreground/70 transition-colors hover:text-foreground"
              >
                {showroomLabel}
              </a>
            )}

            {appointmentLabel && (
              <a
                href={appointmentUrl}
                data-cursor="contact"
                className="link-underline mt-1 text-sm tracking-[0.2em] text-foreground/70 transition-colors hover:text-foreground"
              >
                {appointmentLabel}
              </a>
            )}
          </div>
        </Reveal>
      </div>
    </section>
  );
}
