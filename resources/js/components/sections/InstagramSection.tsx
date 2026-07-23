import { Instagram } from "lucide-react";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { sectionHeadingLight } from "@/utils/typography";
import { useMemo } from "react";

/**
 * Flex-grow ratios matching the reference collage (4 cols × 3 tiles).
 * Each column totals 24 so they share one square outer height.
 */
const DESKTOP_RATIOS = [
  [8, 7, 9],
  [7, 11, 6],
  [10, 8, 6],
  [9, 6, 9],
] as const;

/** Mobile: 2 columns × 6 tiles, still summing evenly */
const MOBILE_RATIOS = [
  [8, 7, 9, 7, 11, 6],
  [10, 8, 6, 9, 6, 9],
] as const;

type Post = { src: string; alt: string; url?: string };

function Tile({
  post,
  href,
  flex,
}: {
  post: Post;
  href: string;
  flex: number;
}) {
  return (
    <a
      href={post.url ?? href}
      target="_blank"
      rel="noopener noreferrer"
      data-cursor="view"
      style={{ flex: `${flex} 1 0%` }}
      className="img-zoom group relative block min-h-0 w-full overflow-hidden rounded-none bg-ink"
    >
      <img
        src={post.src}
        alt={post.alt}
        loading="lazy"
        decoding="async"
        className="absolute inset-0 h-full w-full object-cover transition-transform duration-[1400ms] ease-out group-hover:scale-[1.04]"
      />
      <div className="pointer-events-none absolute inset-0 bg-ink/0 transition-colors duration-300 group-hover:bg-ink/35" />
      <div className="pointer-events-none absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300 group-hover:opacity-100">
        <span className="flex h-8 w-8 items-center justify-center rounded-full border border-cream/80 bg-cream/10 text-cream backdrop-blur-sm md:h-9 md:w-9">
          <Instagram className="h-3.5 w-3.5 md:h-4 md:w-4" strokeWidth={1.5} />
        </span>
      </div>
    </a>
  );
}

function MasonryColumns({
  columns,
  ratios,
  href,
  className,
}: {
  columns: Post[][];
  ratios: readonly (readonly number[])[];
  href: string;
  className: string;
}) {
  return (
    <div className={className}>
      {columns.map((colPosts, colIndex) => (
        <div key={colIndex} className="flex h-full min-w-0 flex-1 flex-col gap-1.5 md:gap-2">
          {colPosts.map((post, rowIndex) => (
            <Tile
              key={`${post.src}-${colIndex}-${rowIndex}`}
              post={post}
              href={href}
              flex={ratios[colIndex]?.[rowIndex] ?? 1}
            />
          ))}
        </div>
      ))}
    </div>
  );
}

export function InstagramSection() {
  const { instagramPosts, settings } = useSiteContent();
  const section = useSection("instagram");
  const instagramUrl = settings.instagramUrl || "#";

  const posts = instagramPosts.slice(0, 12);

  const desktopColumns = useMemo(() => {
    const cols: Post[][] = [[], [], [], []];
    posts.forEach((post, i) => {
      cols[i % 4].push(post);
    });
    return cols;
  }, [posts]);

  const mobileColumns = useMemo(() => {
    const cols: Post[][] = [[], []];
    posts.forEach((post, i) => {
      cols[i % 2].push(post);
    });
    return cols;
  }, [posts]);

  if (!posts.length) return null;

  return (
    <section id="instagram" className="relative bg-bone py-28 md:py-40">
      <div className="mx-auto max-w-[1400px] px-6 md:px-10">
        <div className="flex flex-wrap items-end justify-between gap-6">
          <Reveal>
            <div className="flex items-center gap-3 text-foreground/60">
              <span className="h-px w-12 bg-foreground/40" />
              <span className="eyebrow">{section.eyebrow}</span>
            </div>
            <h2 className={`mt-6 max-w-3xl ${sectionHeadingLight}`}>{section.heading}</h2>
          </Reveal>
        </div>

        {/* Desktop: square 4-column masonry identical to reference */}
        <div className="mx-auto mt-12 hidden aspect-square w-full max-w-[1100px] md:mt-16 md:block">
          <MasonryColumns
            columns={desktopColumns}
            ratios={DESKTOP_RATIOS}
            href={instagramUrl}
            className="flex h-full w-full gap-2"
          />
        </div>

        {/* Mobile: 2-column square masonry */}
        <div className="mx-auto mt-12 aspect-square w-full md:hidden">
          <MasonryColumns
            columns={mobileColumns}
            ratios={MOBILE_RATIOS}
            href={instagramUrl}
            className="flex h-full w-full gap-1.5"
          />
        </div>

        <Reveal delay={200} className="mt-12 flex justify-center md:mt-16">
          <a
            href={instagramUrl}
            target="_blank"
            rel="noopener noreferrer"
            data-cursor="follow"
            className="btn-magnetic inline-flex items-center rounded-full border border-foreground bg-transparent px-10 py-5 text-xs font-medium tracking-[0.25em] text-foreground"
          >
            <span>Follow on Instagram</span>
            <span className="relative z-[2]">→</span>
          </a>
        </Reveal>
      </div>
    </section>
  );
}
