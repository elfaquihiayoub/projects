import { m } from "framer-motion";
import { Container } from "@/components/layout/Container";
import { SectionHeading } from "@/components/ui/SectionHeading";

type Skill = { name: string; icon: string };

const groups: Array<{ title: string; items: Skill[] }> = [
  {
    title: "Frontend",
    items: [
      { name: "HTML", icon: "🌐" },
      { name: "CSS", icon: "🎨" },
      { name: "JavaScript", icon: "⚡" }
    ]
  },
  {
    title: "Backend",
    items: [
      { name: "PHP", icon: "🐘" },
      { name: "Python", icon: "🐍" },
      { name: "MySQL", icon: "🗄️" }
    ]
  },
  {
    title: "Tools",
    items: [
      { name: "Git", icon: "🔧" },
      { name: "GitHub", icon: "🐙" },
      { name: "Figma", icon: "🧩" },
      { name: "UI/UX Basics", icon: "✨" }
    ]
  }
];

export function Skills() {
  return (
    <section id="skills" aria-label="Skills" className="py-20 sm:py-24">
      <Container>
        <SectionHeading
          eyebrow="Skills"
          title="A practical toolkit for building modern web products."
          description="Focused on fundamentals and real-world delivery: clean UI, solid APIs, and maintainable code."
        />

        <div className="grid gap-6 lg:grid-cols-3">
          {groups.map((g, gi) => (
            <m.div
              key={g.title}
              initial={{ opacity: 0, y: 16 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, amount: 0.25 }}
              transition={{ duration: 0.35, delay: gi * 0.05 }}
              className="card"
            >
              <div className="flex items-center justify-between">
                <h3 className="text-lg font-bold tracking-tight">{g.title}</h3>
                <span aria-hidden="true" className="text-xs font-semibold text-text-2">
                  {g.items.length} skills
                </span>
              </div>
              <div className="mt-5 grid gap-3">
                {g.items.map((s) => (
                  <div
                    key={s.name}
                    className="group flex items-center justify-between rounded-2xl border border-border bg-bg-2 px-4 py-3 transition hover:shadow-glow"
                  >
                    <div className="flex items-center gap-3">
                      <div className="grid h-10 w-10 place-items-center rounded-2xl border border-border bg-bg">
                        <span aria-hidden="true" className="text-lg">
                          {s.icon}
                        </span>
                      </div>
                      <div className="text-sm font-semibold">{s.name}</div>
                    </div>
                    <div aria-hidden="true" className="text-text-2 transition group-hover:text-text">
                      ↗
                    </div>
                  </div>
                ))}
              </div>
            </m.div>
          ))}
        </div>
      </Container>
    </section>
  );
}

