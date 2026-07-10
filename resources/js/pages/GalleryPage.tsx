import { Footer, Header } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useSiteContent } from "@/contexts/SiteContentContext";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";
import { SiteLayout } from "@/layouts/SiteLayout";

export function GalleryPage() {
  const { portfolio } = useSiteContent();

  return (
    <SiteLayout>
      <main>
        <Header />
        <section className="relative pb-28 pt-[calc(4.25rem+7rem)] md:pb-40 md:pt-[calc(6.5rem+10rem)]">
          <div className="mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <div className="flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">Gallery</span>
              </div>
              <h1 className={`mt-6 max-w-3xl ${sectionHeadingLight}`}>Our Work</h1>
              <p className={`mt-6 max-w-2xl ${bodyCopyLight}`}>
                A full collection of completed spaces, material details, and finished installs.
              </p>
            </Reveal>

            <div className="mt-16 grid grid-cols-2 gap-2 md:grid-cols-3 md:gap-3">
              {portfolio.map((item, i) => (
                <div
                  key={`${item.src}-${i}`}
                  className="img-zoom group relative aspect-[4/3] h-[200px] w-full overflow-hidden rounded-none bg-bone md:h-full"
                  data-cursor="view"
                >
                  <img
                    src={item.src}
                    alt={item.title}
                    loading="lazy"
                    decoding="async"
                    className="h-full w-full object-cover"
                  />
                </div>
              ))}
            </div>
          </div>
        </section>
        <Footer />
      </main>
    </SiteLayout>
  );
}
