import { Instagram } from "lucide-react";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

export function InstagramSection() {
  const { instagramPosts, settings } = useSiteContent();
  const section = useSection("instagram");
  const instagramUrl = settings.instagramUrl || "#";

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
          {section.subheading && (
            <Reveal delay={200}>
              <p className={`max-w-sm ${bodyCopyLight}`}>{section.subheading}</p>
            </Reveal>
          )}
        </div>

        <div className="mt-16 grid grid-cols-2 gap-0 md:grid-cols-3">
          {instagramPosts.map((post, i) => (
            <Reveal key={post.src} delay={(i % 3) * 100} className="h-full">
              <a
                href={post.url ?? instagramUrl}
                target="_blank"
                rel="noopener noreferrer"
                data-cursor="view"
                className="img-zoom group relative block aspect-square h-full w-full overflow-hidden bg-ink"
              >
                <img src={post.src} alt={post.alt} loading="lazy" className="h-full w-full object-cover" />
                <div className="pointer-events-none absolute inset-0 bg-ink/0 transition-colors duration-500 group-hover:bg-ink/45" />
                <div className="pointer-events-none absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                  <span className="flex h-12 w-12 items-center justify-center rounded-full border border-cream/80 bg-cream/10 text-cream backdrop-blur-sm">
                    <Instagram className="h-5 w-5" strokeWidth={1.5} />
                  </span>
                </div>
              </a>
            </Reveal>
          ))}
        </div>

        <Reveal delay={200} className="mt-12 flex justify-center md:mt-16">
          <a
            href={instagramUrl}
            target="_blank"
            rel="noopener noreferrer"
            data-cursor="follow"
            className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream"
          >
            <Instagram className="relative z-[2] h-4 w-4" strokeWidth={1.5} />
            <span>Follow on Instagram</span>
            <span className="relative z-[2]">→</span>
          </a>
        </Reveal>
      </div>
    </section>
  );
}
