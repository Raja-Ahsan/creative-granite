import { Instagram } from "lucide-react";
import { useMemo, type ReactNode } from "react";

/** Flex-grow ratios matching the homepage Instagram collage (4 cols × 3 tiles). */
export const COLLAGE_DESKTOP_RATIOS = [
  [8, 7, 9],
  [7, 11, 6],
  [10, 8, 6],
  [9, 6, 9],
] as const;

/** Mobile: 2 columns × 6 tiles */
export const COLLAGE_MOBILE_RATIOS = [
  [8, 7, 9, 7, 11, 6],
  [10, 8, 6, 9, 6, 9],
] as const;

export type CollageImage = {
  src: string;
  alt: string;
};

type TileProps = {
  image: CollageImage;
  flex: number;
  onClick?: () => void;
  href?: string;
  showInstagramIcon?: boolean;
};

function Tile({ image, flex, onClick, href, showInstagramIcon = false }: TileProps) {
  const className =
    "img-zoom group relative block min-h-0 w-full overflow-hidden rounded-none bg-ink text-left";
  const style = { flex: `${flex} 1 0%` };

  const content = (
    <>
      <img
        src={image.src}
        alt={image.alt}
        loading="lazy"
        decoding="async"
        className="absolute inset-0 h-full w-full object-cover transition-transform duration-[1400ms] ease-out group-hover:scale-[1.04]"
      />
      <div className="pointer-events-none absolute inset-0 bg-ink/0 transition-colors duration-300 group-hover:bg-ink/35" />
      {showInstagramIcon && (
        <div className="pointer-events-none absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300 group-hover:opacity-100">
          <span className="flex h-8 w-8 items-center justify-center rounded-full border border-cream/80 bg-cream/10 text-cream backdrop-blur-sm md:h-9 md:w-9">
            <Instagram className="h-3.5 w-3.5 md:h-4 md:w-4" strokeWidth={1.5} />
          </span>
        </div>
      )}
    </>
  );

  if (href) {
    return (
      <a
        href={href}
        target="_blank"
        rel="noopener noreferrer"
        data-cursor="view"
        style={style}
        className={className}
      >
        {content}
      </a>
    );
  }

  return (
    <button type="button" onClick={onClick} data-cursor="view" style={style} className={className}>
      {content}
    </button>
  );
}

function MasonryColumns({
  columns,
  ratios,
  className,
  columnCount,
  getHref,
  onImageClick,
  showInstagramIcon,
}: {
  columns: CollageImage[][];
  ratios: readonly (readonly number[])[];
  className: string;
  /** How images were distributed: index = row * columnCount + col */
  columnCount: number;
  getHref?: (image: CollageImage, globalIndex: number) => string | undefined;
  onImageClick?: (globalIndex: number) => void;
  showInstagramIcon?: boolean;
}) {
  return (
    <div className={className}>
      {columns.map((colImages, colIndex) => (
        <div key={colIndex} className="flex h-full min-w-0 flex-1 flex-col gap-1.5 md:gap-2">
          {colImages.map((image, rowIndex) => {
            // Must match how columns are filled (i % columnCount), not visual walk order
            const index = rowIndex * columnCount + colIndex;
            return (
              <Tile
                key={`${image.src}-${colIndex}-${rowIndex}`}
                image={image}
                flex={ratios[colIndex]?.[rowIndex] ?? 1}
                href={getHref?.(image, index)}
                onClick={onImageClick ? () => onImageClick(index) : undefined}
                showInstagramIcon={showInstagramIcon}
              />
            );
          })}
        </div>
      ))}
    </div>
  );
}

type PhotoMasonryCollageProps = {
  images: CollageImage[];
  /** Max images in the collage (default 12) */
  limit?: number;
  className?: string;
  getHref?: (image: CollageImage, index: number) => string | undefined;
  onImageClick?: (index: number) => void;
  showInstagramIcon?: boolean;
  /** Optional footer below the collage (e.g. Follow button) */
  footer?: ReactNode;
};

/**
 * Square 4-column masonry collage — same design as homepage Instagram “Follow our work”.
 */
export function PhotoMasonryCollage({
  images,
  limit = 12,
  className = "",
  getHref,
  onImageClick,
  showInstagramIcon = false,
  footer,
}: PhotoMasonryCollageProps) {
  const posts = images.slice(0, limit);

  const desktopColumns = useMemo(() => {
    const cols: CollageImage[][] = [[], [], [], []];
    posts.forEach((post, i) => {
      cols[i % 4].push(post);
    });
    return cols;
  }, [posts]);

  const mobileColumns = useMemo(() => {
    const cols: CollageImage[][] = [[], []];
    posts.forEach((post, i) => {
      cols[i % 2].push(post);
    });
    return cols;
  }, [posts]);

  if (!posts.length) return null;

  return (
    <div className={className}>
      {/* Desktop: square 4-column masonry — full width of parent */}
      <div className="mx-auto hidden aspect-square w-full md:block">
        <MasonryColumns
          columns={desktopColumns}
          ratios={COLLAGE_DESKTOP_RATIOS}
          columnCount={4}
          getHref={getHref}
          onImageClick={onImageClick}
          showInstagramIcon={showInstagramIcon}
          className="flex h-full w-full gap-2"
        />
      </div>

      {/* Mobile: taller 2-column masonry */}
      <div className="mx-auto aspect-[1/4] w-full md:hidden">
        <MasonryColumns
          columns={mobileColumns}
          ratios={COLLAGE_MOBILE_RATIOS}
          columnCount={2}
          getHref={getHref}
          onImageClick={onImageClick}
          showInstagramIcon={showInstagramIcon}
          className="flex h-full w-full gap-1.5"
        />
      </div>

      {footer}
    </div>
  );
}
