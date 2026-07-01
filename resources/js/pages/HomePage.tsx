import {
  CTA,
  Footer,
  Header,
  Hero,
  InstagramSection,
  Materials,
  Services,
  Testimonial,
  WhoWeAre,
  Work,
} from "@/components/sections";
import { SiteLayout } from "@/layouts/SiteLayout";

export function HomePage() {
  return (
    <SiteLayout>
        <main>
          <Header />
          <Hero />
          <WhoWeAre />
          <Work />
          <Services />
          <Materials />
          <Testimonial />
          <InstagramSection />
          <CTA />
          <Footer />
        </main>
      </SiteLayout>
  );
}
