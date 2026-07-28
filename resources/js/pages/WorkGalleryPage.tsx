import { useEffect, useMemo, useState } from "react";
import { Footer, Header } from "@/components/sections";
import { ImageLightbox } from "@/components/site/ImageLightbox";
import { Reveal } from "@/components/site/Reveal";
import { findWorkGallery, workGalleryKind } from "@/data/workPage";
import { SiteLayout } from "@/layouts/SiteLayout";
import { useWorkGallerySlug } from "@/router/SiteRouter";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

export function WorkGalleryPage() {
  const slug = useWorkGallerySlug();
  const item = findWorkGallery(slug);
  const kind = slug ? workGalleryKind(slug) : null;
  const [lightboxIndex, setLightboxIndex] = useState<number | null>(null);

  const images = useMemo(() => {
    if (!item) return [];
    return [
      { src: item.cover, title: item.title },
      { src: item.gallery, title: `${item.title} gallery` },
    ];
  }, [item]);

  useEffect(() => {
    if (item) {
      document.title = `${item.title} — Creative Granite & Design`;
    }
  }, [item]);

  if (!item) {
    return (
      <SiteLayout>
        <main>
          <Header />
          <section className="mx-auto max-w-[1400px] px-6 py-32 md:px-10">
            <h1 className={sectionHeadingLight}>Gallery not found</h1>
            <a href="/gallery" className="link-underline mt-6 inline-block text-sm tracking-[0.2em]">
              ← Back to Our Work
            </a>
          </section>
          <Footer />
        </main>
      </SiteLayout>
    );
  }

  return (
    <SiteLayout>
      <main>
        <Header />

        <section className="relative bg-cream pb-20 pt-[calc(4.25rem+5rem)] md:pb-28 md:pt-[calc(6.5rem+7rem)]">
          <div className="mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <a
                href="/gallery"
                className="link-underline text-xs tracking-[0.22em] text-foreground/60"
                data-cursor="view"
              >
                ← All work
              </a>
              <div className="mt-8 flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">{kind === "project" ? "Featured Project" : "Category"}</span>
              </div>
              <h1 className={`mt-6 max-w-4xl ${sectionHeadingLight}`}>{item.title}</h1>
              <p className={`mt-6 max-w-xl ${bodyCopyLight}`}>
                A photo gallery from this {kind === "project" ? "project" : "collection"} — browse
                the images below.
              </p>
            </Reveal>

            <div className="mt-12 space-y-4 md:mt-16 md:space-y-5">
              <Reveal delay={80}>
                <button
                  type="button"
                  onClick={() => setLightboxIndex(0)}
                  className="img-zoom group relative block aspect-[16/10] w-full overflow-hidden bg-bone text-left md:aspect-[21/9]"
                  data-cursor="view"
                  aria-label={`View ${item.title} cover`}
                >
                  <img
                    src={item.cover}
                    alt={item.title}
                    className="h-full w-full object-cover"
                    fetchPriority="high"
                    decoding="async"
                  />
                </button>
              </Reveal>

              <Reveal delay={140}>
                <button
                  type="button"
                  onClick={() => setLightboxIndex(1)}
                  className="img-zoom group relative block w-full overflow-hidden bg-bone text-left"
                  data-cursor="view"
                  aria-label={`View ${item.title} gallery`}
                >
                  <img
                    src={item.gallery}
                    alt={`${item.title} photo gallery`}
                    className="h-auto w-full object-contain"
                    loading="lazy"
                    decoding="async"
                  />
                </button>
              </Reveal>
            </div>
          </div>
        </section>

        <Footer />
      </main>

      <ImageLightbox
        images={images}
        index={lightboxIndex}
        onClose={() => setLightboxIndex(null)}
        onChange={setLightboxIndex}
      />
    </SiteLayout>
  );
}
