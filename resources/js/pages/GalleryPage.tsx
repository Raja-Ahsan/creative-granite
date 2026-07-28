import { Footer, Header } from "@/components/sections";
import { Reveal } from "@/components/site/Reveal";
import { useEstimateModal } from "@/contexts/EstimateModalContext";
import { featuredProjects, workCategories, workPageIntro } from "@/data/workPage";
import { SiteLayout } from "@/layouts/SiteLayout";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

export function GalleryPage() {
  const { openEstimateModal } = useEstimateModal();

  return (
    <SiteLayout>
      <main>
        <Header />

        {/* Hero */}
        <section className="relative overflow-hidden bg-cream pb-12 pt-[calc(4.25rem+5rem)] md:pb-16 md:pt-[calc(6.5rem+7rem)]">
          <div className="pointer-events-none absolute inset-0 noise-overlay opacity-60" />
          <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <div className="flex items-center gap-3 text-foreground/60">
                <span className="h-px w-12 bg-foreground/40" />
                <span className="eyebrow">{workPageIntro.eyebrow}</span>
              </div>
              <h1 className={`mt-6 max-w-4xl ${sectionHeadingLight}`}>{workPageIntro.heading}</h1>
              <p className={`mt-8 max-w-2xl ${bodyCopyLight}`}>{workPageIntro.body}</p>
            </Reveal>
          </div>
        </section>

        {/* Category cards */}
        <section className="relative bg-cream pb-20 md:pb-28">
          <div className="mx-auto max-w-[1400px] px-6 md:px-10">
            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-5">
              {workCategories.map((category, i) => (
                <Reveal key={category.slug} delay={i * 80}>
                  <a
                    href={`/gallery/${category.slug}`}
                    data-cursor="view"
                    className="img-zoom group relative block aspect-[4/3] overflow-hidden bg-bone md:aspect-[16/11]"
                  >
                    <img
                      src={category.cover}
                      alt={category.title}
                      className="h-full w-full object-cover transition-transform duration-[1400ms] ease-out group-hover:scale-[1.04]"
                      loading={i < 2 ? "eager" : "lazy"}
                      decoding="async"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-ink/70 via-ink/15 to-transparent" />
                    <div className="absolute inset-x-0 bottom-0 flex items-end justify-between gap-4 p-6 md:p-8">
                      <h2 className="font-display text-2xl uppercase tracking-[-0.02em] text-cream md:text-4xl">
                        {category.title}
                      </h2>
                      <span className="mb-1 text-cream/80 transition-transform duration-500 group-hover:translate-x-1">
                        →
                      </span>
                    </div>
                  </a>
                </Reveal>
              ))}
            </div>
          </div>
        </section>

        {/* Featured projects */}
        <section className="relative bg-ink py-20 text-cream md:py-28">
          <div className="pointer-events-none absolute inset-0 grain opacity-40" />
          <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
            <Reveal>
              <div className="flex items-center gap-3 text-cream/50">
                <span className="h-px w-12 bg-cream/30" />
                <span className="eyebrow text-cream/50">Featured Projects</span>
              </div>
              <h2 className="mt-6 max-w-3xl font-display text-[clamp(1.75rem,3.8vw,3.25rem)] uppercase leading-[0.95] tracking-[-0.02em] text-cream">
                A grid of our best projects.
              </h2>
            </Reveal>

            <div className="mt-12 grid grid-cols-1 gap-4 sm:grid-cols-2 md:mt-16 md:gap-5">
              {featuredProjects.map((project, i) => (
                <Reveal key={project.slug} delay={100 + i * 70}>
                  <a
                    href={`/gallery/${project.slug}`}
                    data-cursor="view"
                    className="img-zoom group relative block aspect-[4/3] overflow-hidden bg-bone md:aspect-[16/11]"
                  >
                    <img
                      src={project.cover}
                      alt={project.title}
                      className="h-full w-full object-cover transition-transform duration-[1400ms] ease-out group-hover:scale-[1.04]"
                      loading="lazy"
                      decoding="async"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-ink/75 via-ink/20 to-transparent" />
                    <div className="absolute inset-x-0 bottom-0 flex items-end justify-between gap-4 p-6 md:p-8">
                      <h3 className="font-display text-xl uppercase tracking-[-0.02em] text-cream md:text-3xl">
                        {project.title}
                      </h3>
                      <span className="mb-1 text-cream/80 transition-transform duration-500 group-hover:translate-x-1">
                        →
                      </span>
                    </div>
                  </a>
                </Reveal>
              ))}
            </div>
          </div>
        </section>

        {/* CTA */}
        <section className="relative overflow-hidden bg-cream py-28 md:py-36">
          <div className="pointer-events-none absolute inset-0 noise-overlay" />
          <div className="relative mx-auto max-w-[1400px] px-6 text-center md:px-10">
            <Reveal>
              <h2 className={`mx-auto max-w-4xl ${sectionHeadingLight}`}>
                Ready to Start Your Project?
              </h2>
              <p className={`mx-auto mt-8 max-w-[750px] text-lg ${bodyCopyLight}`}>
                Whether you&apos;re building a custom home, remodeling an existing space, or managing
                a multifamily or commercial project, our team is ready to bring your vision to life.
              </p>
              <div className="mt-12 flex justify-center">
                <button
                  type="button"
                  onClick={openEstimateModal}
                  data-cursor="estimate"
                  className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream"
                >
                  <span>Get an Estimate</span>
                  <span className="relative z-[2]">→</span>
                </button>
              </div>
            </Reveal>
          </div>
        </section>

        <Footer />
      </main>
    </SiteLayout>
  );
}
