import { memo } from "react";
import { motion, useScroll, useSpring } from "framer-motion";

function ScrollProgress() {
  const { scrollYProgress } = useScroll();
  const scaleX = useSpring(scrollYProgress, {
    stiffness: 140,
    damping: 28,
    mass: 0.2,
  });

  return (
    <motion.div
      className="fixed left-0 right-0 top-0 z-[70] h-1 origin-left bg-accent"
      style={{ scaleX }}
      aria-hidden="true"
    />
  );
}

export default memo(ScrollProgress);
