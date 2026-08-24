export type HeroSlide = { src: string; alt: string };
export type PortfolioItem = { src: string; title: string; tag: string; featured?: boolean };
export type GalleryAlbum = {
  slug: string;
  title: string;
  kind: "category" | "project";
  cover: string;
  gallery: string;
  images: string[];
};
export type InstagramPost = { src: string; alt: string; url?: string };
export type Material = { name: string; desc: string; image: string; sortOrder?: number; featured?: boolean };
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

export type ServicePageSection = {
  number: string;
  title: string;
  body: string;
  hero: string;
  supporting: string[];
};

export type ServicesPageContent = {
  eyebrow: string;
  heading: string;
  body: string;
  heroImage: string;
  sections: ServicePageSection[];
  repairs: {
    number: string;
    eyebrow: string;
    heading: string;
    body: string;
    image: string;
    warrantyTitle: string;
    warrantyPoints: string[];
    warrantyCta: string;
    repairsTitle: string;
    repairsPoints: string[];
    repairsCta: string;
  };
  cta: {
    heading: string;
    body: string;
    button: string;
  };
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
  secondaryImage?: string | null;
};
