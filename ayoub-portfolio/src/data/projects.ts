export type Project = {
  title: string;
  description: string;
  tech: string[];
  githubUrl?: string;
  liveUrl?: string;
  caseStudy: {
    problem: string;
    solution: string;
    result: string;
  };
};

export const featuredProjects: Project[] = [
  {
    title: "Library Management System",
    description: "A clean CRUD-focused system with roles, borrowing flows, and reliable data modeling.",
    tech: ["PHP", "MySQL", "HTML", "CSS"],
    githubUrl: "https://github.com/elfaquihiayoub",
    liveUrl: undefined,
    caseStudy: {
      problem: "Managing book inventory and borrowing cycles can become error-prone without a structured workflow.",
      solution: "Designed normalized tables and implemented predictable CRUD flows with clear validation and UI feedback.",
      result: "More consistent data, faster operations, and a foundation ready for reporting and authentication."
    }
  },
  {
    title: "Responsive Landing Page (Premium UI)",
    description: "A performance-focused landing page with premium interactions and accessible components.",
    tech: ["HTML", "Tailwind CSS", "JavaScript"],
    githubUrl: "https://github.com/elfaquihiayoub",
    liveUrl: undefined,
    caseStudy: {
      problem: "Many landing pages look good but perform poorly or lack accessibility.",
      solution: "Used mobile-first design, semantic HTML, and lightweight animation patterns with strong contrast.",
      result: "Faster load, smoother UX, and improved accessibility baseline for recruiters and users."
    }
  },
  {
    title: "Student Productivity Dashboard",
    description: "A dashboard concept with modules for tasks, learning goals, and progress visualization.",
    tech: ["JavaScript", "UI/UX", "Figma"],
    githubUrl: "https://github.com/elfaquihiayoub",
    liveUrl: undefined,
    caseStudy: {
      problem: "Students need a simple system to track learning progress and deliverables.",
      solution: "Designed a modular UI and reusable cards with scalable layout patterns.",
      result: "Clearer progress tracking and a UI foundation for future API integration."
    }
  }
];

