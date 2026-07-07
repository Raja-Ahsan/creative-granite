/**
 * Static site content — will be replaced by API/CMS data during backend migration.
 */

import type {
  HeroSlide,
  InstagramPost,
  Material,
  NavLink,
  PortfolioItem,
  ProcessStep,
  Service,
  Testimonial,
} from "@/types/content";

export type {
  HeroSlide,
  InstagramPost,
  Material,
  NavLink,
  PortfolioItem,
  ProcessStep,
  Service,
  Testimonial,
} from "@/types/content";

export const SITE_IMAGES = {
  logo: "/images/site/update-logo.png",
  aboutStoneBath: "/images/site/LakeLine-20.jpg",
  slider1: "/images/site/slider1.jpg",
  slider2: "/images/site/slider2.jpg",
  slider3: "/images/site/slider3.jpg",
} as const;

export const INSTAGRAM_URL = "#";

export const SHOWROOM_MAPS_URL =
  "https://www.google.com/maps/place/1998+N+Redwood+Rd,+Salt+Lake+City,+UT+84116,+USA/@40.8115045,-111.9402546,16.96z/data=!4m6!3m5!1s0x8752f6bad3a740e7:0x54da835cc07f3b51!8m2!3d40.8115002!4d-111.9376702!16s%2Fg%2F11c1zjtg8r?entry=ttu&g_ep=EgoyMDI2MDYyMy4wIKXMDSoASAFQAw%3D%3D";

export const heroSlides: HeroSlide[] = [
  { src: SITE_IMAGES.slider1, alt: "Luxury kitchen with marble countertops and stone backsplash" },
  { src: SITE_IMAGES.slider2, alt: "Bright modern kitchen with white stone island" },
  { src: SITE_IMAGES.slider3, alt: "Double-island kitchen with sage cabinetry and stone surfaces" },
];

export const portfolio: PortfolioItem[] = [
  { src: "/portfolio/DSC_4182_1.jpg", title: "Carrara Island", tag: "Marble · Salt Lake" },
  { src: "/portfolio/024.jpg", title: "Modern Kitchen", tag: "Granite · Salt Lake" },
  { src: "/portfolio/portfolio_2.jpg", title: "Refined Hearth", tag: "Quartz · Provo" },
  { src: "/portfolio/067.jpg", title: "Warm Minimal", tag: "Quartzite · Holladay" },
  { src: "/portfolio/portfolio_3.jpg", title: "Architectural", tag: "Marble · Draper" },
  { src: "/portfolio/051.jpg", title: "Quiet Movement", tag: "Granite · Ogden" },
  { src: "/portfolio/009-1.jpg", title: "Coastal Kitchen", tag: "Quartzite · St. George" },
  { src: "/portfolio/Creative-Quartz-scaled-1.jpg", title: "Creative Quartz", tag: "Quartz · Showroom" },
  { src: "/portfolio/DSC_4182_1.jpg", title: "Carrara Island", tag: "Marble · Salt Lake" },
];

export const instagramPosts: InstagramPost[] = [
  { src: "/portfolio/instagram/DSC_3969.jpg", alt: "Creative Granite stone fabrication — DSC_3969" },
  { src: "/portfolio/instagram/DSC_3986%20(1).jpg", alt: "Creative Granite stone fabrication — DSC_3986 (1)" },
  { src: "/portfolio/instagram/DSC_4008.jpg", alt: "Creative Granite stone fabrication — DSC_4008" },
  { src: "/portfolio/instagram/DSC_4011.jpg", alt: "Creative Granite stone fabrication — DSC_4011" },
  { src: "/portfolio/instagram/DSC_4068.jpg", alt: "Creative Granite stone fabrication — DSC_4068" },
  { src: "/portfolio/instagram/DSC_4165.jpg", alt: "Creative Granite stone fabrication — DSC_4165" },
  { src: "/portfolio/instagram/DSC_4181%20(1).jpg", alt: "Creative Granite stone fabrication — DSC_4181 (1)" },
  { src: "/portfolio/instagram/DSC_4192.jpg", alt: "Creative Granite stone fabrication — DSC_4192" },
  { src: "/portfolio/instagram/DSC_4204%20(1).jpg", alt: "Creative Granite stone fabrication — DSC_4204 (1)" },
  { src: "/portfolio/instagram/Journeys%20End-12.jpg", alt: "Creative Granite stone fabrication — Journeys End-12" },
  { src: "/portfolio/instagram/LakeLine-20.jpg", alt: "Creative Granite stone fabrication — LakeLine-20" },
  { src: "/portfolio/instagram/Sabal-24.jpg", alt: "Creative Granite stone fabrication — Sabal-24" },
];

export const materials: Material[] = [
  {
    name: "Granite",
    desc: "A durable natural stone known for its strength and variation. A reliable choice for kitchens and high-use surfaces.",
    image: "/materials/granite.webp",
  },
  {
    name: "Quartz",
    desc: "An engineered surface designed for consistency and low maintenance, offering a wide range of colors and styles.",
    image: "/materials/quartz.webp",
  },
  {
    name: "Marble",
    desc: "A natural stone known for soft movement and timeless appeal, often used in bathrooms and feature areas.",
    image: "/materials/marble.webp",
  },
  {
    name: "Quartzite",
    desc: "A natural stone valued for durability and distinctive movement, ideal for kitchens and high-traffic spaces.",
    image: "/materials/quartzite.webp",
  },
];

export const services: Service[] = [
  {
    title: "New Construction",
    slug: "new-construction",
    excerpt: "Stone fabrication for new builds, working closely with builders, designers, and project teams to ensure accuracy, efficiency, and consistency from planning through installation.",
    body: "<p>Stone fabrication for new builds, working closely with builders, designers, and project teams to ensure accuracy, efficiency, and consistency from planning through installation.</p>",
  },
  {
    title: "Remodel & Renovation",
    slug: "remodel-renovation",
    excerpt: "Custom stone surfaces for kitchen, bathroom, and interior remodels focused on thoughtful material selection and clean execution.",
    body: "<p>Custom stone surfaces for kitchen, bathroom, and interior remodels focused on thoughtful material selection and clean execution.</p>",
  },
  {
    title: "Multifamily & Commercial",
    slug: "multifamily-commercial",
    excerpt: "Custom stone fabrication for multifamily and commercial projects, supporting developers, contractors, and project teams with efficient execution, consistent quality, and dependable delivery.",
    body: "<p>Custom stone fabrication for multifamily and commercial projects, supporting developers, contractors, and project teams with efficient execution, consistent quality, and dependable delivery.</p>",
  },
];

export const processSteps: ProcessStep[] = [
  { n: "01", t: "Initial Consultation", d: "We discuss your project, timeline, and budget in our showroom or on-site." },
  { n: "02", t: "Estimate & Material Selection", d: "We provide a detailed quote and guide you through slab selection from our inventory." },
  { n: "03", t: "Template & Measurement", d: "Our team templates your space with precision for a perfect fit no guesswork." },
  { n: "04", t: "Fabrication & Install", d: "Hand finished edges, sealed surfaces, and a clean, on schedule installation." },
];

export const testimonials: Testimonial[] = [
  {
    q: "We've used them on three builds now. Consistent quality, great communication, and they always hit our timelines. Wouldn't go anywhere else.",
    a: "Mark T.",
    r: "General contractor",
  },
  {
    q: "Their slab selection process is the most thoughtful in utah. The install crew left the space cleaner than they found it.",
    a: "Lauren P.",
    r: "Interior designer",
  },
  {
    q: "Multifamily project, 120 units, zero late deliveries. Creative is the partner you call when it has to be right.",
    a: "David R.",
    r: "Developer",
  },
];

export const navLeft: NavLink[] = [
  ["Work", "#work"],
  ["Products", "#products"],
  ["Services", "#services"],
];

export const navRight: NavLink[] = [
  ["Process", "#process"],
  ["Contact", "#contact"],
];

export const footerNavLinks = ["Work", "Products", "Services", "Process", "Get an Estimate"] as const;

export const footerSocialLinks = ["Instagram", "Facebook", "LinkedIn"] as const;
