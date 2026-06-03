import { m } from "framer-motion";
import { Container } from "@/components/layout/Container";
import { SectionHeading } from "@/components/ui/SectionHeading";
import { profile } from "@/data/profile";

export function GitHubStats() {
  const u = profile.github.username;
  const stats = `https://github-readme-stats.vercel.app/api?username=${u}&show_icons=true&hide_border=true&theme=transparent`;
  const streak = `https://streak-stats.demolab.com?user=${u}&hide_border=true&theme=transparent`;
  const graph = `https://github-readme-activity-graph.vercel.app/graph?username=${u}&hide_border=true&bg_color=00000000&color=9CA3AF&line=00CFFF&point=00CFFF&area=true&area_color=00CFFF`;

  return (
    <section id="github" aria-label="GitHub Stats" className="py-20 sm:py-24">
      <Container>
        <SectionHeading
          eyebrow="GitHub"
          title="Consistency, contributions, and real coding activity."
          description="Live visuals powered by GitHub readme widgets. Recruiters get a quick signal of consistency and momentum."
        />

        <div className="grid gap-6 lg:grid-cols-2">
          <m.div
            initial={{ opacity: 0, y: 16 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true, amount: 0.2 }}
            transition={{ duration: 0.35 }}
            className="card"
          >
            <div className="text-sm font-bold">Contribution activity</div>
            <p className="mt-1 text-sm text-text-2">A lightweight signal of ongoing work and learning.</p>
            <img
              className="mt-4 w-full"
              src={graph}
              alt={`${u} GitHub activity graph`}
              loading="lazy"
              decoding="async"
            />
          </m.div>

          <div className="grid gap-6">
            <m.div
              initial={{ opacity: 0, y: 16 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, amount: 0.2 }}
              transition={{ duration: 0.35, delay: 0.03 }}
              className="card"
            >
              <div className="text-sm font-bold">GitHub consistency</div>
              <p className="mt-1 text-sm text-text-2">Streak & reliability view.</p>
              <img className="mt-4 w-full" src={streak} alt={`${u} GitHub streak stats`} loading="lazy" decoding="async" />
            </m.div>

            <m.div
              initial={{ opacity: 0, y: 16 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, amount: 0.2 }}
              transition={{ duration: 0.35, delay: 0.06 }}
              className="card"
            >
              <div className="text-sm font-bold">Coding activity cards</div>
              <p className="mt-1 text-sm text-text-2">Overview of repos and contributions.</p>
              <img className="mt-4 w-full" src={stats} alt={`${u} GitHub stats`} loading="lazy" decoding="async" />
            </m.div>
          </div>
        </div>
      </Container>
    </section>
  );
}

