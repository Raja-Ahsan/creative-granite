import type {
  GalleryAlbum,
  HeroSlide,
  InstagramPost,
  Material,
  NavLink,
  PortfolioItem,
  ProcessStep,
  Product,
  ProjectTypeOption,
  SectionContent,
  Service,
  SiteSettings,
  SiteSocialLink,
  Testimonial,
} from "@/types/content";

export type SiteContentPayload = {
  settings: SiteSettings;
  projectTypes: ProjectTypeOption[];
  heroSlides: HeroSlide[];
  portfolio: PortfolioItem[];
  galleryAlbums: GalleryAlbum[];
  instagramPosts: InstagramPost[];
  materials: Material[];
  products: Product[];
  services: Service[];
  processSteps: ProcessStep[];
  testimonials: Testimonial[];
  navLeft: NavLink[];
  navRight: NavLink[];
  footerNavLinks: NavLink[];
  footerSocialLinks: SiteSocialLink[];
  sections: Record<string, SectionContent>;
};

declare global {
  interface Window {
    __SITE_CONTENT__?: SiteContentPayload;
  }
}

export const defaultSiteContent: SiteContentPayload = {
  settings: {
    logo: "/images/site/update-logo.png",
    aboutStoneBath: "/images/site/LakeLine-20.jpg",
    instagramUrl: "#",
    showroomMapsUrl: "",
    addressLine1: "",
    addressLine2: "",
    phone: "",
    email: "",
    hours: "",
    foundedYear: "1998",
    footerTagline: "Built on craftsmanship. Serving Utah since 1998.",
    contactFormIntro: "Tell us about your project — we will follow up with next steps, timing, and a path to estimate.",
  },
  projectTypes: [],
  heroSlides: [],
  portfolio: [],
  galleryAlbums: [],
  instagramPosts: [],
  materials: [],
  products: [],
  services: [],
  processSteps: [],
  testimonials: [],
  navLeft: [],
  navRight: [],
  footerNavLinks: [],
  footerSocialLinks: [],
  sections: {},
};

export function getInitialSiteContent(): SiteContentPayload {
  return window.__SITE_CONTENT__ ?? defaultSiteContent;
}
