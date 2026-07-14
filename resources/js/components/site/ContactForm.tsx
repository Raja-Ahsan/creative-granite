import { useEffect, useMemo, useState, type FormEvent } from "react";
import Swal from "sweetalert2";
import { useSiteContent } from "@/contexts/SiteContentContext";
import {
  contactFormErrorMessage,
  parseContactFormErrors,
  submitContactForm,
  type ContactFormData,
} from "@/services/contactForm";

const fieldClass =
  "mt-2 box-border min-w-0 w-full max-w-full border-b border-[#2a262280] bg-transparent py-3 text-[#2a262280] outline-none transition-colors placeholder:text-[#2a262280] focus:border-[#2a2622]";

const labelClass = "eyebrow block text-[#2a262280]";

const swalTheme = {
  confirmButtonColor: "#2a2622",
  background: "#f5f0ea",
  color: "#2a2622",
};

function showSuccessAlert(message: string) {
  return Swal.fire({
    icon: "success",
    title: "Message sent",
    text: message,
    confirmButtonText: "Done",
    ...swalTheme,
    customClass: {
      popup: "rounded-sm border border-foreground/10 font-sans",
      title: "font-display text-2xl uppercase tracking-wide",
      confirmButton: "rounded-full px-8 py-3 text-xs uppercase tracking-[0.2em]",
    },
  });
}

function showErrorAlert(message: string) {
  return Swal.fire({
    icon: "error",
    title: "Could not send",
    text: message,
    confirmButtonText: "Try again",
    ...swalTheme,
    customClass: {
      popup: "rounded-sm border border-foreground/10 font-sans",
      title: "font-display text-2xl uppercase tracking-wide",
      confirmButton: "rounded-full px-8 py-3 text-xs uppercase tracking-[0.2em]",
    },
  });
}

export function ContactForm() {
  const { projectTypes } = useSiteContent();
  const defaultProjectType = projectTypes[0]?.value ?? "";

  const initialForm = useMemo<ContactFormData>(
    () => ({
      name: "",
      email: "",
      phone: "",
      project_type: defaultProjectType,
      message: "",
    }),
    [defaultProjectType],
  );

  const [form, setForm] = useState<ContactFormData>(initialForm);
  const [errors, setErrors] = useState<Partial<Record<keyof ContactFormData, string>>>({});
  const [status, setStatus] = useState<"idle" | "submitting">("idle");

  useEffect(() => {
    setForm((current) => ({
      ...current,
      project_type: current.project_type || defaultProjectType,
    }));
  }, [defaultProjectType]);

  const updateField = (field: keyof ContactFormData, value: string) => {
    setForm((current) => ({ ...current, [field]: value }));
    setErrors((current) => ({ ...current, [field]: undefined }));
  };

  const handleSubmit = async (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    setStatus("submitting");
    setErrors({});

    try {
      const message = await submitContactForm(form);
      setForm(initialForm);
      setStatus("idle");
      await showSuccessAlert(message);
    } catch (error) {
      const validationErrors = parseContactFormErrors(error);
      if (validationErrors) {
        setStatus("idle");
        setErrors(
          Object.fromEntries(
            Object.entries(validationErrors).map(([key, messages]) => [key, messages?.[0] ?? ""]),
          ) as Partial<Record<keyof ContactFormData, string>>,
        );
        await Swal.fire({
          icon: "warning",
          title: "Check your form",
          text: "Please fix the highlighted fields and try again.",
          confirmButtonText: "OK",
          ...swalTheme,
          customClass: {
            popup: "rounded-sm border border-foreground/10 font-sans",
            title: "font-display text-2xl uppercase tracking-wide",
            confirmButton: "rounded-full px-8 py-3 text-xs uppercase tracking-[0.2em]",
          },
        });
        return;
      }

      setStatus("idle");
      await showErrorAlert(contactFormErrorMessage(error));
    }
  };

  if (!projectTypes.length) {
    return (
      <p className="text-sm font-light text-[#2a262280]">
        The contact form is temporarily unavailable. Please call or email us directly.
      </p>
    );
  }

  return (
    <form onSubmit={handleSubmit} className="w-full min-w-0 max-w-full space-y-6 sm:space-y-8" noValidate>
      <div className="grid min-w-0 grid-cols-1 gap-6 sm:gap-8 md:grid-cols-2">
        <div className="min-w-0">
          <label htmlFor="contact-name" className={labelClass}>
            Name
          </label>
          <input
            id="contact-name"
            type="text"
            name="name"
            autoComplete="name"
            required
            value={form.name}
            onChange={(event) => updateField("name", event.target.value)}
            className={fieldClass}
            placeholder="Your name"
          />
          {errors.name && <p className="footer-sans mt-2 text-sm text-red-700">{errors.name}</p>}
        </div>

        <div className="min-w-0">
          <label htmlFor="contact-email" className={labelClass}>
            Email
          </label>
          <input
            id="contact-email"
            type="email"
            name="email"
            autoComplete="email"
            required
            value={form.email}
            onChange={(event) => updateField("email", event.target.value)}
            className={`${fieldClass} footer-sans`}
            placeholder="you@email.com"
          />
          {errors.email && <p className="footer-sans mt-2 text-sm text-red-700">{errors.email}</p>}
        </div>
      </div>

      <div className="grid min-w-0 grid-cols-1 gap-6 sm:gap-8 md:grid-cols-2">
        <div className="min-w-0">
          <label htmlFor="contact-phone" className={labelClass}>
            Phone
          </label>
          <input
            id="contact-phone"
            type="tel"
            name="phone"
            autoComplete="tel"
            value={form.phone}
            onChange={(event) => updateField("phone", event.target.value)}
            className={`${fieldClass} footer-sans`}
            placeholder="Optional"
          />
          {errors.phone && <p className="footer-sans mt-2 text-sm text-red-700">{errors.phone}</p>}
        </div>

        <div className="min-w-0">
          <label htmlFor="contact-project-type" className={labelClass}>
            Project type
          </label>
          <select
            id="contact-project-type"
            name="project_type"
            required
            value={form.project_type}
            onChange={(event) => updateField("project_type", event.target.value)}
            className={`${fieldClass} footer-sans cursor-pointer font-normal`}
          >
            {projectTypes.map((option) => (
              <option key={option.value} value={option.value}>
                {option.label}
              </option>
            ))}
          </select>
          {errors.project_type && (
            <p className="footer-sans mt-2 text-sm text-red-700">{errors.project_type}</p>
          )}
        </div>
      </div>

      <div className="min-w-0">
        <label htmlFor="contact-message" className={labelClass}>
          Message
        </label>
        <textarea
          id="contact-message"
          name="message"
          required
          rows={5}
          value={form.message}
          onChange={(event) => updateField("message", event.target.value)}
          className={`${fieldClass} resize-y`}
          placeholder="Tell us about your project, timeline, and location."
        />
        {errors.message && <p className="footer-sans mt-2 text-sm text-red-700">{errors.message}</p>}
      </div>

      <button
        type="submit"
        disabled={status === "submitting"}
        data-cursor="estimate"
        className="btn-magnetic inline-flex w-full items-center justify-center gap-3 rounded-full border border-foreground bg-foreground px-8 py-5 text-xs font-medium tracking-[0.2em] text-cream disabled:cursor-not-allowed disabled:opacity-60 sm:w-auto sm:px-10"
      >
        <span>{status === "submitting" ? "Sending..." : "Send message"}</span>
        <span className="relative z-[2]">→</span>
      </button>
    </form>
  );
}
