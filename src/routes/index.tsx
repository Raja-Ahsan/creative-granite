import { createFileRoute } from "@tanstack/react-router";
import { useEffect, useRef, useState } from "react";
import { Instagram } from "lucide-react";
import logo from "@/assets/update-logo.png";
import aboutStoneBath from "@/assets/LakeLine-20.jpeg";
import slider1 from "@/assets/slider1.jpg";
import slider2 from "@/assets/slider2.jpg";
import slider3 from "@/assets/slider3.jpg";
import { Reveal } from "@/components/site/Reveal";
import { CustomCursor } from "@/components/site/CustomCursor";
import { LoadingScreen } from "@/components/site/LoadingScreen";

export const Route = createFileRoute("/")({
  component: Index,
});

const heroSlides = [
  { src: slider1, alt: "Luxury kitchen with marble countertops and stone backsplash" },
  { src: slider2, alt: "Bright modern kitchen with white stone island" },
  { src: slider3, alt: "Double-island kitchen with sage cabinetry and stone surfaces" },
];

const portfolio = [
  { src: "/portfolio/DSC_4182_1.jpeg", title: "Carrara Island", tag: "Marble · Salt Lake" },
  { src: "/portfolio/024.jpg", title: "Modern Kitchen", tag: "Granite · Salt Lake" },
  { src: "/portfolio/portfolio_2.jpg", title: "Refined Hearth", tag: "Quartz · Provo" },
  { src: "/portfolio/067.jpg", title: "Warm Minimal", tag: "Quartzite · Holladay" },
  { src: "/portfolio/portfolio_3.jpg", title: "Architectural", tag: "Marble · Draper" },
  { src: "/portfolio/051.jpg", title: "Quiet Movement", tag: "Granite · Ogden" },
  { src: "/portfolio/009-1.jpg", title: "Coastal Kitchen", tag: "Quartzite · St. George" },
  { src: "/portfolio/Creative-Quartz-scaled-1.jpg", title: "Creative Quartz", tag: "Quartz · Showroom" },
  { src: "/portfolio/DSC_4182.jpg", title: "Carrara Island", tag: "Marble · Salt Lake" },
  // { src: "/portfolio/DSC_4076.jpg", title: "Calacatta Hearth", tag: "Marble · Park City" },
  // { src: "/portfolio/DSC_3988.jpg", title: "Hill Country Kitchen", tag: "Quartzite · Holladay" },
];

const INSTAGRAM_URL = "#";
const SHOWROOM_MAPS_URL =
  "https://www.google.com/maps/place/1998+N+Redwood+Rd,+Salt+Lake+City,+UT+84116,+USA/@40.8115045,-111.9402546,16.96z/data=!4m6!3m5!1s0x8752f6bad3a740e7:0x54da835cc07f3b51!8m2!3d40.8115002!4d-111.9376702!16s%2Fg%2F11c1zjtg8r?entry=ttu&g_ep=EgoyMDI2MDYyMy4wIKXMDSoASAFQAw%3D%3D";

const instagramPosts = [
  { src: "/portfolio/DSC_4076.jpg", alt: "Marble kitchen countertop installation in Park City" },
  { src: "/portfolio/DSC_3988.jpg", alt: "Quartzite kitchen surfaces in Holladay" },
  { src: "/portfolio/054.jpg", alt: "Custom stone island fabrication" },
  { src: "/portfolio/063.jpg", alt: "Granite countertop detail" },
  { src: "/portfolio/073.jpg", alt: "Modern bathroom stone vanity" },
  { src: "/portfolio/040-1.jpg", alt: "Creative Granite showroom slab selection" },
];

const materials = [
  {
    name: "Granite",
    desc: "A durable natural stone known for its strength and variation. A reliable choice for kitchens and high use surfaces.",
    image: "/materials/granite.png",
  },
  {
    name: "Quartz",
    desc: "An engineered surface designed for consistency and low maintenance, offering a wide range of colors and styles.",
    image: "/materials/quartz.png",
  },
  {
    name: "Marble",
    desc: "A natural stone known for soft movement and timeless appeal, often used in bathrooms and feature areas.",
    image: "/materials/marble.jpg",
  },
  {
    name: "Quartzite",
    desc: "A natural stone valued for durability and distinctive movement, ideal for kitchens and high traffic spaces.",
    image: "/materials/quartzite.jpg",
  },
];

const services = [
  { title: "New Construction", body: "Stone fabrication for new builds, working closely with builders, designers, andproject teams to ensure accuracy, efficiency, and consistency from planning through installation." },
  { title: "Remodel & Renovation", body: "Custom stone surfaces for kitchen, bathroom, and interior remodels focused on thoughtful material selection and clean execution." },
  { title: "Multifamily & Commercial", body: "Custom stone fabrication for multifamily and commercial projects, supporting developers, contractors, and project teams with efficient xecution, consistent quality, and dependable delivery." },
  
];

const process = [
  { n: "01", t: "Initial Consultation", d: "We discuss your project, timeline, and budget in our showroom or on-site." },
  { n: "02", t: "Estimate & Material Selection", d: "We provide a detailed quote and guide you through slab selection from our inventory." },
  { n: "03", t: "Template & Measurement", d: "Our team templates your space with precision for a perfect fit no guesswork." },
  { n: "04", t: "Fabrication & Install", d: "Hand finished edges, sealed surfaces, and a clean, on schedule installation." },
];

const sectionHeading =
  "font-display text-[clamp(1.75rem,4.5vw,3.75rem)] uppercase leading-[0.92] tracking-[-0.02em]";
const sectionHeadingLight = `${sectionHeading} text-[#021E44]`;
const sectionHeadingDark = `${sectionHeading} text-cream`;

function SplitText({
  text,
  className = "",
  wrap = false,
  dense = false,
}: {
  text: string;
  className?: string;
  wrap?: boolean;
  dense?: boolean;
}) {
  const ref = useRef<HTMLSpanElement>(null);
  const [seen, setSeen] = useState(false);
  useEffect(() => {
    const el = ref.current;
    if (!el) return;
    // Eagerly reveal if element is already (even partially) in viewport on mount.
    const r = el.getBoundingClientRect();
    if (r.top < window.innerHeight && r.bottom > 0) {
      setSeen(true);
      return;
    }
    const io = new IntersectionObserver(
      (e) => e.forEach((x) => x.isIntersecting && (setSeen(true), io.disconnect())),
      { threshold: 0.05 },
    );
    io.observe(el);
    return () => io.disconnect();
  }, []);
  return (
    <span ref={ref} className={`split-line inline-block overflow-hidden align-baseline ${seen ? "in" : ""} ${className}`}>
      {text.split(" ").map((word, wi) => (
        <span
          key={wi}
          className={`inline-block overflow-hidden align-baseline ${dense ? "py-0" : "py-[0.15em]"} ${wrap ? "pr-[0.2em]" : "whitespace-nowrap pr-[0.25em]"}`}
        >
          {word.split("").map((c, ci) => (
            <span
              key={ci}
              className="split-char"
              style={{ transitionDelay: `${(wi * 60) + ci * 18}ms` }}
            >
              {c}
            </span>
          ))}
        </span>
      ))}
    </span>
  );
}

function Header() {
  const [scrolled, setScrolled] = useState(false);
  const [open, setOpen] = useState(false);
  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 24);
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);
  const navLeft = [
    ["Work", "#work"],
    ["Products", "#materials"],
    ["Services", "#services"],
  ] as const;

  const navRight = [
    ["Process", "#process"],
    ["Contact", "#contact"],
  ] as const;

  const navMobile = [...navLeft, ...navRight] as const;

  return (
    <header
      className={`sticky top-0 z-50 overflow-x-clip bg-ink transition-all duration-500 ${
        scrolled ? "border-b border-cream/15" : ""
      } text-cream`}
    >
      {/* Desktop — logo center, nav split left / right */}
      <div className="mx-auto hidden max-w-[1400px] grid-cols-3 items-center px-6 py-4 md:grid md:px-10 md:py-5">
        <nav className="flex items-center gap-6 lg:gap-8">
          {navLeft.map(([l, h]) => (
            <a key={l} href={h} className="link-underline text-sm font-medium text-cream/80 hover:text-cream">
              {l}
            </a>
          ))}
        </nav>

        <a href="#top" className="flex justify-center" data-cursor="home">
          <img
            src={logo}
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
            href="#contact"
            data-cursor="estimate"
            className="btn-magnetic btn-magnetic-inverse group inline-flex shrink-0 items-center gap-2 rounded-full border border-cream px-5 py-2.5 text-xs font-medium tracking-[0.18em] text-cream"
          >
            <span>Get an estimate</span>
            <span className="relative z-[2] inline-block transition-transform group-hover:translate-x-1">→</span>
          </a>
        </div>
      </div>

      {/* Mobile — logo left, hamburger right */}
      <div className="mx-auto flex min-w-0 max-w-[1400px] items-center justify-between gap-2 px-4 py-3 md:hidden">
        <a href="#top" className="min-w-0 flex-1 overflow-hidden" data-cursor="home">
          <img
            src={logo}
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
            <a href="#contact" onClick={() => setOpen(false)} className="mt-6 rounded-full bg-cream py-4 text-center text-sm tracking-widest text-ink">
              Get an estimate
            </a>
          </div>
        </div>
      )}
    </header>
  );
}

function HeroSlider({ y }: { y: number }) {
  const [active, setActive] = useState(0);

  useEffect(() => {
    const interval = window.setInterval(
      () => setActive((i) => (i + 1) % heroSlides.length),
      5500,
    );
    return () => window.clearInterval(interval);
  }, []);

  return (
    <>
      <div
        className="pointer-events-none absolute inset-0"
        style={{ transform: `translateY(${y * 0.15}px)` }}
      >
        {heroSlides.map((slide, i) => (
          <img
            key={slide.src}
            src={slide.src}
            alt={slide.alt}
            className={`absolute inset-0 size-full object-cover object-center transition-opacity duration-[1600ms] ease-in-out ${
              i === active ? "opacity-100" : "opacity-0"
            }`}
          />
        ))}
      </div>

      <div className="pointer-events-none absolute bottom-8 left-1/2 z-20 flex -translate-x-1/2 gap-2.5 md:bottom-10">
        {heroSlides.map((_, i) => (
          <span
            key={i}
            className={`h-1 rounded-full transition-all duration-500 ${
              i === active ? "w-8 bg-cream" : "w-1 bg-cream/40"
            }`}
          />
        ))}
      </div>
    </>
  );
}

function Hero() {
  const ref = useRef<HTMLDivElement>(null);
  const [y, setY] = useState(0);
  useEffect(() => {
    const onScroll = () => {
      if (!ref.current) return;
      const rect = ref.current.getBoundingClientRect();
      setY(-rect.top * 0.25);
    };
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);
  return (
    <section ref={ref} id="top" className="relative h-[calc(100svh-4.25rem)] overflow-hidden bg-ink text-cream md:h-auto md:min-h-[calc(100svh-6.5rem)]">
      <HeroSlider y={y} />
      {/* <div className="pointer-events-none absolute inset-0 bg-gradient-to-r from-ink/80 via-ink/45 to-ink/20" />
      <div className="pointer-events-none absolute inset-0 bg-gradient-to-t from-ink/95 via-ink/30 to-ink/25" />
      <div className="pointer-events-none absolute inset-0 noise-overlay opacity-30" />
      <div
        className="pointer-events-none absolute -right-32 -top-32 h-[600px] w-[600px] rounded-full opacity-30 blur-3xl"
        style={{ background: "radial-gradient(circle, rgba(170,130,80,0.5), transparent 70%)", transform: `translateY(${y * 0.6}px)` }}
      />
      <div
        className="pointer-events-none absolute -bottom-40 -left-40 h-[700px] w-[700px] rounded-full opacity-25 blur-3xl"
        style={{ background: "radial-gradient(circle, rgba(60,40,20,0.6), transparent 70%)", transform: `translateY(${y * -0.4}px)` }}
      /> */}

    </section>
  );
}

function HeroIntro() {
  return (
    <section className="relative bg-cream px-6 py-10 text-center md:px-10 md:py-14">
      <div className="mx-auto max-w-[920px]">
        <Reveal>
          <div className="flex items-center justify-center gap-3 text-foreground/60">
            <span className="h-px w-12 bg-foreground/40" />
            <span className="eyebrow tracking-[0.2em]">Welcome to creative granite and design</span>
            <span className="h-px w-12 bg-foreground/40" />
          </div>
        </Reveal>

        <h1 className={`mt-4 md:mt-5 ${sectionHeadingLight}`}>
          <SplitText text="Crafting Custom Stone for Inspired Spaces" wrap dense />
        </h1>

        <Reveal
          delay={300}
          className="mt-4 text-foreground/70"
        >
          Serving homeowners, builders, and multifamily projects across Utah
        </Reveal>

        <Reveal delay={400}>
          <p className="mx-auto mt-5 max-w-2xl text-foreground/70 md:mt-6">
            Premium granite, quartz, marble and quartzite. Hand fabricated in Utah for builders, designers and homeowners who care about the details no one is supposed to notice.
          </p>
        </Reveal>

        <Reveal delay={500} className="mt-7 flex justify-center md:mt-8">
          <a
            href="#contact"
            data-cursor="estimate"
            className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-8 py-4 text-xs font-medium tracking-[0.2em] text-cream md:px-10 md:py-5"
          >
            <span>Get an estimate</span>
            <span className="relative z-[2]">→</span>
          </a>
        </Reveal>
      </div>
    </section>
  );
}

function WhoWeAre() {
  return (
    <section className="relative mx-auto max-w-[1400px] px-6 py-16 md:px-10 md:py-24">
      <Reveal>
        <div className="flex items-center gap-3 text-foreground/60">
          <span className="h-px w-12 bg-foreground/40" />
          <span className="eyebrow">Who we are</span>
        </div>
      </Reveal>
      <Reveal delay={100} className="overflow-visible">
        <h2 className={`mt-4 max-w-2xl md:mt-5 ${sectionHeadingLight}`}>
          Built on craftsmanship since{" "}
          <span className="font-sans font-light tracking-[-0.02em]">1998</span>
        </h2>
      </Reveal>

      <div className="mt-8 grid grid-cols-1 items-stretch gap-6 md:mt-10 md:grid-cols-2 md:gap-8">
        <Reveal delay={100} className="group w-full min-w-0">
          <div className="relative min-h-[18rem] w-full overflow-hidden md:min-h-[28rem] ">
            <img
              src={aboutStoneBath}
              alt="Natural stone powder room with marble vanity crafted by Creative Granite + Design"
              loading="lazy"
              className="wwa-img absolute inset-0 h-full w-full object-cover transition-transform duration-[1400ms] ease-out will-change-transform group-hover:scale-[1.04]"
            />
          </div>
        </Reveal>

        <Reveal delay={300} className="flex w-full min-w-0 items-center">
          <p className="w-full text-foreground/70">
            Creative Granite <span style={{ fontFamily: "sans-serif" }}>+</span> Design is a Utah based stone fabrication company specializing in custom countertops and architectural
            surfaces. We partner with homeowners, builders, and designers to deliver precise fabrication, thoughtful material selection, and high quality installation across residential and multifamily residential projects in Utah, Idaho, and Wyoming.
          </p>
        </Reveal>
      </div>

      <style>{`
        @keyframes wwa-img-in {
          0% { opacity: 0; transform: scale(1.08); }
          100% { opacity: 1; transform: scale(1); }
        }
        .wwa-img { animation: wwa-img-in 1.4s cubic-bezier(0.2,0.8,0.2,1) both; }
      `}</style>
    </section>
  );
}

function Materials() {
  const [active, setActive] = useState(0);
  return (
    <section id="materials" className="relative bg-bone py-28 md:py-40">
      <div className="mx-auto max-w-[1400px] px-6 md:px-10">
        <div className="flex flex-wrap items-end justify-between gap-6">
          <Reveal>
            <div className="flex items-center gap-3 text-foreground/60">
              <span className="h-px w-12 bg-foreground/40" />
              <span className="eyebrow">Materials</span>
            </div>
            <h2 className={`mt-6 max-w-2xl ${sectionHeadingLight}`}>
              The slab decides everything.
            </h2>
          </Reveal>
          <Reveal delay={200}>
          <p className="max-w-sm text-foreground/70">
              Four core surfaces, each with its own temperament. We help you choose by feel, not just by sample.
            </p>
          </Reveal>
        </div>

        <div className="mt-16 grid grid-cols-1 gap-px overflow-hidden rounded-sm bg-foreground/15 md:grid-cols-2">
          {materials.map((m, i) => (
            <div
              key={m.name}
              onMouseEnter={() => setActive(i)}
              data-cursor="select"
              className={`group relative flex cursor-pointer flex-col overflow-hidden bg-cream p-8 transition-colors duration-700 md:p-12 ${
                active === i ? "bg-foreground text-cream" : ""
              }`}
            >
              <div className="img-zoom relative mb-8 aspect-[4/3] w-full overflow-hidden rounded-sm">
                <img
                  src={m.image}
                  alt={`${m.name} surface`}
                  loading="lazy"
                  className="h-full w-full object-cover"
                />
              </div>
              <div className="flex flex-1 flex-col">
                <div className="flex items-start justify-between">
                  <span className="font-mono text-xs opacity-60">0{i + 1}</span>
                  <span
                    className={`h-2 w-2 rounded-full transition-all duration-500 ${
                      active === i ? "bg-accent scale-150" : "bg-foreground/30"
                    }`}
                  />
                </div>
                <h3 className="mt-6 font-display text-5xl md:text-6xl">{m.name}</h3>
                <p
                  className={`mt-6 max-w-md transition-opacity ${
                    active === i ? "text-cream/90" : "text-foreground/70"
                  }`}
                >
                  {m.desc}
                </p>
                <div className="mt-10 flex items-center justify-between border-t border-current/20 pt-6 opacity-70">
                  <span className="eyebrow">Explore</span>
                  <span className="text-xl transition-transform duration-500 group-hover:translate-x-2">→</span>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function Work() {
  return (
    <section id="work" className="relative py-28 md:py-40">
      <div className="mx-auto max-w-[1400px] px-6 md:px-10">
        <div className="flex flex-wrap items-end justify-between gap-6">
          <Reveal>
            <div className="flex items-center gap-3 text-foreground/60">
              <span className="h-px w-12 bg-foreground/40" />
            <span className="eyebrow">Our work</span>
            </div>
            <h2 className={`mt-6 max-w-3xl ${sectionHeadingLight}`}>
              Fabricated with precision, installed with intention.
            </h2>
          </Reveal>
          <Reveal delay={200}>
            <p className="max-w-sm text-foreground/70">
            A selection of completed spaces, material details, and in between
            moments each reflecting our approach to stone, design, and execution.
            </p>
          </Reveal>
        </div>

        <div className="mt-16 grid grid-cols-2 gap-0 md:grid-cols-3">
          {portfolio.map((p, i) => {
            const [category, location] = p.tag.split("·").map((s) => s.trim());
            return (
              <Reveal key={i} delay={(i % 3) * 120} className="h-full">
                <div className="img-zoom group relative aspect-[4/3] h-[200px] w-full overflow-hidden rounded-none bg-bone md:h-full" data-cursor="view">
                  <img
                    src={p.src}
                    alt={p.title}
                    loading="lazy"
                    className="h-full w-full object-cover"
                  />
                  <div className="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/75 via-black/25 to-transparent" />
                  {/* <div className="absolute inset-x-0 bottom-0 p-6 text-cream md:p-7">
                    <div className="eyebrow text-cream/80">{category}</div>
                    <h3 className="mt-3 font-display text-2xl leading-tight md:text-3xl">{p.title}</h3>
                    {location && <p className="mt-1 text-sm text-cream/70">{location}</p>}
                  </div> */}
                </div>
              </Reveal>
            );
          })}
        </div>

        <Reveal delay={200} className="mt-12 flex justify-center md:mt-16">
          <a
            href="#"
            data-cursor="view"
            className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream"
          >
            <span>View Gallery</span>
            <span className="relative z-[2]">→</span>
          </a>
        </Reveal>
      </div>
    </section>
  );
}

function InstagramSection() {
  return (
    <section id="instagram" className="relative bg-bone py-28 md:py-40">
      <div className="mx-auto max-w-[1400px] px-6 md:px-10">
        <div className="flex flex-wrap items-end justify-between gap-6">
          <Reveal>
            <div className="flex items-center gap-3 text-foreground/60">
              <span className="h-px w-12 bg-foreground/40" />
              <span className="eyebrow">Instagram</span>
            </div>
            <h2 className={`mt-6 max-w-3xl ${sectionHeadingLight}`}>
              Follow our work.
            </h2>
          </Reveal>
          <Reveal delay={200}>
            <p className="max-w-sm text-foreground/70">
              Behind the scenes, slab selections, and finished installs  see what we are working on in the shop and in the field.
            </p>
          </Reveal>
        </div>

        <div className="mt-16 grid grid-cols-2 gap-0 md:grid-cols-3">
          {instagramPosts.map((post, i) => (
            <Reveal key={post.src} delay={(i % 3) * 100} className="h-full">
              <a
                href={INSTAGRAM_URL}
                target="_blank"
                rel="noopener noreferrer"
                data-cursor="view"
                className="img-zoom group relative block aspect-square h-full w-full overflow-hidden bg-ink"
              >
                <img
                  src={post.src}
                  alt={post.alt}
                  loading="lazy"
                  className="h-full w-full object-cover"
                />
                <div className="pointer-events-none absolute inset-0 bg-ink/0 transition-colors duration-500 group-hover:bg-ink/45" />
                <div className="pointer-events-none absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                  <span className="flex h-12 w-12 items-center justify-center rounded-full border border-cream/80 bg-cream/10 text-cream backdrop-blur-sm">
                    <Instagram className="h-5 w-5" strokeWidth={1.5} />
                  </span>
                </div>
              </a>
            </Reveal>
          ))}
        </div>

        <Reveal delay={200} className="mt-12 flex justify-center md:mt-16">
          <a
            href={INSTAGRAM_URL}
            target="_blank"
            rel="noopener noreferrer"
            data-cursor="follow"
            className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream"
          >
            <Instagram className="relative z-[2] h-4 w-4" strokeWidth={1.5} />
            <span>Follow on Instagram</span>
            <span className="relative z-[2]">→</span>
          </a>
        </Reveal>
      </div>
    </section>
  );
}

function Services() {
  return (
    <section id="services" className="relative bg-ink py-28 text-cream md:py-40">
      <div className="pointer-events-none absolute inset-0 grain opacity-40" />
      <div className="relative mx-auto max-w-[1400px] px-6 md:px-10">
        <Reveal>
          <div className="flex items-center gap-3 text-cream/60">
            <span className="h-px w-12 bg-cream/40" />
            <span className="eyebrow">Services</span>
          </div>
          <h2 className={`mt-6 max-w-2xl ${sectionHeadingDark}`}>
            Built for builders. Tailored for homes.
          </h2>
        </Reveal>

        <div className="mt-20 divide-y divide-cream/15 border-y border-cream/15">
          {services.map((s, i) => (
            <Reveal key={s.title} delay={i * 100}>
              <div
                className="group relative grid cursor-pointer grid-cols-12 gap-6 py-10 transition-colors duration-500 hover:bg-cream/[0.04] md:py-14"
                data-cursor="learn"
              >
                <div className="col-span-2 md:col-span-1">
                  <span className="font-mono text-sm opacity-50">0{i + 1}</span>
                </div>
                <div className="col-span-10 md:col-span-5">
                  <h3 className="font-display text-2xl transition-transform duration-500 group-hover:translate-x-2 md:text-5xl">
                    {s.title}
                  </h3>
                </div>
                <div className="col-span-12 md:col-span-5">
                  <p className="text-cream/70 md:text-lg">{s.body}</p>
                </div>
                <div className="col-span-12 flex items-center justify-end md:col-span-1">
                  <span className="text-2xl transition-transform duration-500 group-hover:rotate-45" style={{ fontFamily: "sans-serif" }}>+</span>
                </div>
              </div>
            </Reveal>
          ))}
        </div>

        <Reveal delay={300} className="mt-12 flex justify-center md:mt-16">
          <a
            href="#contact"
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

function Process() {
  return (
    <section id="process" className="relative py-28 md:py-40">
      <div className="mx-auto max-w-[1400px] px-6 md:px-10">
        <Reveal>
          <div className="flex items-center gap-3 text-foreground/60">
            <span className="h-px w-12 bg-foreground/40" />
            <span className="eyebrow">Project timeline</span>
          </div>
          <h2 className={`mt-6 max-w-3xl ${sectionHeadingLight}`}>
            Four steps, no surprises.
          </h2>
        </Reveal>

        <div className="mt-20 grid grid-cols-1 gap-px overflow-hidden bg-foreground/15 md:grid-cols-4">
          {process.map((p, i) => (
            <Reveal key={p.n} delay={i * 100} className="bg-cream">
              <div className="group h-full p-8 md:p-10">
                <div className="flex items-center justify-between">
                  <span className="font-mono text-xs text-foreground/50">{p.n}</span>
                  <span className="h-px w-8 bg-foreground/20 transition-all duration-500 group-hover:w-16 group-hover:bg-foreground" />
                </div>
                <h3 className="mt-16 font-display text-3xl md:text-4xl">{p.t}</h3>
                <p className="mt-4 text-sm leading-relaxed text-foreground/70">{p.d}</p>
              </div>
            </Reveal>
          ))}
        </div>
      </div>
    </section>
  );
}

function Remnants() {
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
          <p className="mt-8 max-w-xl text-cream/70 md:text-lg">
            Smaller pieces of stone, ideal for vanities, laundry rooms, and smaller projects. First come, first served — join our list for early access.
          </p>
          <div className="mt-10 flex flex-col gap-4 sm:flex-row">
            <a href="#contact" data-cursor="browse" className="btn-magnetic btn-magnetic-inverse inline-flex items-center gap-3 rounded-full border border-cream px-7 py-3.5 text-xs tracking-[0.2em]">
              <span>View available remnants</span>
              <span className="relative z-[2]">→</span>
            </a>
            <a href="#contact" className="inline-flex items-center gap-3 rounded-full border border-cream/30 px-7 py-3.5 text-xs tracking-[0.2em] text-cream/80 transition-colors hover:border-cream hover:text-cream">
              Join the remnant list
            </a>
          </div>
        </Reveal>
        <Reveal delay={200} className="col-span-12 md:col-span-5">
          <div className="img-zoom relative aspect-[4/5] overflow-hidden rounded-sm">
            <img src="/portfolio/Creative-Quartz-scaled-1.jpg" alt="Remnant slab" className="h-full w-full object-cover" />
          </div>
        </Reveal>
      </div>
    </section>
  );
}

function Testimonial() {
  const items = [
    { q: "We've used them on three builds now. Consistent quality, great communication, and they always hit our timelines. Wouldn't go anywhere else.", a: "Mark T.", r: "General contractor" },
    { q: "Their slab selection process is the most thoughtful in utah. The install crew left the space cleaner than they found it.", a: "Lauren P.", r: "Interior designer" },
    { q: "Countless multifamily projects, zero late deliveries. Creative is the partner you call when it has to be right.",
 a: "David R.", r: "Developer" },
  ];
  const [i, setI] = useState(0);
  useEffect(() => {
    const t = setInterval(() => setI((v) => (v + 1) % items.length), 6500);
    return () => clearInterval(t);
  }, [items.length]);
  const cur = items[i];
  return (
    <section className="relative py-28">
      <div className="mx-auto max-w-[1100px] px-6 text-center md:px-10">
        <Reveal>
          <div className="eyebrow text-foreground/60">Trusted across utah</div>
          <div className="mt-4 flex justify-center gap-1 text-accent">
            {Array.from({ length: 5 }).map((_, k) => (<span key={k}>★</span>))}
          </div>
          <blockquote key={i} className="mx-auto mt-4 max-w-3xl font-display text-[16px]  leading-tight text-foreground md:text-[20px] animate-in fade-in slide-in-from-bottom-4 duration-700">
            "{cur.q}"
          </blockquote>
          <div className="eyebrow mt-5 text-foreground/60">— {cur.a} · {cur.r}</div>
          <div className="mt-10 flex justify-center gap-2">
            {items.map((_, k) => (
              <button
                key={k}
                onClick={() => setI(k)}
                aria-label={`Testimonial ${k + 1}`}
                className={`h-1.5 rounded-full transition-all duration-500 ${k === i ? "w-10 bg-foreground" : "w-1.5 bg-foreground/30"}`}
              />
            ))}
          </div>
        </Reveal>
      </div>
    </section>
  );
}

function CTA() {
  return (
    <section id="contact" className="relative overflow-hidden bg-cream py-32">
      <div className="pointer-events-none absolute inset-0 noise-overlay" />
      <div className="relative mx-auto max-w-[1400px] px-6 text-center md:px-10">
        <Reveal>
          <div className="eyebrow text-foreground/60">Start your project</div>
          <h2 className={`mx-auto mt-8 max-w-4xl ${sectionHeadingLight}`}>
            Start your project
          </h2>
          <p className="mx-auto mt-10 max-w-xl text-lg text-foreground/70">
          “Whether you’re building a custom home, planning a remodel, 
or managing a multifamily or commercial project, our team is here to help bring 
it to life.”
          </p>
          <div className="mt-12 flex flex-col items-center gap-5">
            <a
              href="#"
              data-cursor="estimate"
              className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream"
            >
              <span>Get an estimate</span>
              <span className="relative z-[2]">→</span>
            </a>

            <a
              href={SHOWROOM_MAPS_URL}
              target="_blank"
              rel="noopener noreferrer"
              data-cursor="view"
              className="link-underline text-sm tracking-[0.2em] text-foreground/70 transition-colors hover:text-foreground"
            >
              Visit our showroom
            </a>

            <a
              href="#"
              data-cursor="appointment"
              className="btn-magnetic mt-2 inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream"
            >
              <span>Book an appointment</span>
              <span className="relative z-[2]">→</span>
            </a>
          </div>
        </Reveal>
      </div>
    </section>
  );
}

function Footer() {
  return (
    <footer className="relative bg-ink pt-20 text-cream">
      <div className="mx-auto max-w-[1400px] px-6 md:px-10">
        <div className="grid grid-cols-12 gap-8 border-b border-cream/15 pb-16">
          <div className="col-span-12 md:col-span-5">
            <a href="#top" className="inline-block">
              <img
                src={logo}
                alt="Creative Granite & Design"
                className="h-20 w-auto max-w-[260px] object-contain object-left sm:h-24 md:h-28"
              />
            </a>
            <p className=" max-w-[250px] text-cream/85 ">
            Built on craftsmanship. Serving Utah since 1998.
            </p>
            <a
              href="#contact"
              data-cursor="appointment"
              className="btn-magnetic btn-magnetic-inverse mt-6 inline-flex items-center gap-3 rounded-full border border-cream px-7 py-3.5 text-xs font-medium tracking-[0.2em] text-cream"
            >
              <span>Book appointment</span>
              <span className="relative z-[2]">→</span>
            </a>
          </div>
          <div className="col-span-6 md:col-span-2">
            <div className="eyebrow text-cream/50">Navigate</div>
            <ul className="mt-6 space-y-3">
              {(
                [
                  ["Work", "#work"],
                  ["Products", "#materials"],
                  ["Services", "#services"],
                  ["Process", "#process"],
                  ["Get an Estimate", "#contact"],
                ] as const
              ).map(([l, h]) => (
                <li key={l}>
                  <a href={h} className="link-underline text-cream/85">
                    {l}
                  </a>
                </li>
              ))}
            </ul>
          </div>
          <div className="col-span-6 md:col-span-2">
            <div className="eyebrow text-cream/50">Connect</div>
            <ul className="mt-6 space-y-3">
              {/* <li><a href="#" className="link-underline text-cream/85">Instagram</a></li>
              <li><a href="#" className="link-underline text-cream/85">Pinterest</a></li>
              <li><a href="#" className="link-underline text-cream/85">Houzz</a></li> */}
              <li><a href="#" className="link-underline text-cream/85">Instagram</a></li>
              <li><a href="#" className="link-underline text-cream/85">Facebook</a></li>
              <li><a href="#" className="link-underline text-cream/85">LinkedIn</a></li>
            </ul>
          </div>
          <div className="col-span-12 md:col-span-3">
            <div className="eyebrow text-cream/50">Visit</div>
            <div className="mt-6 space-y-1 text-cream/85">
              <div>1998 n redwood rd</div>
              <div>Salt lake city, ut 8<span style={{ fontFamily: "sans-serif" }}>4</span>116</div>

              <div className="mt-4">
                <div className="eyebrow text-cream/50">Hours</div>
                <p className="mt-2 leading-relaxed">
                  8am<span style={{ fontFamily: "sans-serif" }}> – </span>5pm
                  <span className="px-1.5 text-cream/35" style={{ fontFamily: "sans-serif" }}>·</span>
                  Mon<span style={{ fontFamily: "sans-serif" }}> – </span>Fri
                </p>
              </div>

              <div className="mt-4 space-y-1">
                <div><a href="tel:8015745477" className="link-underline"><span style={{ fontFamily: "sans-serif" }}>(</span>801<span style={{ fontFamily: "sans-serif" }}>)</span> 57<span style={{ fontFamily: "sans-serif" }}>4-</span>5<span style={{ fontFamily: "sans-serif" }}>4</span>77</a></div>
                <div><a href="mailto:info@creativegranite.com" className="link-underline">info<span style={{ fontFamily: "sans-serif" }}>@</span>creativegranite.com</a></div>
              </div>
            </div>
          </div>
        </div>

        <div className="flex flex-wrap items-center justify-between gap-4 py-8 text-xs text-cream/50">
          <div>© {new Date().getFullYear()} Creative granite <span style={{ fontFamily: "sans-serif" }}>&</span> design. All rights reserved.</div>
          <div className="font-mono tracking-widest">Built with intention.</div>
        </div>
      </div>
    </footer>
  );
}

function Index() {
  return (
    <main className="relative bg-cream text-foreground md:cursor-none">
      <LoadingScreen />
      <CustomCursor />
      <Header />
      <Hero />
      <HeroIntro />
      <WhoWeAre />
      <Materials />
      <Work />
      <InstagramSection />
      <Services />
      {/* <Process /> */}
      {/* <Remnants /> */}
      <Testimonial />
      <CTA />
      <Footer />
    </main>
  );
}
