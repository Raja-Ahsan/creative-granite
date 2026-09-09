/** Shared anchor id for Services page sections (aligned with PHP Str::slug(title)). */
export function serviceSectionId(title: string): string {
  return title
    .toLowerCase()
    .trim()
    .replace(/&/g, " ")
    .replace(/[^a-z0-9\s-]/g, "")
    .replace(/\s+/g, "-")
    .replace(/-+/g, "-")
    .replace(/^-|-$/g, "");
}

export function serviceSectionHref(
  title: string,
  sections: { title: string; slug?: string | null }[],
  index = 0,
): string {
  const normalized = title.trim().toLowerCase();
  const byTitle = sections.find((section) => section.title.trim().toLowerCase() === normalized);
  const match = byTitle ?? sections[index] ?? null;
  const id = match?.slug || (match ? serviceSectionId(match.title) : serviceSectionId(title));

  return `/services#${id}`;
}
