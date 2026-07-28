import { Reveal } from "@/components/site/Reveal";
import { PhotoMasonryCollage } from "@/components/site/PhotoMasonryCollage";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { sectionHeadingLight } from "@/utils/typography";
import { useMemo } from "react";

export function InstagramSection() {
  const { instagramPosts, settings } = useSiteContent();
  const section = useSection("instagram");
  const instagramUrl = settings.instagramUrl || "#";

  const images = useMemo(
    () =>
      instagramPosts.slice(0, 12).map((post) => ({
        src: post.src,
        alt: post.alt,
        url: post.url,
      })),
    [instagramPosts],
  );

  if (!images.length) return null;

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

        <Reveal delay={80} className="mt-12 md:mt-16">
          <PhotoMasonryCollage
            images={images}
            limit={12}
            showInstagramIcon
            getHref={(image, index) => images[index]?.url ?? instagramUrl}
            footer={
              <div className="mt-12 flex justify-center md:mt-16">
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
              </div>
            }
          />
        </Reveal>
      </div>
    </section>
  );
}
