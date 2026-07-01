import type {
  HeroSlide,
  InstagramPost,
  Material,
  NavLink,
  PortfolioItem,
  ProcessStep,
  SectionContent,
  Service,
  SiteSettings,
  SiteSocialLink,
  Testimonial,
} from "@/types/content";

export type SiteContentPayload = {
  settings: SiteSettings;
  heroSlides: HeroSlide[];
  portfolio: PortfolioItem[];
  instagramPosts: InstagramPost[];
  materials: Material[];
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
  },
  heroSlides: [],
  portfolio: [],
  instagramPosts: [],
  materials: [],
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
