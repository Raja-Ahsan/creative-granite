function stripHtml(html: string): string {
  return html
    .replace(/<[^>]+>/g, " ")
    .replace(/&nbsp;/g, " ")
    .replace(/\s+/g, " ")
    .trim();
}

function normalizeText(text: string): string {
  return text.replace(/\s+/g, " ").trim().toLowerCase();
}

export function isDuplicateExcerpt(excerpt: string, bodyHtml: string): boolean {
  const excerptNorm = normalizeText(excerpt);
  if (!excerptNorm) return true;

  const bodyNorm = normalizeText(stripHtml(bodyHtml));
  if (!bodyNorm) return false;

  if (bodyNorm === excerptNorm) return true;
  if (bodyNorm.startsWith(excerptNorm)) return true;
  if (excerptNorm.length > 40 && bodyNorm.includes(excerptNorm)) return true;

  return false;
}

export function prepareServiceBody(
  bodyHtml: string,
  title: string,
  excerpt: string,
  mainImage?: string | null,
): string {
  if (typeof window === "undefined" || !bodyHtml.trim()) {
    return bodyHtml;
  }

  const doc = new DOMParser().parseFromString(bodyHtml, "text/html");
  const { body } = doc;
  const titleNorm = normalizeText(title);
  const excerptNorm = normalizeText(excerpt);

  const removeMatchingHeading = () => {
    const heading = body.querySelector("h1, h2, h3");
    if (!heading) return;

    const headingText = normalizeText(heading.textContent ?? "");
    if (
      headingText === titleNorm ||
      headingText.includes(titleNorm) ||
      titleNorm.includes(headingText)
    ) {
      heading.remove();
    }
  };

  const removeDuplicateLead = () => {
    const firstBlock = body.querySelector("p, div");
    if (!firstBlock) return;

    const blockText = normalizeText(firstBlock.textContent ?? "");
    if (!blockText) return;

    if (
      blockText === excerptNorm ||
      blockText === titleNorm ||
      (excerptNorm && (blockText.startsWith(excerptNorm) || excerptNorm.startsWith(blockText)))
    ) {
      firstBlock.remove();
    }
  };

  const removeDuplicateMainImage = () => {
    if (!mainImage) return;

    body.querySelectorAll("img").forEach((img) => {
      const src = img.getAttribute("src") ?? "";
      if (src === mainImage || src.endsWith(mainImage) || mainImage.endsWith(src)) {
        img.remove();
      }
    });
  };

  removeMatchingHeading();
  removeDuplicateLead();
  removeDuplicateMainImage();

  return body.innerHTML.trim();
}
