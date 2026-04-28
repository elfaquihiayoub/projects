import { memo } from "react";
import { motion, useReducedMotion } from "framer-motion";

function SectionHeading({ eyebrow, title, subtitle }) {
  const prefersReducedMotion = useReducedMotion();
  const initial = prefersReducedMotion ? false : { opacity: 0, y: 10 };
  const whileInView = prefersReducedMotion ? undefined : { opacity: 1, y: 0 };

  return (
    <motion.div
      initial={initial}
      whileInView={whileInView}
      viewport={{ once: true, amount: 0.4 }}
      transition={{ duration: 0.4, ease: "easeOut" }}
      className="max-w-3xl text-left"
    >
      {eyebrow ? <span className="section-eyebrow">{eyebrow}</span> : null}
      <h2 className="font-heading text-3xl font-semibold tracking-tight text-text-main dark:text-dark-text-main md:text-4xl">
        {title}
      </h2>
      {subtitle ? (
        <p className="mt-3 text-sm leading-relaxed text-text-secondary dark:text-dark-text-secondary md:text-base">
          {subtitle}
        </p>
      ) : null}
    </motion.div>
  );
}

export default memo(SectionHeading);
