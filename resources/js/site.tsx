import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import { EstimateModalProvider } from "@/contexts/EstimateModalContext";
import { SiteContentProvider } from "@/contexts/SiteContentContext";
import { SiteRouterProvider } from "@/router/SiteRouter";
import "../css/site.css";

const rootEl = document.getElementById("app");

if (rootEl) {
  createRoot(rootEl).render(
    <StrictMode>
      <SiteContentProvider>
        <EstimateModalProvider>
          <SiteRouterProvider />
        </EstimateModalProvider>
      </SiteContentProvider>
    </StrictMode>,
  );
}
