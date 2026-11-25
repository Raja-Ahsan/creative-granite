import { useState } from "react";
import { Reveal } from "@/components/site/Reveal";
import { useSection, useSiteContent } from "@/contexts/SiteContentContext";
import { bodyCopyDark, sectionHeadingDark } from "@/utils/typography";

export function Faq() {
  const { faqs } = useSiteContent();
  const section = useSection("faq");
  const [openIndex, setOpenIndex] = useState<number | null>(0);

  if (!faqs.length) {
    return null;
  }

  return (
    <section id="faq" className="relative overflow-hidden bg-ink py-28 text-cream md:py-40">
      <div className="pointer-events-none absolute inset-0 grain opacity-40" />
      <div
        className="pointer-events-none absolute inset-0 opacity-40"
        style={{
          background:
            "radial-gradient(ellipse at 20% 0%, rgba(200,160,100,0.18), transparent 45%), radial-gradient(ellipse at 85% 100%, rgba(180,140,90,0.12), transparent 50%)",
        }}
      />

      <div className="relative mx-auto max-w-[1200px] px-6 md:px-10">
        <Reveal>
          <div className="flex items-center justify-center gap-3 text-cream/60">
            <span className="h-px w-12 bg-cream/40" />
            <span className="eyebrow text-cream/60">{section.eyebrow}</span>
            <span className="h-px w-12 bg-cream/40" />
          </div>
          <h2 className={`mx-auto mt-6 max-w-3xl text-center ${sectionHeadingDark}`}>
            {section.heading}
          </h2>
          {section.subheading && (
            <p className={`mx-auto mt-6 max-w-2xl text-center ${bodyCopyDark}`}>
              {section.subheading}
            </p>
          )}
        </Reveal>

        <div className="mt-14 divide-y divide-cream/15 border-y border-cream/15 bg-cream/[0.03]">
          {faqs.map((item, index) => {
            const open = openIndex === index;

            return (
              <Reveal key={`${item.question}-${index}`} delay={Math.min(index * 60, 240)}>
                <div className={open ? "bg-cream/[0.04]" : ""}>
                  <button
                    type="button"
                    aria-expanded={open}
                    onClick={() => setOpenIndex(open ? null : index)}
                    className="group flex w-full items-start justify-between gap-6 px-5 py-6 text-left transition-colors hover:bg-cream/[0.04] md:px-7 md:py-7"
                    data-cursor="view"
                  >
                    <span className="font-display text-xl leading-tight text-cream md:text-2xl">
                      {item.question}
                    </span>
                    <span
                      className={`mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-cream/25 text-2xl leading-none text-cream/80 transition-all duration-300 group-hover:border-cream/50 ${
                        open ? "rotate-45 border-cream/50 bg-cream/10" : ""
                      }`}
                      style={{ fontFamily: "sans-serif" }}
                      aria-hidden
                    >
                      +
                    </span>
                  </button>
                  <div
                    className={`grid transition-[grid-template-rows] duration-400 ease-out ${
                      open ? "grid-rows-[1fr]" : "grid-rows-[0fr]"
                    }`}
                  >
                    <div className="overflow-hidden">
                      <p className={`max-w-3xl px-5 pb-7 md:px-7 ${bodyCopyDark}`}>{item.answer}</p>
                    </div>
                  </div>
                </div>
              </Reveal>
            );
          })}
        </div>
      </div>
    </section>
  );
}
