import type { ReactNode } from "react";
import { CustomCursor } from "@/components/site/CustomCursor";
import { LoadingScreen } from "@/components/site/LoadingScreen";

type SiteLayoutProps = {
  children: ReactNode;
};

export function SiteLayout({ children }: SiteLayoutProps) {
  return (
    <div className="relative bg-cream text-foreground md:cursor-none">
      <LoadingScreen />
      <CustomCursor />
      {children}
    </div>
  );
}
