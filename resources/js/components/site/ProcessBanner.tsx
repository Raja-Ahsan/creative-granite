import { Reveal } from "@/components/site/Reveal";

type ProcessBannerProps = {
  src: string;
  alt: string;
  className?: string;
};

export function ProcessBanner({ src, alt, className = "" }: ProcessBannerProps) {
  return (
    <Reveal className={className}>
      <div className="overflow-hidden rounded-sm border border-foreground/10 bg-cream">
        <img
          src={src}
          alt={alt}
          loading="lazy"
          decoding="async"
          className="aspect-[21/7] w-full object-cover md:aspect-[21/6]"
        />
      </div>
    </Reveal>
  );
}
