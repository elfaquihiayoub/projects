import { useEffect, useMemo, useRef, useState } from "react";
import { m } from "framer-motion";
import { Container } from "@/components/layout/Container";
import { SectionHeading } from "@/components/ui/SectionHeading";
import { profile } from "@/data/profile";
import { env } from "@/lib/env";

type Status = "idle" | "sending" | "success" | "error";

function isValidEmail(v: string) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim());
}

export function Contact() {
  const [status, setStatus] = useState<Status>("idle");
  const [error, setError] = useState<string | null>(null);

  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [message, setMessage] = useState("");
  const [company, setCompany] = useState(""); // honeypot (should stay empty)

  const startedAt = useRef<number>(Date.now());
  useEffect(() => {
    startedAt.current = Date.now();
  }, []);

  const validation = useMemo(() => {
    const trimmedName = name.trim();
    const trimmedEmail = email.trim();
    const trimmedMessage = message.trim();
    const issues: string[] = [];

    if (trimmedName.length < 2) issues.push("Please enter your name.");
    if (!isValidEmail(trimmedEmail)) issues.push("Please enter a valid email address.");
    if (trimmedMessage.length < 10) issues.push("Message should be at least 10 characters.");

    return { ok: issues.length === 0, issues, payload: { name: trimmedName, email: trimmedEmail, message: trimmedMessage } };
  }, [name, email, message]);

  async function onSubmit(e: React.FormEvent) {
    e.preventDefault();
    setError(null);

    // Basic spam defenses (structure-ready):
    // - Honeypot field
    // - Minimum time on page
    if (company.trim().length > 0) {
      setStatus("success");
      return;
    }
    const elapsedMs = Date.now() - startedAt.current;
    if (elapsedMs < 1200) {
      setStatus("error");
      setError("Please retry in a moment.");
      return;
    }

    if (!validation.ok) {
      setStatus("error");
      setError(validation.issues[0] ?? "Please check your input.");
      return;
    }

    setStatus("sending");

    try {
      if (env.contactEndpoint) {
        const res = await fetch(env.contactEndpoint, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            ...validation.payload,
            meta: { source: "portfolio", ts: new Date().toISOString() }
          })
        });
        if (!res.ok) throw new Error("Request failed");
      } else {
        await new Promise((r) => setTimeout(r, 650));
      }

      setStatus("success");
      setName("");
      setEmail("");
      setMessage("");
      setCompany("");
    } catch {
      setStatus("error");
      setError("Something went wrong. Please email me directly.");
    }
  }

  return (
    <section id="contact" aria-label="Contact" className="py-20 sm:py-24">
      <Container>
        <SectionHeading
          eyebrow="Contact"
          title="Let’s build something premium."
          description="Send a message or reach me directly. I respond quickly and communicate clearly."
        />

        <div className="grid gap-6 lg:grid-cols-3">
          <m.div
            initial={{ opacity: 0, y: 16 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true, amount: 0.25 }}
            transition={{ duration: 0.35 }}
            className="card"
          >
            <div className="text-sm font-bold">Direct</div>
            <div className="mt-4 space-y-3 text-sm text-text-2">
              <a className="block rounded-xl p-3 hover:bg-bg-2 focus-ring" href={`mailto:${profile.email}`}>
                <div className="text-xs font-semibold text-text-2">Email</div>
                <div className="mt-1 font-semibold text-text">{profile.email}</div>
              </a>
              <a className="block rounded-xl p-3 hover:bg-bg-2 focus-ring" href={`tel:${profile.phone}`}>
                <div className="text-xs font-semibold text-text-2">Phone</div>
                <div className="mt-1 font-semibold text-text">{profile.phone}</div>
              </a>
              <a
                className="block rounded-xl p-3 hover:bg-bg-2 focus-ring"
                href={profile.github.url}
                target="_blank"
                rel="noopener noreferrer"
              >
                <div className="text-xs font-semibold text-text-2">GitHub</div>
                <div className="mt-1 font-semibold text-text">{profile.github.username}</div>
              </a>
            </div>
          </m.div>

          <m.div
            initial={{ opacity: 0, y: 16 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true, amount: 0.25 }}
            transition={{ duration: 0.35, delay: 0.04 }}
            className="card lg:col-span-2"
          >
            <form onSubmit={onSubmit} className="grid gap-4">
              <div className="grid gap-4 sm:grid-cols-2">
                <label className="grid gap-2">
                  <span className="text-sm font-semibold">Name</span>
                  <input
                    className="h-11 rounded-xl border border-border bg-bg px-4 text-sm text-text placeholder:text-text-2 focus-ring"
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                    autoComplete="name"
                    required
                  />
                </label>
                <label className="grid gap-2">
                  <span className="text-sm font-semibold">Email</span>
                  <input
                    className="h-11 rounded-xl border border-border bg-bg px-4 text-sm text-text placeholder:text-text-2 focus-ring"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    autoComplete="email"
                    inputMode="email"
                    required
                  />
                </label>
              </div>

              {/* honeypot field for bots (hidden visually) */}
              <label className="sr-only">
                Company
                <input tabIndex={-1} autoComplete="off" value={company} onChange={(e) => setCompany(e.target.value)} />
              </label>

              <label className="grid gap-2">
                <span className="text-sm font-semibold">Message</span>
                <textarea
                  className="min-h-32 rounded-xl border border-border bg-bg px-4 py-3 text-sm text-text placeholder:text-text-2 focus-ring"
                  value={message}
                  onChange={(e) => setMessage(e.target.value)}
                  required
                />
              </label>

              <div className="flex flex-wrap items-center justify-between gap-3">
                <button className="btn-primary min-w-40" type="submit" disabled={status === "sending"}>
                  {status === "sending" ? "Sending..." : "Send Message"}
                </button>
                <div className="text-sm">
                  {status === "success" ? <span className="font-semibold text-text">Message sent. Thanks!</span> : null}
                  {status === "error" ? <span className="font-semibold text-red-500">{error ?? "Please try again."}</span> : null}
                  {status === "idle" ? <span className="text-text-2">No spam. No page reload. Smooth UX.</span> : null}
                </div>
              </div>

              <p className="text-xs text-text-2">
                Security note: external links use <code>rel="noopener noreferrer"</code>. For production form delivery, set{" "}
                <code>VITE_CONTACT_ENDPOINT</code> to your secure form handler (serverless / API).
              </p>
            </form>
          </m.div>
        </div>
      </Container>
    </section>
  );
}

