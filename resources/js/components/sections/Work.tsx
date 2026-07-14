import { ImageLightbox } from "@/components/site/ImageLightbox";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";
import { useMemo, useState } from "react";

export function Work() {
  const { portfolio } = useSiteContent();
  const section = useSection("work");
  const [lightboxIndex, setLightboxIndex] = useState<number | null>(null);

  const featuredWork = useMemo(
    () => portfolio.filter((item) => item.featured),
    [portfolio],
  );

  return (
    <section id="work" className="relative py-28 md:py-40">
      <div className="mx-auto max-w-[1400px] px-6 md:px-10">
        <div className="flex flex-wrap items-end justify-between gap-6">
          <Reveal>
            <div className="flex items-center gap-3 text-foreground/60">
              <span className="h-px w-12 bg-foreground/40" />
              <span className="eyebrow">{section.eyebrow}</span>
            </div>
            <h2 className={`mt-6 max-w-3xl ${sectionHeadingLight}`}>{section.heading}</h2>
          </Reveal>
          {section.subheading && (
            <Reveal delay={200}>
              <p className={`max-w-sm ${bodyCopyLight}`}>{section.subheading}</p>
            </Reveal>
          )}
        </div>

        {featuredWork.length > 0 && (
          <div className="mt-16 grid grid-cols-2 gap-3 md:grid-cols-3 md:gap-5">
            {featuredWork.map((item, i) => (
              <button
                key={`${item.src}-${i}`}
                type="button"
                onClick={() => setLightboxIndex(i)}
                className="img-zoom group relative aspect-[4/3] h-[200px] w-full overflow-hidden rounded-none bg-bone text-left md:min-h-[500px]"
                data-cursor="view"
                aria-label="View image fullscreen"
              >
                <img
                  src={item.src}
                  alt=""
                  loading="lazy"
                  decoding="async"
                  className="h-full w-full object-cover"
                />
              </button>
            ))}
          </div>
        )}

        <Reveal delay={200} className="mt-12 flex justify-center md:mt-16">
          <a
            href="/gallery"
            data-cursor="view"
            className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream"
          >
            <span>View Gallery</span>
            <span className="relative z-[2]">→</span>
          </a>
        </Reveal>
      </div>

      <ImageLightbox
        images={featuredWork}
        index={lightboxIndex}
        onClose={() => setLightboxIndex(null)}
        onChange={setLightboxIndex}
      />
    </section>
  );
}
