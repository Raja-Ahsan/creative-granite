import {
  CTA,
  Footer,
  Header,
  Hero,
  HeroIntro,
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
          <HeroIntro />
          <WhoWeAre />
          <Materials />
          <Work />
          <InstagramSection />
          <Services />
          <Testimonial />
          <CTA />
          <Footer />
        </main>
      </SiteLayout>
  );
}
