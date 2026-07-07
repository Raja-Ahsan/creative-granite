import { Reveal } from "@/components/site/Reveal";
import { bodyCopyDark, sectionHeadingDark } from "@/utils/typography";

type ServiceCardProps = {
  index: number;
  title: string;
  slug: string;
  excerpt: string;
  mainImage?: string | null;
  reversed?: boolean;
};

export function ServiceCard({
  index,
  title,
  slug,
  excerpt,
  mainImage,
  reversed,
}: ServiceCardProps) {
  return (
    <Reveal delay={index * 80}>
      <a
        href={`/services/${slug}`}
        data-cursor="learn"
        className={`service-card group grid grid-cols-1 overflow-hidden rounded-sm border border-cream/10 bg-cream/[0.03] md:grid-cols-2 ${
          reversed ? "md:[direction:rtl]" : ""
        }`}
      >
        <div className={`img-zoom relative aspect-[4/3] overflow-hidden md:aspect-auto md:min-h-[22rem] ${reversed ? "md:[direction:ltr]" : ""}`}>
          {mainImage ? (
            <img
              src={mainImage}
              alt={title}
              loading="lazy"
              decoding="async"
              className="h-full w-full object-cover transition-transform duration-[1.4s] ease-out group-hover:scale-[1.04]"
            />
          ) : (
            <div className="service-card-placeholder flex h-full min-h-[16rem] w-full items-end p-8 md:min-h-full">
              <span className="font-mono text-xs tracking-[0.3em] text-cream/50">0{index + 1}</span>
            </div>
          )}
          <div className="pointer-events-none absolute inset-0 bg-gradient-to-t from-ink/50 via-transparent to-transparent opacity-60 transition-opacity duration-500 group-hover:opacity-80" />
        </div>

        <div className={`flex flex-col justify-center p-8 md:p-12 lg:p-16 ${reversed ? "md:[direction:ltr]" : ""}`}>
          <span className="font-mono text-xs tracking-[0.25em] text-cream/40">0{index + 1}</span>
          <h2 className={`mt-4 ${sectionHeadingDark} text-[clamp(2rem,4vw,3.25rem)]`}>
            {title}
          </h2>
          <p className={`mt-6 max-w-md md:text-lg ${bodyCopyDark}`}>
            {excerpt}
          </p>
          <div className="mt-10 flex items-center justify-between border-t border-cream/10 pt-6">
            <span className="eyebrow text-cream/50">Explore service</span>
            <span className="text-xl text-cream/70 transition-transform duration-500 group-hover:translate-x-2">→</span>
          </div>
        </div>
      </a>
    </Reveal>
  );
}
