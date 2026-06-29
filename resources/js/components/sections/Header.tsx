import { useEffect, useState } from "react";
import { useSiteContent } from "@/contexts/SiteContentContext";

export function Header() {
  const { settings, navLeft, navRight } = useSiteContent();
  const [scrolled, setScrolled] = useState(false);
  const [open, setOpen] = useState(false);

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 24);
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  const navMobile = [...navLeft, ...navRight] as const;

  return (
    <header
      className={`sticky top-0 z-50 overflow-x-clip bg-[#2a2622] transition-all duration-500 ${
        scrolled ? "border-b border-cream/15" : ""
      } text-cream`}
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
            className="h-14 w-auto max-w-[240px] object-contain lg:h-[4.5rem]"
          />
        </a>

        <div className="flex items-center justify-end gap-6 lg:gap-8">
          {navRight.map(([l, h]) => (
            <a key={l} href={h} className="link-underline text-sm font-medium text-cream/80 hover:text-cream">
              {l}
            </a>
          ))}
          <a
            href="/contact"
            data-cursor="estimate"
            className="btn-magnetic btn-magnetic-inverse group inline-flex shrink-0 items-center gap-2 rounded-full border border-cream px-5 py-2.5 text-xs font-medium tracking-[0.18em] text-cream"
          >
            <span>Get an estimate</span>
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
        <div className="border-t border-cream/10 bg-ink md:hidden">
          <div className="flex flex-col px-6 py-6">
            {navMobile.map(([l, h]) => (
              <a
                key={l}
                href={h}
                onClick={() => setOpen(false)}
                className="border-b border-cream/10 py-4 font-display text-2xl text-cream"
              >
                {l}
              </a>
            ))}
            <a href="/contact" onClick={() => setOpen(false)} className="mt-6 rounded-full bg-cream py-4 text-center text-sm tracking-widest text-ink">
              Get an estimate
            </a>
          </div>
        </div>
      )}
    </header>
  );
}
