import { useEffect, useRef, useState } from "react";
import { useEstimateModal } from "@/contexts/EstimateModalContext";
import { useSiteContent } from "@/contexts/SiteContentContext";

function isEstimateLink(href: string): boolean {
  return href === "#estimate" || href.endsWith("#estimate");
}

export function Header() {
  const { settings, navLeft, navRight } = useSiteContent();
  const { openEstimateModal } = useEstimateModal();
  const [scrolled, setScrolled] = useState(false);
  const [open, setOpen] = useState(false);
  const scrolledRef = useRef(false);

  useEffect(() => {
    let raf = 0;
    const onScroll = () => {
      cancelAnimationFrame(raf);
      raf = requestAnimationFrame(() => {
        const next = window.scrollY > 24;
        if (next !== scrolledRef.current) {
          scrolledRef.current = next;
          setScrolled(next);
        }
      });
    };
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => {
      cancelAnimationFrame(raf);
      window.removeEventListener("scroll", onScroll);
    };
  }, []);

  const navMobile = [...navLeft, ...navRight] as const;

  return (
    <header
      className={`fixed inset-x-0 top-0 z-50 overflow-x-clip text-cream transition-all duration-500 ${
        scrolled
          ? "border-b border-cream/15 bg-ink/80 backdrop-blur-md"
          : "bg-ink/50 backdrop-blur-sm"
      }`}
    >
      <div className="mx-auto hidden max-w-[1400px] grid-cols-3 items-center px-6 py-4 md:grid md:px-10 md:py-5">
        <nav className="flex items-center gap-6 lg:gap-8">
          {navLeft.map(([l, h]) => (
            <a key={l} href={h} className="link-underline text-sm font-medium text-cream/80 hover:text-cream">
              {l}
            </a>
          ))}
        </nav>

        <a href="/" className="flex justify-center" data-cursor="home">
          <img
            src={settings.logo}
            alt="Creative Granite & Design"
            loading="eager"
            decoding="async"
            className="h-14 w-auto max-w-[240px] object-contain lg:h-[4.5rem]"
          />
        </a>

        <div className="flex items-center justify-end gap-6 lg:gap-8">
          {navRight.map(([l, h]) =>
            isEstimateLink(h) ? (
              <button
                key={l}
                type="button"
                onClick={openEstimateModal}
                data-cursor="estimate"
                className="link-underline text-sm font-medium text-cream/80 hover:text-cream"
              >
                {l}
              </button>
            ) : (
              <a key={l} href={h} className="link-underline text-sm font-medium text-cream/80 hover:text-cream">
                {l}
              </a>
            ),
          )}
          <a
            href="/contact"
            data-cursor="contact"
            className="btn-magnetic btn-magnetic-inverse group inline-flex shrink-0 items-center gap-2 rounded-full border border-cream px-5 py-2.5 text-xs font-medium tracking-[0.18em] text-cream"
          >
            <span>Contact</span>
            <span className="relative z-[2] inline-block transition-transform group-hover:translate-x-1">→</span>
          </a>
        </div>
      </div>

      <div className="mx-auto flex min-w-0 max-w-[1400px] items-center justify-between gap-2 px-4 py-3 md:hidden">
        <a href="/" className="min-w-0 flex-1 overflow-hidden" data-cursor="home">
          <img
            src={settings.logo}
            alt="Creative Granite & Design"
            className="block h-11 w-auto max-w-full object-contain object-left sm:h-14"
          />
        </a>
        <button
          aria-label="Menu"
          onClick={() => setOpen((v) => !v)}
          className="flex h-10 w-10 shrink-0 items-center justify-center"
        >
          <div className="flex flex-col gap-1.5">
            <span className={`block h-px w-6 bg-cream transition-transform ${open ? "translate-y-[6px] rotate-45" : ""}`} />
            <span className={`block h-px w-6 bg-cream transition-opacity ${open ? "opacity-0" : ""}`} />
            <span className={`block h-px w-6 bg-cream transition-transform ${open ? "-translate-y-[6px] -rotate-45" : ""}`} />
          </div>
        </button>
      </div>

      {open && (
        <div className="border-t border-cream/10 bg-ink/85 backdrop-blur-md md:hidden">
          <div className="flex flex-col px-6 py-6">
            {navMobile.map(([l, h]) =>
              isEstimateLink(h) ? (
                <button
                  key={l}
                  type="button"
                  onClick={() => {
                    setOpen(false);
                    openEstimateModal();
                  }}
                  className="border-b border-cream/10 py-4 text-left font-display text-2xl text-cream"
                >
                  {l}
                </button>
              ) : (
                <a
                  key={l}
                  href={h}
                  onClick={() => setOpen(false)}
                  className="border-b border-cream/10 py-4 font-display text-2xl text-cream"
                >
                  {l}
                </a>
              ),
            )}
            <a
              href="/contact"
              onClick={() => setOpen(false)}
              className="mt-6 rounded-full bg-cream py-4 text-center text-sm tracking-widest text-ink"
            >
              Contact
            </a>
          </div>
        </div>
      )}
    </header>
  );
}
