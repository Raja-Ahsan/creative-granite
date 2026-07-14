export type HeroSlide = { src: string; alt: string };
export type PortfolioItem = { src: string; title: string; tag: string; featured?: boolean };
export type InstagramPost = { src: string; alt: string; url?: string };
export type Material = { name: string; desc: string; image: string };
export type ProductImage = { src: string; alt: string };
export type Product = {
  name: string;
  slug: string;
  desc: string;
  description: string;
  image: string;
  relatedImages: ProductImage[];
};
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
export type ProjectTypeOption = { value: string; label: string };

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
  contactFormIntro: string;
};

export type SectionContent = {
  eyebrow?: string | null;
  heading?: string | null;
  subheading?: string | null;
  body?: string | null;
  highlightText?: string | null;
  image?: string | null;
};
