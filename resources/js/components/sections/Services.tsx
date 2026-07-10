import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { sectionHeadingDark } from "@/utils/typography";

export function Services() {
  const { services } = useSiteContent();
  const section = useSection("services");

  return (
    <section id="services" className="relative bg-ink py-28 text-cream md:py-40">
      <div className="pointer-events-none absolute inset-0 grain opacity-40" />
      <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
        <Reveal>
          <div className="flex items-center gap-3 text-cream/60">
            <span className="h-px w-12 bg-cream/40" />
            <span className="eyebrow">{section.eyebrow}</span>
          </div>
          {/* <h2 className={`mt-6 max-w-2xl ${sectionHeadingDark}`}>{section.heading}</h2> */}
        </Reveal>

        <div className="mt-20 divide-y divide-cream/15 border-y border-cream/15">
          {services.map((service, i) => (
            <Reveal key={service.slug} delay={i * 100}>
              <a
                href={`/services/${service.slug}`}
                data-cursor="learn"
                className="group relative grid cursor-pointer grid-cols-12 gap-6 py-10 transition-colors duration-500 hover:bg-cream/[0.04] md:py-14"
              >
                <div className="col-span-2 md:col-span-1">
                  <span className="font-mono text-sm opacity-50">0{i + 1}</span>
                </div>
                <div className="col-span-10 md:col-span-5">
                  <h3 className="font-display text-2xl transition-transform duration-500 group-hover:translate-x-2 md:text-5xl">
                    {service.title}
                  </h3>
                </div>
                <div className="col-span-12 md:col-span-5">
                  <p className="text-cream/70 md:text-lg">{service.excerpt}</p>
                </div>
                <div className="col-span-12 flex items-center justify-end md:col-span-1">
                  <span
                    className="text-2xl transition-transform duration-500 group-hover:rotate-45"
                    style={{ fontFamily: "sans-serif" }}
                  >
                    +
                  </span>
                </div>
              </a>
            </Reveal>
          ))}
        </div>

        <Reveal delay={300} className="mt-12 flex justify-center md:mt-16">
          <a
            href="/services"
            data-cursor="services"
            className="btn-magnetic btn-magnetic-inverse inline-flex items-center gap-3 rounded-full border border-cream px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream"
          >
            <span>View all services</span>
            <span className="relative z-[2]">→</span>
          </a>
        </Reveal>
      </div>
    </section>
  );
}
