import { createFileRoute } from "@tanstack/react-router";
import { useEffect, useRef, useState } from "react";
import logo from "@/assets/logo-cgd.png";
import aboutStoneBath from "@/assets/about-stone-bath.jpg";
import { Reveal } from "@/components/site/Reveal";
import { CustomCursor } from "@/components/site/CustomCursor";
import { LoadingScreen } from "@/components/site/LoadingScreen";

export const Route = createFileRoute("/")({
  component: Index,
});

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
  { src: "/portfolio/DSC_4076.jpg", title: "Calacatta Hearth", tag: "Marble · Park City" },
  { src: "/portfolio/DSC_3988.jpg", title: "Hill Country Kitchen", tag: "Quartzite · Holladay" },
];

const materials = [
  { name: "Granite", desc: "Durable natural stone known for its strength and variation. A reliable choice for kitchens and high-use surfaces.", image: "/materials/granite.png" },
  { name: "Quartz", desc: "Engineered surface designed for consistency and low maintenance, offering a wide range of colors and styles.", image: "/materials/quartz.png" },
  { name: "Marble", desc: "Natural stone known for soft movement and timeless appeal, often used in bathrooms and feature areas." },
  { name: "Quartzite", desc: "Natural stone valued for durability and distinctive movement, ideal for kitchens and high-traffic spaces." },
];

const services = [
  { title: "Builder & Designer", body: "Collaborative work on custom homes and design-driven spaces, with a focus on precision and coordination." },
  { title: "New Construction", body: "Streamlined fabrication and dependable scheduling for residential developments across the wasatch front." },
  { title: "Multifamily & Commercial", body: "Large-scale fabrication for apartments, condos and commercial projects—built for consistency and efficiency." },
  { title: "Remodel & Renovation", body: "Replacement countertops, vanities and fireplaces shaped to existing architecture without compromise." },
];

const process = [
  { n: "01", t: "Initial Consultation", d: "We discuss your project, timeline, and budget—in our showroom or on-site." },
  { n: "02", t: "Estimate & Material Selection", d: "We provide a detailed quote and guide you through slab selection from our inventory." },
  { n: "03", t: "Template & Measurement", d: "Our team templates your space with precision for a perfect fit — no guesswork." },
  { n: "04", t: "Fabrication & Install", d: "Hand-finished edges, sealed surfaces, and a clean, on-schedule installation." },
];

function SplitText({ text, className = "" }: { text: string; className?: string }) {
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
    <span ref={ref} className={`split-line inline-block overflow-hidden align-baseline ${seen ? "in text-8xl font-normal" : ""} ${className}`}>
      {text.split(" ").map((word, wi) => (
        <span key={wi} className="inline-block overflow-hidden whitespace-nowrap pr-[0.25em] align-baseline py-[10px]">
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
  const nav = [
    ["Work", "#work"],
    ["Materials", "#materials"],
    ["Services", "#services"],
    ["Process", "#process"],
    ["Remnants", "#remnants"],
    ["Contact", "#contact"],
  ] as const;
  return (
    <header
      className={`fixed inset-x-0 top-0 z-50 transition-all duration-500 ${
        scrolled ? "bg-ink/95 backdrop-blur-md border-b border-cream/10" : "bg-ink/70 backdrop-blur-sm"
      } text-cream`}
    >
      <div className="mx-auto flex max-w-[1400px] items-center justify-between px-6 py-5 md:px-10">
        <a href="#top" className="flex items-center gap-3" data-cursor="home">
          <img src={logo} alt="Creative Granite & Design" className="h-24 w-auto object-contain md:h-32" />
        </a>
        <nav className="hidden items-center gap-8 md:flex">
          {nav.map(([l, h]) => (
            <a key={l} href={h} className="link-underline text-sm font-medium text-cream/80 hover:text-cream">
              {l}
            </a>
          ))}
        </nav>
        <a
          href="#contact"
          data-cursor="estimate"
          className="btn-magnetic btn-magnetic-inverse group hidden items-center gap-2 rounded-full border border-cream px-5 py-2.5 text-xs font-medium tracking-[0.18em] text-cream md:inline-flex"
        >
          <span>Get an estimate</span>
          <span className="relative z-[2] inline-block transition-transform group-hover:translate-x-1">→</span>
        </a>
        <button
          aria-label="Menu"
          onClick={() => setOpen((v) => !v)}
          className="flex h-10 w-10 items-center justify-center md:hidden"
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
            {nav.map(([l, h]) => (
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
    <section ref={ref} id="top" className="relative min-h-[100svh] overflow-hidden bg-ink pt-32 text-cream md:pt-40">
      {/* Hero background video — sits behind the headline */}
      <video
        src="/hero.mp4"
        autoPlay
        loop
        muted
        playsInline
        preload="auto"
        className="pointer-events-none absolute inset-0 h-full w-full object-cover opacity-70"
        style={{ transform: `translateY(${y * 0.15}px) scale(1.05)` }}
      />
      <div className="pointer-events-none absolute inset-0 bg-gradient-to-b from-ink/40 via-ink/20 to-ink/85" />
      <div className="pointer-events-none absolute inset-0 noise-overlay opacity-40" />
      <div
        className="pointer-events-none absolute -right-32 -top-32 h-[600px] w-[600px] rounded-full opacity-30 blur-3xl"
        style={{ background: "radial-gradient(circle, rgba(170,130,80,0.5), transparent 70%)", transform: `translateY(${y * 0.6}px)` }}
      />
      <div
        className="pointer-events-none absolute -bottom-40 -left-40 h-[700px] w-[700px] rounded-full opacity-25 blur-3xl"
        style={{ background: "radial-gradient(circle, rgba(60,40,20,0.6), transparent 70%)", transform: `translateY(${y * -0.4}px)` }}
      />

      <div className="relative grid max-w-[1400px] grid-cols-12 gap-6 self-end pl-6 pr-6 md:absolute md:bottom-10 md:left-10 md:right-auto md:pl-0 md:pr-0">
        <div className="col-span-12 flex items-center gap-3 md:col-span-6">
          <span className="h-px w-12 bg-cream/50" />
          <span className="eyebrow text-cream/70 tracking-[0.2em]">Welcome to creative granite &amp; design</span>
        </div>

        <h1 className="col-span-12 mt-6 font-display leading-[0.95] tracking-[-0.03em]">
          <span className="block text-4xl md:text-5xl lg:text-6xl">
            <SplitText text="Countertops, Vanities," />
            <br />
            <SplitText text="Fireplaces & More" />
          </span>
          <span className="mt-4 block text-2xl italic text-cream/85 md:text-3xl lg:text-4xl"></span>
        </h1>

        <div className="col-span-12 mt-10 grid grid-cols-12 gap-6 md:mt-16">
          <Reveal delay={400} className="col-span-12 md:col-span-5 md:col-start-1">
            <p className="text-base leading-relaxed text-cream/80 md:text-lg">
              Premium granite, quartz, marble and quartzite. Hand-fabricated in Utah for builders, designers and homeowners who care about the details no one is supposed to notice.
            </p>
          </Reveal>
          <Reveal delay={600} className="col-span-12 md:col-span-5 md:col-start-8 md:flex md:justify-end">
            <div className="flex flex-col items-start gap-3 md:items-end">
              <a href="#work" data-cursor="explore" className="btn-magnetic btn-magnetic-inverse inline-flex items-center gap-3 rounded-full border border-cream px-7 py-3.5 text-xs font-medium tracking-[0.2em] text-cream">
                <span>View our work</span>
                <span className="relative z-[2]">→</span>
              </a>
              <a href="#contact" className="link-underline text-xs font-medium tracking-[0.2em] text-cream/70">
                Or — get an estimate
              </a>
            </div>
          </Reveal>
        </div>

      </div>
    </section>
  );
}

function Marquee() {
  const items = ["Kitchen islands", "Vanities", "Fireplaces", "Commercial", "Countertops", "Outdoor", "Backsplashes", "Multi-family", "Tabletops"];
  const row = [...items, ...items];
  return (
    <section className="relative overflow-hidden border-y border-foreground/10 bg-ink py-6 text-cream">
      <div className="flex w-max gap-16 whitespace-nowrap marquee-track">
        {row.map((s, i) => (
          <span key={i} className="flex items-center gap-16 font-display text-3xl md:text-5xl">
            {s}
            <span className="text-accent">✦</span>
          </span>
        ))}
      </div>
    </section>
  );
}

function WhoWeAre() {
  return (
    <section className="relative mx-auto max-w-[1400px] px-6 py-28 md:px-10 md:py-40">
      <Reveal>
        <div className="flex items-center gap-3 text-foreground/60">
          <span className="h-px w-12 bg-foreground/40" />
            <span className="eyebrow">Who we are</span>
        </div>
      </Reveal>
      <h2 className="mt-8 max-w-5xl font-display text-5xl leading-[1.02] md:text-7xl lg:text-[6.5rem]">
        <SplitText text="Precision fabrication." />
        <br />
        <span className="italic text-foreground/80"><SplitText text="Thoughtful design." /></span>
      </h2>
      <div className="mt-16 grid grid-cols-12 gap-6 md:gap-10 items-center">
        <Reveal delay={100} className="col-span-12 md:col-span-6 group">
          <div className="relative overflow-hidden aspect-[4/5] md:aspect-[5/6]">
            <img
              src={aboutStoneBath}
              alt="Natural stone powder room with marble vanity crafted by Creative Granite + Design"
              loading="lazy"
              className="absolute inset-0 h-full w-full object-cover will-change-transform transition-transform duration-[1400ms] ease-out group-hover:scale-[1.04] wwa-img"
            />
          </div>
        </Reveal>
        <Reveal delay={300} className="col-span-12 md:col-span-5 md:col-start-8">
          <p className="text-lg leading-relaxed text-foreground/75">
            For two decades, Creative Granite & Design has shaped natural stone for the homes, hotels and gathering places of the Wasatch Front. Five installation crews, one obsession — surfaces that quietly anchor the rooms they live in.
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
            <h2 className="mt-6 max-w-3xl font-display text-5xl leading-[1.02] md:text-7xl">
              The slab decides <span className="italic">everything.</span>
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
              className={`group relative cursor-pointer bg-cream p-8 md:p-12 ${
                active === i && !m.image ? "bg-foreground text-cream" : ""
              } ${m.image ? "[perspective:1400px]" : "overflow-hidden transition-all duration-700"}`}
            >
              {m.image ? (
                <div className="relative h-full min-h-[360px] w-full transition-transform duration-[900ms] [transform-style:preserve-3d] ease-[cubic-bezier(0.2,0.8,0.2,1)] group-hover:[transform:rotateY(180deg)]">
                  <div className="absolute inset-0 flex flex-col [backface-visibility:hidden]">
                    <div className="flex items-start justify-between">
                      <span className="font-mono text-xs opacity-60">0{i + 1}</span>
                      <span className={`h-2 w-2 rounded-full transition-all duration-500 ${active === i ? "bg-accent scale-150" : "bg-foreground/30"}`} />
                    </div>
                    <h3 className="mt-12 font-display text-5xl md:text-6xl">{m.name}</h3>
                    <p className="mt-6 max-w-md text-sm leading-relaxed opacity-70">{m.desc}</p>
                    <div className="mt-auto flex items-center justify-between border-t border-current/20 pt-6 opacity-70">
                      <span className="eyebrow">Explore</span>
                      <span className="text-xl">→</span>
                    </div>
                  </div>
                  <div
                    className="absolute inset-0 overflow-hidden bg-cover bg-center [backface-visibility:hidden] [transform:rotateY(180deg)]"
                    style={{ backgroundImage: `url(${m.image})` }}
                  >
                    <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent" />
                    <div className="relative flex h-full flex-col p-2 text-cream">
                      <span className="font-mono text-xs opacity-80">0{i + 1}</span>
                      <h3 className="mt-auto font-display text-5xl md:text-6xl [text-shadow:0_2px_18px_rgba(0,0,0,0.7)]">{m.name}</h3>
                    </div>
                  </div>
                </div>
              ) : (
                <>
                  <div className="flex items-start justify-between">
                    <span className="font-mono text-xs opacity-60">0{i + 1}</span>
                    <span className={`h-2 w-2 rounded-full transition-all duration-500 ${active === i ? "bg-accent scale-150" : "bg-foreground/30"}`} />
                  </div>
                  <h3 className="mt-12 font-display text-5xl md:text-6xl">{m.name}</h3>
                  <p className={`mt-6 max-w-md text-sm leading-relaxed transition-opacity ${active === i ? "opacity-90" : "opacity-70"}`}>
                    {m.desc}
                  </p>
                  <div className="mt-10 flex items-center justify-between border-t border-current/20 pt-6 opacity-70">
                    <span className="eyebrow">Explore</span>
                    <span className="text-xl transition-transform duration-500 group-hover:translate-x-2">→</span>
                  </div>
                </>
              )}
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
            <h2 className="mt-6 max-w-3xl font-display text-5xl leading-[1.02] md:text-7xl">
              Completed spaces, <br />
              <span className="italic">seen up close.</span>
            </h2>
          </Reveal>
          <Reveal delay={200}>
            <p className="max-w-sm text-foreground/70">
              A selection of completed spaces, material details, and in-between moments — each reflecting our approach to stone, design, and execution.
            </p>
          </Reveal>
        </div>

        <div className="mt-16 grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 lg:grid-cols-3">
          {portfolio.map((p, i) => {
            const [category, location] = p.tag.split("·").map((s) => s.trim());
            return (
              <Reveal key={i} delay={(i % 3) * 120}>
                <div className="img-zoom group relative aspect-[4/3] h-full overflow-hidden rounded-sm bg-bone" data-cursor="view">
                  <img
                    src={p.src}
                    alt={p.title}
                    loading="lazy"
                    className="h-full w-full object-cover"
                  />
                  <div className="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/75 via-black/25 to-transparent" />
                  <div className="absolute inset-x-0 bottom-0 p-6 text-cream md:p-7">
                    <div className="eyebrow text-cream/80">{category}</div>
                    <h3 className="mt-3 font-display text-2xl leading-tight md:text-3xl">{p.title}</h3>
                    {location && <p className="mt-1 text-sm text-cream/70">{location}</p>}
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
          <h2 className="mt-6 max-w-4xl font-display text-5xl leading-[1.02] md:text-7xl">
            Built for <span className="italic">builders.</span><br />
            Tailored for <span className="italic">homes.</span>
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
                  <h3 className="font-display text-3xl transition-transform duration-500 group-hover:translate-x-2 md:text-5xl">
                    {s.title}
                  </h3>
                </div>
                <div className="col-span-12 md:col-span-5">
                  <p className="text-cream/70 md:text-lg">{s.body}</p>
                </div>
                <div className="col-span-12 flex items-center justify-end md:col-span-1">
                  <span className="text-2xl transition-transform duration-500 group-hover:rotate-45">+</span>
                </div>
              </div>
            </Reveal>
          ))}
        </div>
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
          <h2 className="mt-6 max-w-3xl font-display text-5xl leading-[1.02] md:text-7xl">
            Four steps, <span className="italic">no surprises.</span>
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
          <h2 className="mt-6 font-display text-5xl leading-[1.02] md:text-7xl lg:text-8xl">
            Great stone at a <span className="italic text-accent">great value.</span>
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
    { q: "Multifamily project, 120 units, zero late deliveries. Creative is the partner you call when it has to be right.", a: "David R.", r: "Developer" },
  ];
  const [i, setI] = useState(0);
  useEffect(() => {
    const t = setInterval(() => setI((v) => (v + 1) % items.length), 6500);
    return () => clearInterval(t);
  }, [items.length]);
  const cur = items[i];
  return (
    <section className="relative py-28 md:py-40">
      <div className="mx-auto max-w-[1100px] px-6 text-center md:px-10">
        <Reveal>
          <div className="eyebrow text-foreground/60">Trusted across utah</div>
          <div className="mt-8 flex justify-center gap-1 text-accent">
            {Array.from({ length: 5 }).map((_, k) => (<span key={k}>★</span>))}
          </div>
          <blockquote key={i} className="mx-auto mt-10 max-w-3xl font-display text-3xl italic leading-tight text-foreground md:text-5xl animate-in fade-in slide-in-from-bottom-4 duration-700">
            "{cur.q}"
          </blockquote>
          <div className="eyebrow mt-10 text-foreground/60">— {cur.a} · {cur.r}</div>
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
    <section id="contact" className="relative overflow-hidden bg-cream py-32 md:py-48">
      <div className="pointer-events-none absolute inset-0 noise-overlay" />
      <div className="relative mx-auto max-w-[1400px] px-6 text-center md:px-10">
        <Reveal>
          <div className="eyebrow text-foreground/60">Start your project</div>
          <h2 className="mt-8 font-display text-[16vw] leading-[0.9] md:text-[12rem]">
            Start your <br />
            <span className="italic">Project.</span>
          </h2>
          <p className="mx-auto mt-10 max-w-xl text-lg text-foreground/70">
            Whether you're building new, remodeling, or sourcing stone for a large development — we'd love to hear from you.
          </p>
          <div className="mt-12 flex flex-col items-center justify-center gap-4 sm:flex-row">
            <a href="https://creativeestimator.com/" data-cursor="estimate" className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs tracking-[0.25em] text-cream">
              <span>Get an estimate</span>
              <span className="relative z-[2]">→</span>
            </a>
            <a href="mailto:info@creativegranite.com" className="link-underline text-sm tracking-[0.2em] text-foreground/70">
              info@creativegranite.com
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
            <div className="font-display text-5xl md:text-7xl">
              Creative<br />
              <span className="italic text-cream/60">Granite + Design</span>
            </div>
            <p className="mt-6 max-w-sm text-cream/60">
              Fabricated with precision, installed with intention. Serving utah, idaho and wyoming since 2002.
            </p>
          </div>
          <div className="col-span-6 md:col-span-2">
            <div className="eyebrow text-cream/50">Navigate</div>
            <ul className="mt-6 space-y-3">
              {["Work", "Materials", "Services", "Process", "Remnants"].map((l) => (
                <li key={l}><a href={`#${l.toLowerCase()}`} className="link-underline text-cream/85">{l}</a></li>
              ))}
            </ul>
          </div>
          <div className="col-span-6 md:col-span-2">
            <div className="eyebrow text-cream/50">Connect</div>
            <ul className="mt-6 space-y-3">
              <li><a href="https://www.instagram.com/creativegraniteanddesign/" className="link-underline text-cream/85">Instagram</a></li>
              <li><a href="#" className="link-underline text-cream/85">Pinterest</a></li>
              <li><a href="#" className="link-underline text-cream/85">Houzz</a></li>
            </ul>
          </div>
          <div className="col-span-12 md:col-span-3">
            <div className="eyebrow text-cream/50">Visit</div>
            <div className="mt-6 space-y-1 text-cream/85">
              <div>1998 n redwood rd</div>
              <div>Salt lake city, ut 84116</div>
              <div className="mt-4"><a href="tel:8015745477" className="link-underline">(801) 574-5477</a></div>
              <div><a href="mailto:info@creativegranite.com" className="link-underline">info@creativegranite.com</a></div>
            </div>
          </div>
        </div>

        <div className="flex flex-wrap items-center justify-between gap-4 py-8 text-xs text-cream/50">
          <div>© {new Date().getFullYear()} Creative granite & design. All rights reserved.</div>
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
      <Marquee />
      <WhoWeAre />
      <Materials />
      <Work />
      <Services />
      <Process />
      <Remnants />
      <Testimonial />
      <CTA />
      <Footer />
    </main>
  );
}
