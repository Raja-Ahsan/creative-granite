import {
  createContext,
  useCallback,
  useContext,
  useEffect,
  useMemo,
  useState,
  type ReactNode,
} from "react";
import { ContactPage } from "@/pages/ContactPage";
import { GalleryPage } from "@/pages/GalleryPage";
import { HomePage } from "@/pages/HomePage";
import { MaterialDetailPage } from "@/pages/MaterialDetailPage";
import { ProcessPage } from "@/pages/ProcessPage";
import { ProductDetailPage } from "@/pages/ProductDetailPage";
import { ProductsPage } from "@/pages/ProductsPage";
import { ServiceDetailPage } from "@/pages/ServiceDetailPage";
import { ServicesPage } from "@/pages/ServicesPage";
import { WorkGalleryPage } from "@/pages/WorkGalleryPage";

type NavigateOptions = {
  scroll?: boolean;
};

type SiteRouterContextValue = {
  pathname: string;
  search: string;
  navigate: (to: string, options?: NavigateOptions) => void;
};

const SiteRouterContext = createContext<SiteRouterContextValue>({
  pathname: "/",
  search: "",
  navigate: () => undefined,
});

function normalizePath(path: string): string {
  const clean = path.replace(/\/$/, "");
  return clean === "" ? "/" : clean;
}

function resolvePage(pathname: string) {
  const path = normalizePath(pathname);

  if (path === "/gallery") return GalleryPage;
  if (path.startsWith("/gallery/")) return WorkGalleryPage;
  if (path === "/products") return ProductsPage;
  if (path === "/process") return ProcessPage;
  if (path === "/services") return ServicesPage;
  if (path === "/contact") return ContactPage;
  if (path.startsWith("/materials/")) return MaterialDetailPage;
  if (path.startsWith("/products/")) return ProductDetailPage;
  if (path.startsWith("/services/")) return ServiceDetailPage;

  return HomePage;
}

function scrollToHash(hash: string | null, behavior: ScrollBehavior = "smooth") {
  if (!hash) {
    window.scrollTo({ top: 0, behavior });
    return true;
  }

  const el = document.getElementById(hash);
  if (!el) return false;

  el.scrollIntoView({ behavior });
  return true;
}

export function SiteRouterProvider({ children }: { children?: ReactNode }) {
  const [pathname, setPathname] = useState(() => normalizePath(window.location.pathname));
  const [search, setSearch] = useState(() => window.location.search);
  const [pendingHash, setPendingHash] = useState<string | null>(() => {
    const hash = window.location.hash.slice(1);
    return hash || null;
  });

  const navigate = useCallback((to: string, options?: NavigateOptions) => {
    const shouldScroll = options?.scroll !== false;
    const url = new URL(to, window.location.origin);
    const nextPath = `${url.pathname}${url.search}${url.hash}`;
    const hash = url.hash ? url.hash.slice(1) : null;

    if (nextPath === `${window.location.pathname}${window.location.search}${window.location.hash}`) {
      if (hash) {
        if (!scrollToHash(hash)) {
          setPendingHash(hash);
        }
      } else if (shouldScroll) {
        setPendingHash(null);
        window.scrollTo(0, 0);
      }
      return;
    }

    window.history.pushState({}, "", nextPath);
    setPathname(normalizePath(url.pathname));
    setSearch(url.search);

    if (hash) {
      const scrolled = scrollToHash(hash);
      setPendingHash(scrolled ? null : hash);
      return;
    }

    setPendingHash(null);
    if (shouldScroll) {
      window.scrollTo(0, 0);
    }
  }, []);

  useEffect(() => {
    if (!pendingHash) return;

    let attempts = 0;
    const tryScroll = () => {
      if (scrollToHash(pendingHash)) {
        setPendingHash(null);
        return true;
      }
      return false;
    };

    if (tryScroll()) return;

    const timer = window.setInterval(() => {
      attempts += 1;
      if (tryScroll() || attempts >= 24) {
        window.clearInterval(timer);
        if (attempts >= 24) {
          setPendingHash(null);
        }
      }
    }, 50);

    return () => window.clearInterval(timer);
  }, [pendingHash, pathname]);

  useEffect(() => {
    const onPopState = () => {
      const hash = window.location.hash.slice(1) || null;
      setPathname(normalizePath(window.location.pathname));
      setSearch(window.location.search);
      if (hash) {
        if (!scrollToHash(hash)) {
          setPendingHash(hash);
        } else {
          setPendingHash(null);
        }
        return;
      }

      setPendingHash(null);
      window.scrollTo(0, 0);
    };

    window.addEventListener("popstate", onPopState);
    return () => window.removeEventListener("popstate", onPopState);
  }, []);

  useEffect(() => {
    const onClick = (event: MouseEvent) => {
      if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
        return;
      }

      const anchor = (event.target as HTMLElement | null)?.closest("a");
      if (!anchor || anchor.target === "_blank" || anchor.hasAttribute("download")) {
        return;
      }

      const href = anchor.getAttribute("href");
      if (!href || href.startsWith("mailto:") || href.startsWith("tel:") || href === "#estimate") {
        return;
      }

      const url = new URL(anchor.href, window.location.origin);
      if (url.hash === "#estimate") {
        return;
      }
      if (url.origin !== window.location.origin || url.pathname.startsWith("/admin")) {
        return;
      }

      event.preventDefault();
      navigate(`${url.pathname}${url.search}${url.hash}`);
    };

    document.addEventListener("click", onClick);
    return () => document.removeEventListener("click", onClick);
  }, [navigate]);

  const value = useMemo(() => ({ pathname, search, navigate }), [pathname, search, navigate]);
  const Page = resolvePage(pathname);

  return (
    <SiteRouterContext.Provider value={value}>
      <Page />
      {children}
    </SiteRouterContext.Provider>
  );
}

export function useSiteRouter(): SiteRouterContextValue {
  return useContext(SiteRouterContext);
}

export function useServiceSlug(): string | undefined {
  const { pathname } = useSiteRouter();
  const match = pathname.match(/^\/services\/([^/]+)$/);
  return match?.[1];
}

export function useWorkGallerySlug(): string | undefined {
  const { pathname } = useSiteRouter();
  const match = pathname.match(/^\/gallery\/([^/]+)$/);
  return match?.[1] ? decodeURIComponent(match[1]) : undefined;
}

export function useMaterialSlug(): string | undefined {
  const { pathname } = useSiteRouter();
  const match = pathname.match(/^\/materials\/([^/]+)$/);
  return match?.[1];
}

export function materialDetailHref(slug: string): string {
  return `/materials/${slug}`;
}

export function useProductSlug(): string | undefined {
  const { pathname } = useSiteRouter();
  const match = pathname.match(/^\/products\/([^/]+)$/);
  return match?.[1];
}

export function useCategorySlugFromUrl(): string | null {
  const { search } = useSiteRouter();
  return new URLSearchParams(search).get("category");
}

export function productDetailHref(slug: string, categorySlug?: string | null): string {
  if (!categorySlug) {
    return `/products/${slug}`;
  }

  return `/products/${slug}?category=${encodeURIComponent(categorySlug)}`;
}

export function productsListHref(categorySlug?: string | null): string {
  if (!categorySlug) {
    return "/products";
  }

  return `/products?category=${encodeURIComponent(categorySlug)}`;
}
