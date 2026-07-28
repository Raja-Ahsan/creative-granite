import { useEffect, useMemo, useState } from "react";
import { Footer, Header } from "@/components/sections";
import { ImageLightbox } from "@/components/site/ImageLightbox";
import { PhotoMasonryCollage } from "@/components/site/PhotoMasonryCollage";
import { Reveal } from "@/components/site/Reveal";
import { useSiteContent } from "@/contexts/SiteContentContext";
import { SiteLayout } from "@/layouts/SiteLayout";
import { useWorkGallerySlug } from "@/router/SiteRouter";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

export function WorkGalleryPage() {
  const slug = useWorkGallerySlug();
  const { galleryAlbums } = useSiteContent();
  const [lightboxIndex, setLightboxIndex] = useState<number | null>(null);

  const item = useMemo(
    () => galleryAlbums.find((album) => album.slug === slug),
    [galleryAlbums, slug],
  );

  const collageImages = useMemo(() => {
    if (!item) return [];
    if (item.images?.length) return item.images;
    return item.gallery ? [item.gallery] : [];
  }, [item]);

  const collageTiles = useMemo(
    () =>
      collageImages.map((src, i) => ({
        src,
        alt: item ? `${item.title} ${i + 1}` : `Gallery ${i + 1}`,
      })),
    [collageImages, item],
  );

  const lightboxImages = useMemo(() => {
    if (!item) return [];
    return [
      { src: item.cover, title: item.title },
      ...collageImages.map((src, i) => ({
        src,
        title: `${item.title} ${i + 1}`,
      })),
    ];
  }, [item, collageImages]);

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

  const isProject = item.kind === "project";

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
                <span className="eyebrow">{isProject ? "Featured Project" : "Category"}</span>
              </div>
              <h1 className={`mt-6 max-w-4xl ${sectionHeadingLight}`}>{item.title}</h1>
              <p className={`mt-6 max-w-xl ${bodyCopyLight}`}>
                A photo gallery from this {isProject ? "project" : "collection"} — browse the images
                below.
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

              {collageTiles.length > 0 && (
                <Reveal delay={140}>
                  <PhotoMasonryCollage
                    images={collageTiles}
                    limit={12}
                    onImageClick={(index) => setLightboxIndex(index + 1)}
                  />
                </Reveal>
              )}
            </div>
          </div>
        </section>

        <Footer />
      </main>

      <ImageLightbox
        images={lightboxImages}
        index={lightboxIndex}
        onClose={() => setLightboxIndex(null)}
        onChange={setLightboxIndex}
      />
    </SiteLayout>
  );
}
