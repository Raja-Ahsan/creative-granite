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
        <section className="relative py-28 md:py-40">
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

            <div className="mt-16 grid grid-cols-2 gap-0 md:grid-cols-3">
              {portfolio.map((item, i) => (
                <Reveal key={`${item.src}-${i}`} delay={(i % 3) * 120} className="h-full">
                  <div
                    className="img-zoom group relative aspect-[4/3] h-[200px] w-full overflow-hidden rounded-none bg-bone md:h-full"
                    data-cursor="view"
                  >
                    <img src={item.src} alt={item.title} loading="lazy" className="h-full w-full object-cover" />
                    {/* <div className="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/75 via-black/25 to-transparent" />
                    <div className="pointer-events-none absolute bottom-0 left-0 right-0 p-4 md:p-6">
                      <p className="text-xs font-medium uppercase tracking-[0.2em] text-cream">{item.title}</p>
                    </div> */}
                  </div>
                </Reveal>
              ))}
            </div>
          </div>
        </section>
        <Footer />
      </main>
    </SiteLayout>
  );
}
