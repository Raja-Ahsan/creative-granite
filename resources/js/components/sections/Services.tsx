import { Reveal } from "@/components/site/Reveal";
import { ServiceCard } from "@/components/sections/ServiceCard";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { sectionHeadingDark } from "@/utils/typography";

type ServicesProps = {
  standalone?: boolean;
};

export function Services({ standalone = false }: ServicesProps) {
  const { services } = useSiteContent();
  const section = useSection("services");

  if (standalone) return null;

  return (
    <section id="services" className="relative bg-ink py-28 text-cream md:py-40">
      <div className="pointer-events-none absolute inset-0 grain opacity-40" />
      <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
        <Reveal>
          <div className="flex items-center gap-3 text-cream/60">
            <span className="h-px w-12 bg-cream/40" />
            <span className="eyebrow">{section.eyebrow}</span>
          </div>
          <h2 className={`mt-6 max-w-2xl ${sectionHeadingDark}`}>{section.heading}</h2>
        </Reveal>

        <div className="mt-16 space-y-6 md:space-y-8">
          {services.map((service, i) => (
            <ServiceCard
              key={service.slug}
              index={i}
              title={service.title}
              slug={service.slug}
              excerpt={service.excerpt}
              mainImage={service.mainImage}
              reversed={i % 2 === 1}
            />
          ))}
        </div>

        <Reveal delay={200} className="mt-12 flex justify-center md:mt-16">
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
