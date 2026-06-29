import { Reveal } from "@/components/site/Reveal";
import { processSteps } from "@/services/content";
import { bodyCopyLight, sectionHeadingLight } from "@/utils/typography";

export function Process() {
  return (
    <section id="process" className="relative py-28 md:py-40">
      <div className="mx-auto max-w-[1400px] px-6 md:px-10">
        <Reveal>
          <div className="flex items-center gap-3 text-foreground/60">
            <span className="h-px w-12 bg-foreground/40" />
            <span className="eyebrow">Project timeline</span>
          </div>
          <h2 className={`mt-6 max-w-3xl ${sectionHeadingLight}`}>Four steps, no surprises.</h2>
        </Reveal>

        <div className="mt-20 grid grid-cols-1 gap-px overflow-hidden bg-foreground/15 md:grid-cols-4">
          {processSteps.map((p, i) => (
            <Reveal key={p.n} delay={i * 100} className="bg-cream">
              <div className="group h-full p-8 md:p-10">
                <div className="flex items-center justify-between">
                  <span className="font-mono text-xs text-foreground/50">{p.n}</span>
                  <span className="h-px w-8 bg-foreground/20 transition-all duration-500 group-hover:w-16 group-hover:bg-foreground" />
                </div>
                <h3 className="mt-16 font-display text-3xl md:text-4xl">{p.t}</h3>
                <p className={`mt-4 ${bodyCopyLight}`}>{p.d}</p>
              </div>
            </Reveal>
          ))}
        </div>
      </div>
    </section>
  );
}
