import { memo, useCallback, useState } from "react";
import { Download, Check, Loader2 } from "lucide-react";

function CVDownloadButton({
  fileUrl,
  fileName,
  className = "btn-primary",
  label = "Download CV",
}) {
  const [state, setState] = useState("idle");

  const handleDownload = useCallback(
    async (event) => {
      event.preventDefault();
      if (state === "loading") return;

      setState("loading");
      try {
        const response = await fetch(fileUrl, { cache: "no-cache" });
        if (!response.ok) throw new Error("Network response was not ok");
        const blob = await response.blob();
        const objectUrl = URL.createObjectURL(blob);

        const link = document.createElement("a");
        link.href = objectUrl;
        link.download = fileName;
        document.body.appendChild(link);
        link.click();
        link.remove();
        URL.revokeObjectURL(objectUrl);

        setState("success");
        setTimeout(() => setState("idle"), 1800);
      } catch {
        const link = document.createElement("a");
        link.href = fileUrl;
        link.download = fileName;
        link.target = "_blank";
        link.rel = "noopener";
        document.body.appendChild(link);
        link.click();
        link.remove();
        setState("idle");
      }
    },
    [fileUrl, fileName, state]
  );

  const isLoading = state === "loading";
  const isSuccess = state === "success";

  return (
    <a
      href={fileUrl}
      download={fileName}
      onClick={handleDownload}
      className={className}
      aria-label={label}
      aria-busy={isLoading}
    >
      {isLoading ? (
        <Loader2 className="h-4 w-4 animate-spin" aria-hidden="true" />
      ) : isSuccess ? (
        <Check className="h-4 w-4" aria-hidden="true" />
      ) : (
        <Download className="h-4 w-4" aria-hidden="true" />
      )}
      <span>{isLoading ? "Preparing..." : isSuccess ? "Downloaded" : label}</span>
    </a>
  );
}

export default memo(CVDownloadButton);
