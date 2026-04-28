import { memo } from "react";
import {
  SiHtml5,
  SiCss,
  SiJavascript,
  SiPhp,
  SiMysql,
  SiReact,
  SiTailwindcss,
  SiGit,
  SiGithub,
  SiFigma,
  SiFramer,
  SiLaravel,
  SiNodedotjs,
  SiPostgresql,
  SiRedis,
  SiChartdotjs,
} from "react-icons/si";

const REGISTRY = {
  html5: SiHtml5,
  css3: SiCss,
  javascript: SiJavascript,
  php: SiPhp,
  mysql: SiMysql,
  react: SiReact,
  tailwind: SiTailwindcss,
  git: SiGit,
  github: SiGithub,
  figma: SiFigma,
  framer: SiFramer,
  laravel: SiLaravel,
  nodejs: SiNodedotjs,
  postgresql: SiPostgresql,
  redis: SiRedis,
  chartjs: SiChartdotjs,
};

function TechIcon({ iconKey, className = "", color, title }) {
  const Icon = REGISTRY[iconKey];
  if (!Icon) return null;
  return (
    <Icon
      className={className}
      style={color ? { color } : undefined}
      aria-label={title}
      role="img"
    />
  );
}

export default memo(TechIcon);
