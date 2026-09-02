import { useCallback, useEffect, useMemo, useState } from "react";
import { CTA, Footer, Header } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useSiteContent } from "@/contexts/SiteContentContext";
import { SiteLayout } from "@/layouts/SiteLayout";
import { materialDetailHref, useMaterialSlug } from "@/router/SiteRouter";
import type { Material } from "@/types/content";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

type GalleryImage = { src: string; alt: string };

function materialGallery(material: Material): GalleryImage[] {
  if (material.images && material.images.length > 0) {
    return material.images;
  }

  if (material.image) {
    return [{ src: material.image, alt: material.name }];
  }

  return [];
}

function useMaterial() {
  const slug = useMaterialSlug();
  const { materials } = useSiteContent();

  return useMemo(() => {
    const match = materials.find((item) => item.slug === slug) ?? null;
    if (match?.isCallout) return null;
    return match;
  }, [materials, slug]);
}

function GalleryLightbox({
  images,
  index,
  onClose,
  onChange,
}: {
  images: GalleryImage[];
  index: number;
  onClose: () => void;
  onChange: (index: number) => void;
}) {
  const image = images[index];

  useEffect(() => {
    const onKey = (event: KeyboardEvent) => {
      if (event.key === "Escape") onClose();
      if (event.key === "ArrowRight") onChange((index + 1) % images.length);
      if (event.key === "ArrowLeft") onChange((index - 1 + images.length) % images.length);
    };

    document.body.style.overflow = "hidden";
    window.addEventListener("keydown", onKey);
    return () => {
      document.body.style.overflow = "";
      window.removeEventListener("keydown", onKey);
    };
  }, [images.length, index, onChange, onClose]);

  if (!image) return null;

  return (
    <div
      className="fixed inset-0 z-[80] flex items-center justify-center bg-ink/92 px-4 py-8 backdrop-blur-sm"
      role="dialog"
      aria-modal="true"
      aria-label="Material gallery lightbox"
      onClick={onClose}
    >
      <button
        type="button"
        onClick={onClose}
        className="absolute right-5 top-5 text-xs uppercase tracking-[0.22em] text-cream/70 transition hover:text-cream md:right-8 md:top-8"
      >
        Close ✕
      </button>

      <button
        type="button"
        aria-label="Previous image"
        onClick={(event) => {
          event.stopPropagation();
          onChange((index - 1 + images.length) % images.length);
        }}
        className="absolute left-3 top-1/2 z-[2] -translate-y-1/2 rounded-full border border-cream/25 px-3 py-4 text-cream/80 transition hover:border-cream/50 hover:text-cream md:left-8"
      >
        ←
      </button>

      <button
        type="button"
        aria-label="Next image"
        onClick={(event) => {
          event.stopPropagation();
          onChange((index + 1) % images.length);
        }}
        className="absolute right-3 top-1/2 z-[2] -translate-y-1/2 rounded-full border border-cream/25 px-3 py-4 text-cream/80 transition hover:border-cream/50 hover:text-cream md:right-8"
      >
        →
      </button>

      <div className="relative w-full max-w-6xl" onClick={(event) => event.stopPropagation()}>
        <div className="overflow-hidden bg-ink">
          <img
            key={image.src}
            src={image.src}
            alt={image.alt}
            className="mx-auto max-h-[78vh] w-full object-contain"
          />
        </div>
        <div className="mt-4 flex items-center justify-between gap-4 text-cream/70">
          <p className="text-sm font-light tracking-[0.04em]">{image.alt}</p>
          <p className="font-mono text-xs tracking-[0.18em]">
            {String(index + 1).padStart(2, "0")} / {String(images.length).padStart(2, "0")}
          </p>
        </div>
      </div>
    </div>
  );
}

export function MaterialDetailPage() {
  const material = useMaterial();
  const slug = useMaterialSlug();
  const { materials } = useSiteContent();
  const gallery = material ? materialGallery(material) : [];
  const [activeIndex, setActiveIndex] = useState(0);
  const [lightboxOpen, setLightboxOpen] = useState(false);
  const activeImage = gallery[activeIndex] ?? gallery[0];

  const whyChooseHeading =
    material?.whyChooseHeading?.trim() ||
    (material ? `Why choose ${material.name.toLowerCase()}` : "");

  const primaryMaterials = useMemo(
    () =>
      materials
        .filter((item) => !item.isCallout)
        .sort((a, b) => (a.sortOrder ?? 99) - (b.sortOrder ?? 99)),
    [materials],
  );

  const otherMaterials = useMemo(
    () => primaryMaterials.filter((item) => item.slug !== slug),
    [primaryMaterials, slug],
  );

  const materialIndex = useMemo(() => {
    const index = primaryMaterials.findIndex((item) => item.slug === slug);
    return index >= 0 ? index + 1 : 1;
  }, [primaryMaterials, slug]);

  const goPrev = useCallback(() => {
    if (gallery.length < 2) return;
    setActiveIndex((current) => (current - 1 + gallery.length) % gallery.length);
  }, [gallery.length]);

  const goNext = useCallback(() => {
    if (gallery.length < 2) return;
    setActiveIndex((current) => (current + 1) % gallery.length);
  }, [gallery.length]);

  useEffect(() => {
    setActiveIndex(0);
    setLightboxOpen(false);
  }, [slug]);

  useEffect(() => {
    const match = materials.find((item) => item.slug === slug);
    if (match?.isCallout) window.location.replace("/#materials");
  }, [materials, slug]);

  useEffect(() => {
    if (material) document.title = `${material.name} — Creative Granite & Design`;
  }, [material]);

  useEffect(() => {
    if (lightboxOpen || gallery.length < 2) return;
    const onKey = (event: KeyboardEvent) => {
      if (event.key === "ArrowRight") goNext();
      if (event.key === "ArrowLeft") goPrev();
    };
    window.addEventListener("keydown", onKey);
    return () => window.removeEventListener("keydown", onKey);
  }, [gallery.length, goNext, goPrev, lightboxOpen]);

  if (!material) {
    return (
      <SiteLayout>
        <main>
          <Header />
          <section className="mx-auto max-w-[1400px] px-6 py-32 md:px-10">
            <h1 className={sectionHeadingLight}>Material not found</h1>
            <a href="/#materials" className="link-underline mt-6 inline-block text-sm tracking-[0.2em]">
              Back to materials
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

        {/* Editorial header — no banner image */}
        <section className="relative overflow-hidden bg-cream pt-[calc(4.25rem+5rem)] md:pt-[calc(6.5rem+7rem)]">
          <div className="pointer-events-none absolute inset-0 noise-overlay opacity-45" />
          <div className="relative mx-auto max-w-[1400px] px-6 pb-14 md:px-10 md:pb-20">
            <Reveal>
              <div className="flex flex-wrap items-start justify-between gap-6">
                <a href="/#materials" className="link-underline text-xs tracking-[0.22em] text-foreground/60">
                  ← All materials
                </a>
                <div className="text-right">
                  <p className="font-mono text-[10px] tracking-[0.2em] text-foreground/45">Primary surface</p>
                  <p className="mt-1 font-mono text-xs tracking-[0.18em] text-foreground/70">
                    {String(materialIndex).padStart(2, "0")} / {String(primaryMaterials.length).padStart(2, "0")}
                  </p>
                </div>
              </div>

              <div className="mt-10 grid gap-10 lg:grid-cols-12 lg:items-end lg:gap-16">
                <div className="lg:col-span-7">
                  <div className="flex items-center gap-3 text-foreground/60">
                    <span className="h-px w-12 bg-foreground/40" />
                    <span className="eyebrow">Material</span>
                  </div>
                  {material.tagline && (
                    <p className="mt-6 text-sm font-medium uppercase tracking-[0.18em] text-foreground/55">
                      {material.tagline}
                    </p>
                  )}
                  <h1 className={`mt-4 ${sectionHeadingLight}`}>{material.name}</h1>
                </div>
                <div className="lg:col-span-5">
                  {material.intro && (
                    <p className={`text-base font-light leading-relaxed md:text-lg ${bodyCopyLight}`}>
                      {material.intro}
                    </p>
                  )}
                  <div className="mt-8 flex flex-wrap gap-3">
                    <a
                      href="#gallery"
                      className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-6 py-3 text-xs font-medium tracking-[0.2em] text-cream"
                    >
                      View gallery
                      <span aria-hidden="true">↓</span>
                    </a>
                    {material.careGuideUrl && (
                      <a
                        href={material.careGuideUrl}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="inline-flex items-center gap-3 rounded-full border border-foreground/20 px-6 py-3 text-xs font-medium tracking-[0.2em] text-foreground transition hover:border-foreground/40"
                      >
                        Care guide
                      </a>
                    )}
                  </div>
                </div>
              </div>
            </Reveal>
          </div>
        </section>

        {/* Bento gallery */}
        <section id="gallery" className="relative scroll-mt-28 border-t border-foreground/10 bg-bone pb-20 md:scroll-mt-36 md:pb-28">
          <div className="mx-auto max-w-[1400px] px-6 pt-14 md:px-10 md:pt-20">
            <Reveal>
              <div className="flex flex-wrap items-end justify-between gap-8">
                <div className="max-w-xl">
                  <div className="flex items-center gap-3 text-foreground/60">
                    <span className="h-px w-12 bg-foreground/40" />
                    <span className="eyebrow">In detail</span>
                  </div>
                  <h2 className="mt-5 font-display text-3xl uppercase tracking-[-0.02em] text-[#021E44] md:text-5xl">
                    Material gallery
                  </h2>
                </div>
                <p className="max-w-sm text-sm font-light leading-relaxed text-foreground/55 md:text-right">
                  {activeImage?.alt || `Explore ${material.name} slab detail and finished applications.`}
                </p>
              </div>
            </Reveal>

            {gallery.length > 0 && (
              <Reveal delay={80} className="mt-12">
                <div className="grid grid-cols-2 gap-3 md:gap-4 lg:grid-cols-4 lg:grid-rows-2 lg:h-[640px] lg:gap-5">
                  {gallery.map((image, index) => {
                    const isFeature = index === 0;
                    const isWide = index === 3;
                    const isActive = activeIndex === index;

                    return (
                      <button
                        key={`${image.src}-${index}`}
                        type="button"
                        onClick={() => {
                          setActiveIndex(index);
                          setLightboxOpen(true);
                        }}
                        onMouseEnter={() => setActiveIndex(index)}
                        data-cursor="view"
                        className={`group relative overflow-hidden bg-cream text-left transition-all duration-500 ${
                          isFeature
                            ? "col-span-2 aspect-[4/3] lg:col-span-2 lg:row-span-2 lg:aspect-auto lg:h-full"
                            : isWide
                              ? "col-span-2 aspect-[16/10] lg:col-span-2 lg:aspect-auto lg:h-full"
                              : "aspect-[4/3] lg:aspect-auto lg:h-full"
                        } ${isActive ? "ring-2 ring-foreground/20 ring-offset-2 ring-offset-bone" : ""}`}
                        aria-label={`Open gallery image ${index + 1}`}
                      >
                        <img
                          src={image.src}
                          alt={image.alt || `${material.name} ${index + 1}`}
                          className="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.05]"
                          loading={index === 0 ? "eager" : "lazy"}
                          decoding="async"
                        />
                        <div className="absolute inset-0 bg-gradient-to-t from-ink/75 via-ink/10 to-transparent opacity-80 transition-opacity duration-500 group-hover:opacity-95" />
                        <div className="absolute inset-x-0 bottom-0 flex items-end justify-between gap-3 p-4 md:p-5">
                          <div>
                            <p className="font-mono text-[10px] tracking-[0.2em] text-cream/70">
                              {String(index + 1).padStart(2, "0")}
                            </p>
                            <p
                              className={`mt-2 text-[10px] uppercase tracking-[0.16em] text-cream/90 transition-all duration-500 md:text-xs ${
                                isFeature || isActive
                                  ? "translate-y-0 opacity-100"
                                  : "translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100"
                              }`}
                            >
                              {image.alt || `${material.name} view`}
                            </p>
                          </div>
                          <span className="mb-0.5 text-[10px] uppercase tracking-[0.2em] text-cream/75 opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                            Expand
                          </span>
                        </div>
                      </button>
                    );
                  })}
                </div>

                <div className="mt-6 flex flex-wrap items-center justify-between gap-4 border-t border-foreground/10 pt-6">
                  <p className="font-mono text-xs tracking-[0.18em] text-foreground/45">
                    {String(activeIndex + 1).padStart(2, "0")} / {String(gallery.length).padStart(2, "0")} selected
                  </p>
                  <div className="flex items-center gap-3">
                    <button
                      type="button"
                      onClick={goPrev}
                      disabled={gallery.length < 2}
                      className="text-xs uppercase tracking-[0.2em] text-foreground/55 transition hover:text-foreground disabled:opacity-30"
                    >
                      ← Prev
                    </button>
                    <span className="text-foreground/25">/</span>
                    <button
                      type="button"
                      onClick={goNext}
                      disabled={gallery.length < 2}
                      className="text-xs uppercase tracking-[0.2em] text-foreground/55 transition hover:text-foreground disabled:opacity-30"
                    >
                      Next →
                    </button>
                    <button
                      type="button"
                      onClick={() => setLightboxOpen(true)}
                      className="ml-2 inline-flex items-center gap-2 border-b border-foreground/25 pb-0.5 text-xs uppercase tracking-[0.2em] text-foreground transition hover:border-foreground"
                    >
                      View fullscreen
                    </button>
                  </div>
                </div>
              </Reveal>
            )}
          </div>
        </section>

        {/* Details */}
        <section className="relative overflow-hidden border-t border-foreground/10 bg-cream">
          <div className="pointer-events-none absolute inset-0 noise-overlay opacity-40" />
          <div className="relative mx-auto max-w-[1400px] px-6 py-20 md:px-10 md:py-28">
            <div className="grid gap-16 lg:grid-cols-12 lg:gap-20">
              {(material.whyChoose?.length ?? 0) > 0 && (
                <Reveal className="lg:col-span-7">
                  <div className="flex items-center gap-3 text-foreground/60">
                    <span className="h-px w-12 bg-foreground/40" />
                    <span className="eyebrow">{whyChooseHeading}</span>
                  </div>
                  <ul className="mt-12">
                    {material.whyChoose?.map((point, index) => (
                      <li
                        key={point}
                        className="group grid grid-cols-[3rem_1fr] gap-4 border-t border-foreground/10 py-6 last:border-b md:grid-cols-[4.5rem_1fr] md:gap-8 md:py-7"
                      >
                        <span className="font-mono text-xs tracking-[0.18em] text-foreground/35 transition group-hover:text-accent">
                          {String(index + 1).padStart(2, "0")}
                        </span>
                        <span className="text-base font-light leading-relaxed text-foreground/80 transition group-hover:text-foreground md:text-lg">
                          {point}
                        </span>
                      </li>
                    ))}
                  </ul>
                </Reveal>
              )}

              <Reveal delay={100} className="lg:col-span-5">
                <div className="lg:sticky lg:top-32">
                  {material.whatToKnow && (
                    <div className="border-l-2 border-accent/70 pl-6 md:pl-8">
                      <p className="eyebrow text-foreground/50">What to know</p>
                      <p className={`mt-5 text-base leading-relaxed ${bodyCopyLight}`}>{material.whatToKnow}</p>
                    </div>
                  )}

                  {material.bestFor && (
                    <div className="mt-12 overflow-hidden bg-ink px-7 py-8 text-cream md:px-9 md:py-10">
                      <p className="eyebrow text-cream/50">Best for</p>
                      <p className="mt-5 text-sm font-light leading-relaxed text-cream/85 md:text-base">
                        {material.bestFor}
                      </p>
                    </div>
                  )}

                  {material.careGuideUrl && material.careGuideLabel && (
                    <a
                      href={material.careGuideUrl}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="mt-8 inline-flex w-full items-center justify-between gap-4 border border-foreground/15 bg-bone px-5 py-4 text-sm font-medium uppercase tracking-[0.16em] text-foreground transition hover:border-foreground/35"
                    >
                      <span>{material.careGuideLabel}</span>
                      <span aria-hidden="true">→</span>
                    </a>
                  )}
                </div>
              </Reveal>
            </div>
          </div>
        </section>

        {/* Other materials */}
        {otherMaterials.length > 0 && (
          <section className="border-t border-foreground/10 bg-bone py-16 md:py-24">
            <div className="mx-auto max-w-[1400px] px-6 md:px-10">
              <Reveal>
                <div className="flex flex-wrap items-end justify-between gap-6">
                  <div>
                    <div className="flex items-center gap-3 text-foreground/60">
                      <span className="h-px w-12 bg-foreground/40" />
                      <span className="eyebrow">Continue exploring</span>
                    </div>
                    <h2 className="mt-5 font-display text-3xl uppercase tracking-[-0.02em] text-[#021E44] md:text-4xl">
                      Other primary materials
                    </h2>
                  </div>
                  <a href="/#materials" className="link-underline text-xs tracking-[0.2em] text-foreground/60">
                    View all materials
                  </a>
                </div>
              </Reveal>

              <div className="mt-12 grid grid-cols-1 gap-5 sm:grid-cols-3">
                {otherMaterials.map((item, index) => (
                  <Reveal key={item.slug} delay={index * 70}>
                    <a
                      href={materialDetailHref(item.slug)}
                      data-cursor="view"
                      className="group relative block overflow-hidden bg-cream"
                    >
                      <div className="aspect-[4/5] overflow-hidden">
                        <img
                          src={item.image}
                          alt={item.name}
                          className="h-full w-full object-cover transition-transform duration-700 group-hover:scale-[1.06]"
                          loading="lazy"
                          decoding="async"
                        />
                      </div>
                      <div className="absolute inset-0 bg-gradient-to-t from-ink/80 via-ink/10 to-transparent" />
                      <div className="absolute inset-x-0 bottom-0 p-5 md:p-6">
                        <p className="font-mono text-[10px] tracking-[0.18em] text-cream/60">
                          {String(index + 1).padStart(2, "0")}
                        </p>
                        <h3 className="mt-2 font-display text-2xl uppercase tracking-[-0.02em] text-cream md:text-3xl">
                          {item.name}
                        </h3>
                        <p className="mt-3 flex items-center gap-2 text-[10px] uppercase tracking-[0.2em] text-cream/75 opacity-0 transition-all duration-500 group-hover:translate-x-1 group-hover:opacity-100">
                          Explore <span aria-hidden="true">→</span>
                        </p>
                      </div>
                    </a>
                  </Reveal>
                ))}
              </div>
            </div>
          </section>
        )}

        <CTA showEstimate={false} />
        <Footer />

        {lightboxOpen && gallery.length > 0 && (
          <GalleryLightbox
            images={gallery}
            index={activeIndex}
            onClose={() => setLightboxOpen(false)}
            onChange={setActiveIndex}
          />
        )}
      </main>
    </SiteLayout>
  );
}
