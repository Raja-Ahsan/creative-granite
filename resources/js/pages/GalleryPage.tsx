import { Footer, Header } from "@/components/sections";
import { ImageLightbox } from "@/components/site/ImageLightbox";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";
import { SiteLayout } from "@/layouts/SiteLayout";
import { useState } from "react";

export function GalleryPage() {
  const { portfolio } = useSiteContent();
  const section = useSection("work");
  const [lightboxIndex, setLightboxIndex] = useState<number | null>(null);

  return (
    <SiteLayout>
      <main>
        <Header />
        <section className="relative pb-28 pt-[calc(4.25rem+7rem)] md:pb-40 md:pt-[calc(6.5rem+10rem)]">
          <div className="mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <div className="flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">{section.eyebrow || "Gallery"}</span>
              </div>
              <h1 className={`mt-6 max-w-3xl ${sectionHeadingLight}`}>
                {section.heading || "Our Work"}
              </h1>
              {(section.subheading || section.body) && (
                <p className={`mt-6 max-w-2xl ${bodyCopyLight}`}>
                  {section.subheading || section.body}
                </p>
              )}
            </Reveal>

            {portfolio.length > 0 ? (
              <div className="mt-16 grid grid-cols-2 gap-3 md:grid-cols-3 md:gap-5">
                {portfolio.map((item, i) => (
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
            ) : (
              <p className={`mt-16 max-w-xl ${bodyCopyLight}`}>
                Gallery images will appear here once added in the admin Our Work Gallery.
              </p>
            )}

            <Reveal delay={200} className="mt-12 flex justify-center md:mt-16">
              <a
                href="#estimate"
                data-cursor="estimate"
                className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream"
              >
                <span>Get an Estimate</span>
                <span className="relative z-[2]">→</span>
              </a>
            </Reveal>
          </div>
        </section>
        <Footer />
      </main>

      <ImageLightbox
        images={portfolio}
        index={lightboxIndex}
        onClose={() => setLightboxIndex(null)}
        onChange={setLightboxIndex}
      />
    </SiteLayout>
  );
}
