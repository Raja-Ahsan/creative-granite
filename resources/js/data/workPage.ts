export type WorkGalleryItem = {
  slug: string;
  title: string;
  cover: string;
  gallery: string;
};

const IMG = "/images/work";

export const workPageIntro = {
  eyebrow: "Our Work",
  heading: "Our Work",
  body: "Explore a collection of kitchens, bathrooms, fireplaces, commercial spaces, and custom stone applications.",
} as const;

export const workCategories: WorkGalleryItem[] = [
  {
    slug: "kitchens",
    title: "Kitchens",
    cover: `${IMG}/kitchens-cover.jpg`,
    gallery: `${IMG}/kitchens-gallery.png`,
  },
  {
    slug: "bathrooms",
    title: "Bathrooms",
    cover: `${IMG}/bathrooms-cover.jpg`,
    gallery: `${IMG}/bathrooms-gallery.png`,
  },
  {
    slug: "fireplaces",
    title: "Fireplaces",
    cover: `${IMG}/fireplaces-cover.jpg`,
    gallery: `${IMG}/fireplaces-gallery.png`,
  },
  {
    slug: "multifamily",
    title: "Multifamily",
    cover: `${IMG}/multifamily-cover.jpg`,
    gallery: `${IMG}/multifamily-gallery.png`,
  },
];

export const featuredProjects: WorkGalleryItem[] = [
  {
    slug: "norfolk",
    title: "Norfolk",
    cover: `${IMG}/norfolk-cover.jpg`,
    gallery: `${IMG}/norfolk-gallery.png`,
  },
  {
    slug: "sabal",
    title: "Sabal",
    cover: `${IMG}/sabal-cover.png`,
    gallery: `${IMG}/sabal-gallery.png`,
  },
  {
    slug: "lancaster",
    title: "Lancaster",
    cover: `${IMG}/lancaster-cover.jpg`,
    gallery: `${IMG}/lancaster-gallery.png`,
  },
  {
    slug: "2026-parade-home",
    title: "2026 Parade Home",
    cover: `${IMG}/parade-home-cover.jpg`,
    gallery: `${IMG}/parade-home-gallery.png`,
  },
];

export function findWorkGallery(slug: string | undefined): WorkGalleryItem | undefined {
  if (!slug) return undefined;
  return (
    workCategories.find((item) => item.slug === slug) ||
    featuredProjects.find((item) => item.slug === slug)
  );
}

export function workGalleryKind(slug: string): "category" | "project" | null {
  if (workCategories.some((item) => item.slug === slug)) return "category";
  if (featuredProjects.some((item) => item.slug === slug)) return "project";
  return null;
}
