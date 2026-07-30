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
  ServicesPageContent,
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
  servicesPage: ServicesPageContent;
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
  servicesPage: {
    eyebrow: "Services",
    heading: "Stone Fabrication for Every Stage of Your Project.",
    body: "From custom homes and remodels to multifamily and commercial spaces, we fabricate, install, and support premium stone surfaces built to last.",
    heroImage: "/images/services/hero.png",
    sections: [],
    repairs: {
      number: "04",
      eyebrow: "Repairs & Warranty",
      heading: "Stand Behind Every Installation",
      body: "Our commitment doesn't end after installation. We provide warranty support for qualifying workmanship and offer repair services to help keep your stone surfaces looking their best.",
      image: "/images/services/repairs-hero-voyager.png",
      warrantyTitle: "Warranty",
      warrantyPoints: [
        "One-year workmanship warranty",
        "Warranty support for qualifying fabrication and installation issues",
        "Dedicated service team",
      ],
      warrantyCta: "Request a Warranty Repair.",
      repairsTitle: "Repairs",
      repairsPoints: [
        "Repair services available by request",
        "Contact us for an evaluation and quote",
      ],
      repairsCta: "Request a Repair Estimate",
    },
    cta: {
      heading: "Ready to Start Your Project?",
      body: "Whether you're building a custom home, remodeling an existing space, or managing a multifamily or commercial project, our team is ready to bring your vision to life.",
      button: "Get an Estimate",
    },
  },
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
