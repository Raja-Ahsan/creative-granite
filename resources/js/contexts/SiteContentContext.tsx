import { createContext, useContext, type ReactNode } from "react";
import { defaultSiteContent, getInitialSiteContent, type SiteContentPayload } from "@/services/siteContent";
import type { SectionContent } from "@/types/content";

const SiteContentContext = createContext<SiteContentPayload>(defaultSiteContent);

export function SiteContentProvider({ children }: { children: ReactNode }) {
  const content = getInitialSiteContent();

  return <SiteContentContext.Provider value={content}>{children}</SiteContentContext.Provider>;
}

export function useSiteContent(): SiteContentPayload {
  return useContext(SiteContentContext);
}

export function useSection(slug: string): SectionContent {
  const { sections } = useSiteContent();

  return sections[slug] ?? {};
}
