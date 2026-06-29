import { Reveal } from "@/components/site/Reveal";
import { bodyCopyDarkLarge, sectionHeadingDark } from "@/utils/typography";

export function Remnants() {
  return (
    <section id="remnants" className="relative overflow-hidden bg-foreground py-28 text-cream md:py-40">
      <div
        className="pointer-events-none absolute inset-0 opacity-30"
        style={{
          background:
            "radial-gradient(ellipse at 30% 20%, rgba(200,160,100,0.35), transparent 50%), radial-gradient(ellipse at 80% 80%, rgba(180,140,90,0.25), transparent 50%)",
        }}
      />
      <div className="relative mx-auto grid max-w-[1400px] grid-cols-12 gap-8 px-6 md:px-10">
        <Reveal className="col-span-12 md:col-span-7">
          <div className="flex items-center gap-3 text-cream/60">
            <span className="h-px w-12 bg-cream/40" />
            <span className="eyebrow">Remnants</span>
          </div>
          <h2 className={`mt-6 max-w-3xl ${sectionHeadingDark}`}>
            Great stone at a <span className="text-accent">great value.</span>
          </h2>
          <p className={`mt-8 max-w-xl ${bodyCopyDarkLarge}`}>
            Smaller pieces of stone, ideal for vanities, laundry rooms, and smaller projects. First come, first served
            — join our list for early access.
          </p>
          <div className="mt-10 flex flex-col gap-4 sm:flex-row">
            <a
              href="#contact"
              data-cursor="browse"
              className="btn-magnetic btn-magnetic-inverse inline-flex items-center gap-3 rounded-full border border-cream px-7 py-3.5 text-xs tracking-[0.2em]"
            >
              <span>View available remnants</span>
              <span className="relative z-[2]">→</span>
            </a>
            <a
              href="#contact"
              className="inline-flex items-center gap-3 rounded-full border border-cream/30 px-7 py-3.5 text-xs tracking-[0.2em] text-cream/80 transition-colors hover:border-cream hover:text-cream"
            >
              Join the remnant list
            </a>
          </div>
        </Reveal>
        <Reveal delay={200} className="col-span-12 md:col-span-5">
          <div className="img-zoom relative aspect-[4/5] overflow-hidden rounded-sm">
            <img
              src="/portfolio/Creative-Quartz-scaled-1.jpg"
              alt="Remnant slab"
              className="h-full w-full object-cover"
            />
          </div>
        </Reveal>
      </div>
    </section>
  );
}
