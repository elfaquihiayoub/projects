import { LazyMotion, domAnimation } from "framer-motion";
import { Navbar } from "@/components/layout/Navbar";
import { ScrollProgressBar } from "@/components/layout/ScrollProgressBar";
import { Footer } from "@/components/layout/Footer";
import { useTheme } from "@/hooks/useTheme";
import { Hero } from "@/sections/Hero";
import { About } from "@/sections/About";
import { Skills } from "@/sections/Skills";
import { Projects } from "@/sections/Projects";
import { GitHubStats } from "@/sections/GitHubStats";
import { CurrentlyWorkingOn } from "@/sections/CurrentlyWorkingOn";
import { Services } from "@/sections/Services";
import { Certifications } from "@/sections/Certifications";
import { Availability } from "@/sections/Availability";
import { Contact } from "@/sections/Contact";

export default function App() {
  const { theme, toggle } = useTheme();

  return (
    <LazyMotion features={domAnimation} strict>
      <a
        href="#main"
        className="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[80] focus:rounded-xl focus:bg-bg focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:shadow-glow focus-ring"
      >
        Skip to content
      </a>

      <ScrollProgressBar />
      <Navbar theme={theme} onToggleTheme={toggle} />

      <main id="main">
        <Hero />
        <About />
        <Skills />
        <Projects />
        <GitHubStats />
        <CurrentlyWorkingOn />
        <Services />
        <Certifications />
        <Availability />
        <Contact />
      </main>

      <Footer />
    </LazyMotion>
  );
}

