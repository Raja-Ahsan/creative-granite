import { useEffect, useCallback } from "react";

export type LightboxImage = {
  src: string;
  title?: string;
};

type ImageLightboxProps = {
  images: LightboxImage[];
  index: number | null;
  onClose: () => void;
  onChange: (index: number) => void;
};

export function ImageLightbox({ images, index, onClose, onChange }: ImageLightboxProps) {
  const isOpen = index !== null && images.length > 0;
  const current = isOpen ? images[index] : null;

  const showPrev = useCallback(() => {
    if (index === null || images.length === 0) return;
    onChange((index - 1 + images.length) % images.length);
  }, [index, images.length, onChange]);

  const showNext = useCallback(() => {
    if (index === null || images.length === 0) return;
    onChange((index + 1) % images.length);
  }, [index, images.length, onChange]);

  useEffect(() => {
    if (!isOpen) return;

    const previousOverflow = document.body.style.overflow;
    document.body.style.overflow = "hidden";

    const onKeyDown = (event: KeyboardEvent) => {
      if (event.key === "Escape") onClose();
      if (event.key === "ArrowLeft") showPrev();
      if (event.key === "ArrowRight") showNext();
    };

    window.addEventListener("keydown", onKeyDown);

    return () => {
      document.body.style.overflow = previousOverflow;
      window.removeEventListener("keydown", onKeyDown);
    };
  }, [isOpen, onClose, showPrev, showNext]);

  if (!isOpen || !current) return null;

  return (
    <div
      className="fixed inset-0 z-[100] flex items-center justify-center bg-ink/95 p-4 md:p-8"
      role="dialog"
      aria-modal="true"
      aria-label="Image gallery viewer"
      onClick={onClose}
    >
      <button
        type="button"
        aria-label="Close"
        onClick={onClose}
        className="absolute right-4 top-4 z-10 flex h-11 w-11 items-center justify-center rounded-full border border-cream/30 text-cream transition hover:bg-cream/10 md:right-8 md:top-8"
      >
        <span className="text-2xl leading-none">×</span>
      </button>

      {images.length > 1 && (
        <>
          <button
            type="button"
            aria-label="Previous image"
            onClick={(event) => {
              event.stopPropagation();
              showPrev();
            }}
            className="absolute left-3 z-10 flex h-12 w-12 items-center justify-center rounded-full border border-cream/30 text-cream transition hover:bg-cream/10 md:left-8"
          >
            <span className="text-2xl leading-none">‹</span>
          </button>
          <button
            type="button"
            aria-label="Next image"
            onClick={(event) => {
              event.stopPropagation();
              showNext();
            }}
            className="absolute right-3 z-10 flex h-12 w-12 items-center justify-center rounded-full border border-cream/30 text-cream transition hover:bg-cream/10 md:right-8"
          >
            <span className="text-2xl leading-none">›</span>
          </button>
        </>
      )}

      <div
        className="relative flex max-h-full max-w-full items-center justify-center"
        onClick={(event) => event.stopPropagation()}
      >
        <img
          src={current.src}
          alt=""
          className="max-h-[85vh] max-w-[92vw] object-contain md:max-w-[80vw]"
        />
      </div>

      {images.length > 1 && (
        <div className="absolute bottom-5 left-1/2 -translate-x-1/2 rounded-full border border-cream/20 bg-ink/60 px-4 py-2 text-xs tracking-[0.2em] text-cream/80">
          {(index ?? 0) + 1} / {images.length}
        </div>
      )}
    </div>
  );
}
