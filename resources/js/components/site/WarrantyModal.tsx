import { useEffect, useMemo, useState, type FormEvent } from "react";
import Swal from "sweetalert2";
import { useWarrantyModal } from "@/contexts/WarrantyModalContext";
import {
  parseWarrantyFormErrors,
  submitWarrantyForm,
  warrantyFormErrorMessage,
  type WarrantyFormData,
} from "@/services/warrantyForm";

const fieldClass =
  "mt-2 w-full border-b border-foreground/20 bg-transparent py-3 text-foreground outline-none transition-colors placeholder:text-foreground/35 focus:border-foreground";

const labelClass = "eyebrow text-foreground/50";

const swalTheme = {
  confirmButtonColor: "#2a2622",
  background: "#f5f0ea",
  color: "#2a2622",
};

const initialForm: WarrantyFormData = {
  name: "",
  email: "",
  phone: "",
  address: "",
  message: "",
};

export function WarrantyModal() {
  const { isOpen, closeWarrantyModal } = useWarrantyModal();
  const [form, setForm] = useState<WarrantyFormData>(initialForm);
  const [errors, setErrors] = useState<Partial<Record<keyof WarrantyFormData, string>>>({});
  const [status, setStatus] = useState<"idle" | "submitting">("idle");

  const emptyForm = useMemo(() => initialForm, []);

  useEffect(() => {
    if (!isOpen) {
      setForm(emptyForm);
      setErrors({});
      setStatus("idle");
    }
  }, [isOpen, emptyForm]);

  if (!isOpen) return null;

  const updateField = (field: keyof WarrantyFormData, value: string) => {
    setForm((current) => ({ ...current, [field]: value }));
    setErrors((current) => ({ ...current, [field]: undefined }));
  };

  const handleSubmit = async (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    setStatus("submitting");
    setErrors({});

    try {
      const message = await submitWarrantyForm(form);
      closeWarrantyModal();
      await Swal.fire({
        icon: "success",
        title: "Request sent",
        text: message,
        confirmButtonText: "Done",
        ...swalTheme,
        customClass: {
          popup: "rounded-sm border border-foreground/10 font-sans",
          title: "font-display text-2xl uppercase tracking-wide",
          confirmButton: "rounded-full px-8 py-3 text-xs uppercase tracking-[0.2em]",
        },
      });
    } catch (error) {
      const validationErrors = parseWarrantyFormErrors(error);
      if (validationErrors) {
        setStatus("idle");
        setErrors(
          Object.fromEntries(
            Object.entries(validationErrors).map(([key, messages]) => [key, messages?.[0] ?? ""]),
          ) as Partial<Record<keyof WarrantyFormData, string>>,
        );
        return;
      }

      setStatus("idle");
      await Swal.fire({
        icon: "error",
        title: "Could not send",
        text: warrantyFormErrorMessage(error),
        confirmButtonText: "Try again",
        ...swalTheme,
        customClass: {
          popup: "rounded-sm border border-foreground/10 font-sans",
          title: "font-display text-2xl uppercase tracking-wide",
          confirmButton: "rounded-full px-8 py-3 text-xs uppercase tracking-[0.2em]",
        },
      });
    }
  };

  return (
    <div className="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-8">
      <button
        type="button"
        aria-label="Close warranty form"
        className="absolute inset-0 bg-ink/70 backdrop-blur-sm"
        onClick={closeWarrantyModal}
      />

      <div
        role="dialog"
        aria-modal="true"
        aria-labelledby="warranty-modal-title"
        className="relative z-[101] max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-sm bg-cream shadow-2xl"
      >
        <div className="sticky top-0 flex items-center justify-between border-b border-foreground/10 bg-cream px-6 py-5 md:px-8">
          <div>
            <div className="eyebrow text-foreground/50">Warranty service</div>
            <h2
              id="warranty-modal-title"
              className="mt-2 font-display text-3xl uppercase tracking-[-0.01em] text-foreground"
            >
              Request a warranty repair
            </h2>
          </div>
          <button
            type="button"
            onClick={closeWarrantyModal}
            className="flex h-10 w-10 items-center justify-center rounded-full border border-foreground/15 text-foreground/70 transition hover:bg-foreground hover:text-cream"
            aria-label="Close"
          >
            ×
          </button>
        </div>

        <div className="px-6 py-8 md:px-8">
          <form onSubmit={handleSubmit} className="space-y-8" noValidate>
            <div className="grid gap-8 md:grid-cols-2">
              <div>
                <label htmlFor="warranty-name" className={labelClass}>
                  Name
                </label>
                <input
                  id="warranty-name"
                  type="text"
                  name="name"
                  required
                  value={form.name}
                  onChange={(e) => updateField("name", e.target.value)}
                  className={fieldClass}
                  placeholder="Your name"
                />
                {errors.name && <p className="footer-sans mt-2 text-sm text-red-700">{errors.name}</p>}
              </div>
              <div>
                <label htmlFor="warranty-email" className={labelClass}>
                  Email
                </label>
                <input
                  id="warranty-email"
                  type="email"
                  name="email"
                  required
                  value={form.email}
                  onChange={(e) => updateField("email", e.target.value)}
                  className={`${fieldClass} footer-sans`}
                  placeholder="you@email.com"
                />
                {errors.email && <p className="footer-sans mt-2 text-sm text-red-700">{errors.email}</p>}
              </div>
            </div>

            <div className="grid gap-8 md:grid-cols-2">
              <div>
                <label htmlFor="warranty-phone" className={labelClass}>
                  Phone
                </label>
                <input
                  id="warranty-phone"
                  type="tel"
                  name="phone"
                  value={form.phone}
                  onChange={(e) => updateField("phone", e.target.value)}
                  className={`${fieldClass} footer-sans`}
                  placeholder="Optional"
                />
                {errors.phone && <p className="footer-sans mt-2 text-sm text-red-700">{errors.phone}</p>}
              </div>
              <div>
                <label htmlFor="warranty-address" className={labelClass}>
                  Address / location
                </label>
                <input
                  id="warranty-address"
                  type="text"
                  name="address"
                  value={form.address}
                  onChange={(e) => updateField("address", e.target.value)}
                  className={fieldClass}
                  placeholder="Where the work was installed"
                />
                {errors.address && (
                  <p className="footer-sans mt-2 text-sm text-red-700">{errors.address}</p>
                )}
              </div>
            </div>

            <div>
              <label htmlFor="warranty-message" className={labelClass}>
                Issue details
              </label>
              <textarea
                id="warranty-message"
                name="message"
                required
                rows={4}
                value={form.message}
                onChange={(e) => updateField("message", e.target.value)}
                className={`${fieldClass} resize-y`}
                placeholder="Describe the issue, when it started, and any relevant project details."
              />
              {errors.message && (
                <p className="footer-sans mt-2 text-sm text-red-700">{errors.message}</p>
              )}
            </div>

            <div className="flex flex-wrap gap-4">
              <button
                type="submit"
                disabled={status === "submitting"}
                className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream disabled:cursor-not-allowed disabled:opacity-60"
              >
                <span>{status === "submitting" ? "Sending..." : "Send request"}</span>
                <span className="relative z-[2]">→</span>
              </button>
              <button
                type="button"
                onClick={closeWarrantyModal}
                className="inline-flex items-center rounded-full border border-foreground/20 px-8 py-5 text-xs font-medium tracking-[0.2em] text-foreground/70 transition hover:border-foreground hover:text-foreground"
              >
                Cancel
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}
