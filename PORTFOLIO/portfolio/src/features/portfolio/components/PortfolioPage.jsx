import { Suspense, lazy, memo, useCallback, useMemo, useState } from "react";
import { motion, useReducedMotion } from "framer-motion";
import Navbar from "./Navbar";
import Hero from "./Hero";
import Footer from "./Footer";
import ScrollProgress from "./ScrollProgress";
import {
  certifications,
  githubStats,
  navItems,
  profile,
  projects,
  services,
  skills,
  statCards,
} from "../data/content";
import { useActiveSection } from "../hooks/useActiveSection";
import { useContactForm } from "../hooks/useContactForm";
import { useTheme } from "../hooks/useTheme";

const AboutSection = lazy(() => import("./AboutSection"));
const SkillsSection = lazy(() => import("./SkillsSection"));
const ProjectsSection = lazy(() => import("./ProjectsSection"));
const ActivitySection = lazy(() => import("./ActivitySection"));
const ServicesSection = lazy(() => import("./ServicesSection"));
const CertificationsSection = lazy(() => import("./CertificationsSection"));
const ContactSection = lazy(() => import("./ContactSection"));

const sectionReveal = {
  hidden: { opacity: 0, y: 24 },
  visible: {
    opacity: 1,
    y: 0,
    transition: { duration: 0.5, ease: "easeOut" },
  },
};

const RevealSection = memo(function RevealSection({ children }) {
  const prefersReducedMotion = useReducedMotion();
  if (prefersReducedMotion) return <>{children}</>;
  return (
    <motion.div
      variants={sectionReveal}
      initial="hidden"
      whileInView="visible"
      viewport={{ once: true, amount: 0.18 }}
    >
      {children}
    </motion.div>
  );
});

const SectionFallback = memo(function SectionFallback() {
  return <div className="mx-auto h-8 max-w-6xl px-4 sm:px-6" aria-hidden="true" />;
});

export default function PortfolioPage() {
  const [menuOpen, setMenuOpen] = useState(false);
  const sectionIds = useMemo(() => navItems.map((item) => item.id), []);
  const activeSection = useActiveSection(sectionIds);
  const contactForm = useContactForm();
  const { theme, toggleTheme } = useTheme();

  const handleNavigate = useCallback((id) => {
    const section = document.getElementById(id);
    if (section) {
      section.scrollIntoView({ behavior: "smooth", block: "start" });
    }
    setMenuOpen(false);
  }, []);

  const toggleMenu = useCallback(() => setMenuOpen((prev) => !prev), []);
  const handleViewProjects = useCallback(() => handleNavigate("projects"), [handleNavigate]);

  return (
    <>
      <ScrollProgress />
      <Navbar
        profile={profile}
        navItems={navItems}
        activeSection={activeSection}
        onNavigate={handleNavigate}
        menuOpen={menuOpen}
        onToggleMenu={toggleMenu}
        theme={theme}
        onToggleTheme={toggleTheme}
      />

      <main className="relative pb-6">
        <Hero profile={profile} onViewProjects={handleViewProjects} />

        <Suspense fallback={<SectionFallback />}>
          <RevealSection>
            <AboutSection profile={profile} statCards={statCards} />
          </RevealSection>
          <RevealSection>
            <SkillsSection skills={skills} />
          </RevealSection>
          <RevealSection>
            <ProjectsSection projects={projects} />
          </RevealSection>
          <RevealSection>
            <ActivitySection githubStats={githubStats} />
          </RevealSection>
          <RevealSection>
            <ServicesSection services={services} />
          </RevealSection>
          <RevealSection>
            <CertificationsSection certifications={certifications} />
          </RevealSection>
          <RevealSection>
            <ContactSection form={contactForm} profile={profile} />
          </RevealSection>
        </Suspense>
      </main>

      <Footer navItems={navItems} profile={profile} onNavigate={handleNavigate} />
    </>
  );
}
