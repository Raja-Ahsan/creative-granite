import { useEffect, useRef, useState } from "react";

export function SplitText({
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
    <span
      ref={ref}
      className={`split-line inline-block overflow-hidden align-baseline ${seen ? "in" : ""} ${className}`}
    >
      {text.split(" ").map((word, wi) => (
        <span
          key={wi}
          className={`inline-block overflow-hidden align-baseline ${dense ? "py-0" : "py-[0.15em]"} ${wrap ? "pr-[0.2em]" : "whitespace-nowrap pr-[0.25em]"}`}
        >
          {word.split("").map((c, ci) => (
            <span
              key={ci}
              className="split-char"
              style={{ transitionDelay: `${wi * 60 + ci * 18}ms` }}
            >
              {c}
            </span>
          ))}
        </span>
      ))}
    </span>
  );
}
