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

        <div className="mt-12 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 md:gap-4">
          {profiles.map((profile, index) => {
            const hasSeparateDiagram = Boolean(profile.diagram);

            return (
              <Reveal key={profile.slug} delay={index * 50}>
                <article className="flex h-full flex-col overflow-hidden border border-foreground/10 bg-cream">
                  <div className="bg-[#f7f4ef]">
                    {profile.image ? (
                      <img
                        src={profile.image}
                        alt={`${profile.name} edge profile`}
                        className="h-auto w-full object-contain"
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

                  <div className="border-t border-foreground/10 px-4 py-4 md:px-5 md:py-5">
                    <h3 className="font-display text-xl uppercase tracking-[0.08em] text-[#021E44] md:text-2xl">
                      {profile.name}
                    </h3>
                    {profile.description && (
                      <p className="mt-2 text-sm font-light leading-relaxed text-foreground/70">
                        {profile.description}
                      </p>
                    )}
                    {hasSeparateDiagram && (
                      <div className="mt-4 max-w-[180px]">
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

        {section.note && (
          <Reveal delay={80}>
            <div className="mt-12 border-t border-foreground/10 pt-10 md:mt-14 md:pt-12">
              <p className={`max-w-3xl ${bodyCopyLight}`}>{section.note}</p>
            </div>
          </Reveal>
        )}
      </div>
    </section>
  );
}
