import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

export function EdgeProfiles() {
  const { edgeProfiles } = useSiteContent();
  const section = useSection("edge-profiles");

  const profiles = edgeProfiles ?? [];
  const heading = section.heading || "Edge Profiles";
  const eyebrow = section.eyebrow && section.eyebrow !== heading ? section.eyebrow : null;

  if (!profiles.length) return null;

  return (
    <section id="edge-profiles" className="relative bg-cream py-20 md:py-28">
      <div className="pointer-events-none absolute inset-0 noise-overlay opacity-40" />
      <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
        <Reveal>
          {eyebrow && (
            <div className="flex items-center gap-3 text-foreground/60">
              <span className="h-px w-12 bg-foreground/40" />
              <span className="eyebrow">{eyebrow}</span>
            </div>
          )}
          <h2 className={`max-w-4xl ${eyebrow ? "mt-6" : ""} ${sectionHeadingLight}`}>{heading}</h2>
          {section.body && (
            <p className={`mt-8 max-w-3xl ${bodyCopyLight}`}>{section.body}</p>
          )}
        </Reveal>

        <div className="mt-16 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 md:gap-8">
          {profiles.map((profile, index) => {
            const hasSeparateDiagram = Boolean(profile.diagram);

            return (
              <Reveal key={profile.slug} delay={index * 50}>
                <article className="flex h-full flex-col overflow-hidden border border-foreground/10 bg-[#f7f4ef]">
                  <div className="flex flex-1 items-center justify-center bg-[#f7f4ef] p-4 md:p-6">
                    {profile.image ? (
                      <img
                        src={profile.image}
                        alt={`${profile.name} edge profile`}
                        className="max-h-[520px] w-full object-contain"
                        loading="lazy"
                        decoding="async"
                      />
                    ) : (
                      <div className="flex aspect-[4/5] w-full items-center justify-center border border-dashed border-foreground/15">
                        <span className="font-mono text-[10px] tracking-[0.2em] text-foreground/40">
                          Image coming soon
                        </span>
                      </div>
                    )}
                  </div>

                  <div className="border-t border-foreground/10 bg-cream px-6 py-7 md:px-8 md:py-8">
                    <h3 className="font-display text-2xl uppercase tracking-[0.08em] text-[#021E44] md:text-3xl">
                      {profile.name}
                    </h3>
                    {profile.description && (
                      <>
                        <span className="mt-4 block h-px w-12 bg-foreground/20" />
                        <p className="mt-4 text-sm font-light leading-relaxed text-foreground/70 md:text-[15px]">
                          {profile.description}
                        </p>
                      </>
                    )}
                    {hasSeparateDiagram && (
                      <div className="mt-6 max-w-[220px]">
                        <img
                          src={profile.diagram!}
                          alt={`${profile.name} diagram`}
                          className="w-full object-contain"
                          loading="lazy"
                          decoding="async"
                        />
                      </div>
                    )}
                  </div>
                </article>
              </Reveal>
            );
          })}
        </div>
      </div>
    </section>
  );
}
