import { cn } from "@/utils/cn";

function toHtml(content: string): string {
  const trimmed = content.trim();
  if (!trimmed) return "";
  return /<[a-z][\s\S]*>/i.test(trimmed) ? trimmed : `<p>${trimmed}</p>`;
}

export function RichHtml({
  html,
  className,
}: {
  html?: string | null;
  className?: string;
}) {
  if (!html?.trim()) return null;

  return (
    <div
      className={cn("materials-rich", className)}
      dangerouslySetInnerHTML={{ __html: toHtml(html) }}
    />
  );
}
