export type HeroSlide = { src: string; alt: string };
export type PortfolioItem = { src: string; title: string; tag: string };
export type InstagramPost = { src: string; alt: string; url?: string };
export type Material = { name: string; desc: string; image: string };
export type Service = {
  title: string;
  slug: string;
  excerpt: string;
  body: string;
  mainImage?: string | null;
};

export type ServiceDetail = Service;
export type ProcessStep = { n: string; t: string; d: string };
export type Testimonial = { q: string; a: string; r: string };
export type NavLink = readonly [label: string, href: string];
export type SiteSocialLink = { label: string; url: string };

export type SiteSettings = {
  logo: string;
  aboutStoneBath: string;
  instagramUrl: string;
  showroomMapsUrl: string;
  addressLine1: string;
  addressLine2: string;
  phone: string;
  email: string;
  hours: string;
  foundedYear: string;
  footerTagline: string;
};

export type SectionContent = {
  eyebrow?: string | null;
  heading?: string | null;
  subheading?: string | null;
  body?: string | null;
  highlightText?: string | null;
  image?: string | null;
};
