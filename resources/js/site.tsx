import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import { SiteContentProvider } from "@/contexts/SiteContentContext";
import { resolvePage } from "@/pages/registry";
import "../css/site.css";

declare global {
  interface Window {
    __SITE_PAGE__?: string;
  }
}

const rootEl = document.getElementById("app");

if (rootEl) {
  const pageName = rootEl.dataset.page || window.__SITE_PAGE__;
  const Page = resolvePage(pageName);

  createRoot(rootEl).render(
    <StrictMode>
      <SiteContentProvider>
        <Page />
      </SiteContentProvider>
    </StrictMode>,
  );
}
