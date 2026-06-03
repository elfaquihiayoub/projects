import type { PropsWithChildren } from "react";
import { cn } from "@/lib/cn";

export function Container({ className, children }: PropsWithChildren<{ className?: string }>) {
  return <div className={cn("container-app", className)}>{children}</div>;
}

