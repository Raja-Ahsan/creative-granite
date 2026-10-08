import type { ReactNode } from "react";
import { LoadingScreen } from "@/components/site/LoadingScreen";

type SiteLayoutProps = {
  children: ReactNode;
};

export function SiteLayout({ children }: SiteLayoutProps) {
  return (
    <div className="relative bg-cream text-foreground">
      <LoadingScreen />
      {children}
    </div>
  );
}
