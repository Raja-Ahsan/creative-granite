import { useState, type FormEvent } from "react";
import {
  contactFormErrorMessage,
  parseContactFormErrors,
  submitContactForm,
  type ContactFormData,
} from "@/services/contactForm";

const projectTypes = [
  { value: "new-construction", label: "New construction" },
  { value: "remodel", label: "Remodel & renovation" },
  { value: "multifamily", label: "Multifamily & commercial" },
  { value: "other", label: "Other" },
] as const;

const initialForm: ContactFormData = {
  name: "",
  email: "",
  phone: "",
  project_type: "new-construction",
  message: "",
};

const fieldClass =
  "mt-2 w-full border-b border-foreground/20 bg-transparent py-3 text-foreground outline-none transition-colors placeholder:text-foreground/35 focus:border-foreground";

const labelClass = "eyebrow text-foreground/50";

export function ContactForm() {
  const [form, setForm] = useState<ContactFormData>(initialForm);
  const [errors, setErrors] = useState<Partial<Record<keyof ContactFormData, string>>>({});
  const [status, setStatus] = useState<"idle" | "submitting" | "success" | "error">("idle");
  const [feedback, setFeedback] = useState("");

  const updateField = (field: keyof ContactFormData, value: string) => {
    setForm((current) => ({ ...current, [field]: value }));
    setErrors((current) => ({ ...current, [field]: undefined }));
  };

  const handleSubmit = async (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    setStatus("submitting");
    setFeedback("");
    setErrors({});

    try {
      const message = await submitContactForm(form);
      setStatus("success");
      setFeedback(message);
      setForm(initialForm);
    } catch (error) {
      const validationErrors = parseContactFormErrors(error);
      if (validationErrors) {
        setStatus("idle");
        setErrors(
          Object.fromEntries(
            Object.entries(validationErrors).map(([key, messages]) => [key, messages?.[0] ?? ""]),
          ) as Partial<Record<keyof ContactFormData, string>>,
        );
        return;
      }

      setStatus("error");
      setFeedback(contactFormErrorMessage(error));
    }
  };

  return (
    <form onSubmit={handleSubmit} className="space-y-8" noValidate>
      <div className="grid gap-8 md:grid-cols-2">
        <div>
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

        <div>
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

      <div className="grid gap-8 md:grid-cols-2">
        <div>
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

        <div>
          <label htmlFor="contact-project-type" className={labelClass}>
            Project type
          </label>
          <select
            id="contact-project-type"
            name="project_type"
            required
            value={form.project_type}
            onChange={(event) => updateField("project_type", event.target.value)}
            className={`${fieldClass} footer-sans cursor-pointer font-normal normal-case`}
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

      <div>
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

      {feedback && (
        <p
          className={`text-sm ${status === "success" ? "text-foreground/70" : "text-red-700"}`}
          role={status === "success" ? "status" : "alert"}
        >
          {feedback}
        </p>
      )}

      <button
        type="submit"
        disabled={status === "submitting"}
        data-cursor="estimate"
        className="btn-magnetic inline-flex items-center gap-3 rounded-full border border-foreground bg-foreground px-10 py-5 text-xs font-medium tracking-[0.25em] text-cream disabled:cursor-not-allowed disabled:opacity-60"
      >
        <span>{status === "submitting" ? "Sending..." : "Send message"}</span>
        <span className="relative z-[2]">→</span>
      </button>
    </form>
  );
}
