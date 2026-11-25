import { ImageLightbox } from "@/components/site/ImageLightbox";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { bodyCopyLight } from "@/utils/typography";
import { useMemo, useState } from "react";

export function Work() {
  const { portfolio } = useSiteContent();
  const section = useSection("work");
  const [lightboxIndex, setLightboxIndex] = useState<number | null>(null);

  const featuredWork = useMemo(
    () => portfolio.filter((item) => item.featured),
    [portfolio],
  );

  // Home collage uses 5 tiles: 3 portrait on top, 2 landscape below (desktop/laptop).
  const homeGallery = useMemo(() => featuredWork.slice(0, 5), [featuredWork]);

  // Keep each sentence on its own line (break after ".") on mobile and desktop.
  const headingLines = useMemo(
    () =>
      (section.heading ?? "")
        .split(/(?<=\.)\s+/)
        .map((line) => line.trim())
        .filter(Boolean),
    [section.heading],
  );

  return (
    <section id="work" className="relative py-28 md:py-40">
      <div className="mx-auto max-w-[1400px] px-6 md:px-10">
        <Reveal>
          <div className="flex items-center gap-3 text-foreground/60">
            <span className="h-px w-12 bg-foreground/40" />
            <span className="eyebrow">{section.eyebrow}</span>
          </div>
        </Reveal>

        <div className="mt-6 grid grid-cols-1 items-start gap-8 md:grid-cols-12 md:gap-10 lg:gap-14">
          <Reveal className="md:col-span-7">
            <h2 className="max-w-3xl font-display uppercase leading-[0.95] tracking-[-0.02em] text-black text-[clamp(1.2rem,4.6vw,3.75rem)]">
              {headingLines.map((line, index) => (
                <span key={`${line}-${index}`} className="block">
                  {line}
                </span>
              ))}
            </h2>
          </Reveal>
          {section.subheading && (
            <Reveal delay={200} className="md:col-span-5 md:pt-1">
              <p className={`max-w-md md:ml-auto ${bodyCopyLight}`}>{section.subheading}</p>
            </Reveal>
          )}
        </div>

        {homeGallery.length > 0 && (
          <div className="mt-16 grid grid-cols-2 gap-2 md:grid-cols-6 md:gap-3 lg:gap-4">
            {homeGallery.map((item, i) => {
              // Desktop/laptop: 3 tall on top, 2 wide below. Mobile: simple 2-column grid.
              const desktopSpan =
                i < 3
                  ? "md:col-span-2 md:aspect-[3/4] md:min-h-[380px] lg:min-h-[460px]"
                  : "md:col-span-3 md:aspect-[16/10] md:min-h-[240px] lg:min-h-[300px]";
              const mobileSpan = i === 4 ? "col-span-2 md:col-span-3" : "";

              return (
                <button
                  key={`${item.src}-${i}`}
                  type="button"
                  onClick={() => setLightboxIndex(i)}
                  className={`img-zoom group relative aspect-[4/3] h-[200px] w-full overflow-hidden rounded-none bg-bone text-left md:h-auto ${desktopSpan} ${mobileSpan}`}
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
              );
            })}
          </div>
        )}

        <Reveal delay={200} className="mt-12 flex justify-center md:mt-16">
          <a
            href="/work"
            data-cursor="view"
            className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-transparent px-10 py-5 text-xs font-medium tracking-[0.25em] text-foreground"
          >
            <span>View Our Work</span>
            <span className="relative z-[2]">→</span>
          </a>
        </Reveal>
      </div>

      <ImageLightbox
        images={homeGallery}
        index={lightboxIndex}
        onClose={() => setLightboxIndex(null)}
        onChange={setLightboxIndex}
      />
    </section>
  );
}
