import type { ComponentType } from "react";
import { ContactPage } from "./ContactPage";
import { GalleryPage } from "./GalleryPage";
import { HomePage } from "./HomePage";
import { ServiceDetailPage } from "./ServiceDetailPage";
import { ServicesPage } from "./ServicesPage";
import { WorkGalleryPage } from "./WorkGalleryPage";

export const pages = {
  home: HomePage,
  gallery: GalleryPage,
  "work-gallery": WorkGalleryPage,
  services: ServicesPage,
  "service-detail": ServiceDetailPage,
  contact: ContactPage,
} satisfies Record<string, ComponentType>;

export type PageName = keyof typeof pages;

const pathPageMap: Record<string, PageName> = {
  "/gallery": "gallery",
  "/services": "services",
  "/contact": "contact",
};

export function resolvePage(name: string | undefined): ComponentType {
  const path =
    typeof window !== "undefined" ? window.location.pathname.replace(/\/$/, "") || "/" : "/";

  if (typeof window !== "undefined" && window.__SITE_PAGE__ === "service-detail") {
    return ServiceDetailPage;
  }

  if (typeof window !== "undefined" && window.__SITE_PAGE__ === "work-gallery") {
    return WorkGalleryPage;
  }

  if (path.startsWith("/services/") && path !== "/services") {
    return ServiceDetailPage;
  }

  if (path.startsWith("/gallery/") && path !== "/gallery") {
    return WorkGalleryPage;
  }

  const pathPage = typeof window !== "undefined" ? pathPageMap[path] : undefined;

  const pageName =
    name ||
    (typeof window !== "undefined" ? window.__SITE_PAGE__ : undefined) ||
    pathPage;

  if (pageName && pageName in pages) {
    return pages[pageName as PageName];
  }

  return HomePage;
}
