import { useEstimateModal } from "@/contexts/EstimateModalContext";
import { useSiteContent } from "@/contexts/SiteContentContext";

export function Footer() {
  const { settings, footerNavLinks, footerSocialLinks } = useSiteContent();
  const { openEstimateModal } = useEstimateModal();

  return (
    <footer className="relative bg-ink pt-20 text-cream">
      <div className="mx-auto max-w-[1400px] px-6 md:px-10">
        <div className="grid grid-cols-12 gap-8 border-b border-cream/15 pb-16">
          <div className="col-span-12 md:col-span-5">
            <a href="/" className="inline-block">
              <img
                src={settings.logo}
                alt="Creative Granite & Design"
                className="h-20 w-auto max-w-[260px] object-contain object-left sm:h-24 md:h-28"
              />
            </a>
            <p className="max-w-[250px] text-[14px] text-cream/85">{settings.footerTagline}</p>
            <button
              type="button"
              onClick={openEstimateModal}
              data-cursor="estimate"
              className="btn-magnetic btn-magnetic-inverse mt-6 inline-flex items-center gap-3 rounded-full border border-cream bg-cream px-7 py-3.5 text-xs font-medium tracking-[0.2em] text-ink"
            >
              <span>Get an Estimate</span>
              <span className="relative z-[2]">→</span>
            </button>
          </div>
          <div className="col-span-6 md:col-span-2">
            <div className="eyebrow text-cream/50">Navigate</div>
            <ul className="mt-6 space-y-3">
              {footerNavLinks.map(([label, href]) => (
                <li key={label}>
                  <a href={href} className="link-underline text-cream/85">
                    {label}
                  </a>
                </li>
              ))}
            </ul>
          </div>
          <div className="col-span-6 md:col-span-2">
            <div className="eyebrow text-cream/50">Connect</div>
            <ul className="mt-6 space-y-3">
              {footerSocialLinks.map((item) => (
                <li key={item.label}>
                  <a href={item.url} className="link-underline text-cream/85" target="_blank" rel="noopener noreferrer">
                    {item.label}
                  </a>
                </li>
              ))}
            </ul>
          </div>
          <div className="col-span-12 md:col-span-3">
            <div className="eyebrow text-cream/50">Visit</div>
            <div className="mt-6 space-y-1 text-cream/85">
              {settings.addressLine1 && <div>{settings.addressLine1}</div>}
              {settings.addressLine2 && <div>{settings.addressLine2}</div>}

              {settings.hours && (
                <div>
                  <div className="eyebrow my-5 text-cream/50">Hours</div>
                  <p className="leading-relaxed">{settings.hours}</p>
                </div>
              )}

              <div className="mt-5 space-y-1 font-light">
                {settings.phone && (
                  <div>
                    <a href={`tel:${settings.phone}`} className="link-underline font-light text-cream/85">
                      {settings.phone}
                    </a>
                  </div>
                )}
                {settings.email && (
                  <div>
                    <a href={`mailto:${settings.email}`} className="link-underline font-light text-cream/85">
                      {settings.email}
                    </a>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>

        <div className="flex flex-wrap items-center justify-between gap-4 py-8 text-xs text-cream/85">
          <div>
            © {new Date().getFullYear()} Creative granite & design.
            All rights reserved.
          </div>
          <div className="tracking-widest">Built with intention.</div>
        </div>
      </div>
    </footer>
  );
}
