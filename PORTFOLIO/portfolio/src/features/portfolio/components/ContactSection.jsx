import { memo } from "react";
import { motion, useReducedMotion } from "framer-motion";
import { Mail, Phone, MapPin, Send, Loader2, Github, CheckCircle2 } from "lucide-react";
import SectionHeading from "./SectionHeading";

function FieldError({ message }) {
  if (!message) return null;
  return (
    <p className="mt-1 text-xs font-medium text-red-500" role="alert">
      {message}
    </p>
  );
}

function ContactSection({ form, profile }) {
  const { values, errors, status, isSubmitting, updateField, handleSubmit } = form;
  const prefersReducedMotion = useReducedMotion();
  const safePhone = profile.phone || "";
  const telHref = safePhone ? `tel:${safePhone.replace(/\s/g, "")}` : undefined;

  const successAnimation = prefersReducedMotion
    ? false
    : { initial: { opacity: 0, y: 6 }, animate: { opacity: 1, y: 0 } };

  return (
    <section id="contact" className="mx-auto max-w-6xl px-4 py-20 sm:px-6">
      <SectionHeading
        eyebrow="Get In Touch"
        title="Contact"
        subtitle="Let's discuss your next product, feature, or performance challenge. I usually reply within 24 hours."
      />

      <div className="mt-10 grid items-start gap-8 md:grid-cols-2">
        <div className="space-y-4">
          <a
            href={`mailto:${profile.email}`}
            className="surface-card flex items-center gap-4 p-5"
          >
            <div className="flex h-11 w-11 items-center justify-center rounded-xl bg-accent/10 text-accent">
              <Mail className="h-5 w-5" aria-hidden="true" />
            </div>
            <div>
              <p className="text-[11px] font-semibold uppercase tracking-[0.16em] text-text-secondary dark:text-dark-text-secondary">
                Email
              </p>
              <p className="text-sm font-medium text-text-main dark:text-dark-text-main">
                {profile.email}
              </p>
            </div>
          </a>

          <a href={telHref} className="surface-card flex items-center gap-4 p-5">
            <div className="flex h-11 w-11 items-center justify-center rounded-xl bg-accent/10 text-accent">
              <Phone className="h-5 w-5" aria-hidden="true" />
            </div>
            <div>
              <p className="text-[11px] font-semibold uppercase tracking-[0.16em] text-text-secondary dark:text-dark-text-secondary">
                Phone
              </p>
              <p className="text-sm font-medium text-text-main dark:text-dark-text-main">
                {safePhone || "Not provided"}
              </p>
            </div>
          </a>

          <div className="surface-card-static flex items-center gap-4 p-5">
            <div className="flex h-11 w-11 items-center justify-center rounded-xl bg-accent/10 text-accent">
              <MapPin className="h-5 w-5" aria-hidden="true" />
            </div>
            <div>
              <p className="text-[11px] font-semibold uppercase tracking-[0.16em] text-text-secondary dark:text-dark-text-secondary">
                Location
              </p>
              <p className="text-sm font-medium text-text-main dark:text-dark-text-main">
                {profile.location}
              </p>
            </div>
          </div>

          <a
            href={profile.github}
            target="_blank"
            rel="noopener noreferrer"
            className="surface-card flex items-center gap-4 p-5"
          >
            <div className="flex h-11 w-11 items-center justify-center rounded-xl bg-accent/10 text-accent">
              <Github className="h-5 w-5" aria-hidden="true" />
            </div>
            <div>
              <p className="text-[11px] font-semibold uppercase tracking-[0.16em] text-text-secondary dark:text-dark-text-secondary">
                GitHub
              </p>
              <p className="text-sm font-medium text-text-main dark:text-dark-text-main">
                @elfaquihiayoub
              </p>
            </div>
          </a>
        </div>

        <form
          onSubmit={handleSubmit}
          noValidate
          className="surface-card-static space-y-4 p-5 sm:p-6"
          aria-labelledby="contact-form-heading"
        >
          <div className="grid gap-4 sm:grid-cols-2">
            <div>
              <label htmlFor="name" className="mb-1.5 block text-xs font-semibold uppercase tracking-[0.14em] text-text-secondary dark:text-dark-text-secondary">
                Full Name
              </label>
              <input
                id="name"
                name="name"
                type="text"
                className="input-field"
                placeholder="Jane Doe"
                value={values.name}
                onChange={(event) => updateField("name", event.target.value)}
                autoComplete="name"
                aria-invalid={Boolean(errors.name)}
                aria-describedby={errors.name ? "name-error" : undefined}
                disabled={isSubmitting}
              />
              <FieldError message={errors.name} />
            </div>

            <div>
              <label htmlFor="email" className="mb-1.5 block text-xs font-semibold uppercase tracking-[0.14em] text-text-secondary dark:text-dark-text-secondary">
                Email Address
              </label>
              <input
                id="email"
                name="email"
                type="email"
                className="input-field"
                placeholder="jane@company.com"
                value={values.email}
                onChange={(event) => updateField("email", event.target.value)}
                autoComplete="email"
                aria-invalid={Boolean(errors.email)}
                aria-describedby={errors.email ? "email-error" : undefined}
                disabled={isSubmitting}
              />
              <FieldError message={errors.email} />
            </div>
          </div>

          <div>
            <label htmlFor="subject" className="mb-1.5 block text-xs font-semibold uppercase tracking-[0.14em] text-text-secondary dark:text-dark-text-secondary">
              Subject
            </label>
            <input
              id="subject"
              name="subject"
              type="text"
              className="input-field"
              placeholder="Project inquiry, collaboration, opportunity..."
              value={values.subject}
              onChange={(event) => updateField("subject", event.target.value)}
              aria-invalid={Boolean(errors.subject)}
              disabled={isSubmitting}
            />
            <FieldError message={errors.subject} />
          </div>

          <div>
            <label htmlFor="message" className="mb-1.5 block text-xs font-semibold uppercase tracking-[0.14em] text-text-secondary dark:text-dark-text-secondary">
              Message
            </label>
            <textarea
              id="message"
              name="message"
              rows="5"
              className="input-field resize-y"
              placeholder="Tell me about your project, timeline, and goals..."
              value={values.message}
              onChange={(event) => updateField("message", event.target.value)}
              aria-invalid={Boolean(errors.message)}
              disabled={isSubmitting}
            />
            <FieldError message={errors.message} />
          </div>

          <input
            type="text"
            name="company"
            tabIndex="-1"
            autoComplete="off"
            value={values.honeypot}
            onChange={(event) => updateField("honeypot", event.target.value)}
            className="hidden"
            aria-hidden="true"
          />

          <button
            type="submit"
            disabled={isSubmitting}
            className="btn-primary w-full"
          >
            {isSubmitting ? (
              <>
                <Loader2 className="h-4 w-4 animate-spin" aria-hidden="true" />
                Sending...
              </>
            ) : (
              <>
                <Send className="h-4 w-4" aria-hidden="true" />
                Send Message
              </>
            )}
          </button>

          {status.type === "success" && (
            <motion.div
              {...(successAnimation || {})}
              transition={{ duration: 0.25 }}
              className="flex items-center gap-2 rounded-xl border border-green-500/30 bg-green-500/10 px-4 py-3 text-sm font-medium text-green-600 dark:text-green-400"
              role="status"
            >
              <CheckCircle2 className="h-4 w-4" aria-hidden="true" />
              {status.message}
            </motion.div>
          )}
        </form>
      </div>
    </section>
  );
}

export default memo(ContactSection);
