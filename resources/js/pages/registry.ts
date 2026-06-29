import type { ComponentType } from "react";
import { GalleryPage } from "./GalleryPage";
import { HomePage } from "./HomePage";

export const pages = {
  home: HomePage,
  gallery: GalleryPage,
} satisfies Record<string, ComponentType>;

export type PageName = keyof typeof pages;

export function resolvePage(name: string | undefined): ComponentType {
  const pageName =
    name ||
    (typeof window !== "undefined" ? window.__SITE_PAGE__ : undefined) ||
    (typeof window !== "undefined" && window.location.pathname.replace(/\/$/, "") === "/gallery"
      ? "gallery"
      : undefined);

  if (pageName && pageName in pages) {
    return pages[pageName as PageName];
  }

  return HomePage;
}
