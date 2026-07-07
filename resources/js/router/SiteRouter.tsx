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
import { ServiceDetailPage } from "@/pages/ServiceDetailPage";
import { ServicesPage } from "@/pages/ServicesPage";

type SiteRouterContextValue = {
  pathname: string;
  navigate: (to: string) => void;
};

const SiteRouterContext = createContext<SiteRouterContextValue>({
  pathname: "/",
  navigate: () => undefined,
});

function normalizePath(path: string): string {
  const clean = path.replace(/\/$/, "");
  return clean === "" ? "/" : clean;
}

function resolvePage(pathname: string) {
  const path = normalizePath(pathname);

  if (path === "/gallery") return GalleryPage;
  if (path === "/services") return ServicesPage;
  if (path === "/contact") return ContactPage;
  if (path.startsWith("/services/")) return ServiceDetailPage;

  return HomePage;
}

function scrollForNavigation(path: string) {
  const hashIndex = path.indexOf("#");
  if (hashIndex !== -1) {
    const id = path.slice(hashIndex + 1);
    const el = document.getElementById(id);
    if (el) {
      el.scrollIntoView({ behavior: "smooth" });
      return;
    }
  }

  window.scrollTo(0, 0);
}

export function SiteRouterProvider({ children }: { children?: ReactNode }) {
  const [pathname, setPathname] = useState(() => normalizePath(window.location.pathname));

  const navigate = useCallback((to: string) => {
    const url = new URL(to, window.location.origin);
    const nextPath = `${url.pathname}${url.search}${url.hash}`;

    if (nextPath === `${window.location.pathname}${window.location.search}${window.location.hash}`) {
      scrollForNavigation(nextPath);
      return;
    }

    window.history.pushState({}, "", nextPath);
    setPathname(normalizePath(url.pathname));
    scrollForNavigation(nextPath);
  }, []);

  useEffect(() => {
    const onPopState = () => {
      setPathname(normalizePath(window.location.pathname));
      scrollForNavigation(window.location.href);
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
      if (!href || href.startsWith("mailto:") || href.startsWith("tel:")) {
        return;
      }

      const url = new URL(anchor.href, window.location.origin);
      if (url.origin !== window.location.origin || url.pathname.startsWith("/admin")) {
        return;
      }

      event.preventDefault();
      navigate(`${url.pathname}${url.search}${url.hash}`);
    };

    document.addEventListener("click", onClick);
    return () => document.removeEventListener("click", onClick);
  }, [navigate]);

  const value = useMemo(() => ({ pathname, navigate }), [pathname, navigate]);
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
