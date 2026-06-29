import axios from "axios";

export type ContactFormData = {
  name: string;
  email: string;
  phone: string;
  project_type: string;
  message: string;
};

export type ContactFormErrors = Partial<Record<keyof ContactFormData, string[]>>;

const client = axios.create({
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
    "X-Requested-With": "XMLHttpRequest",
  },
  withCredentials: true,
  withXSRFToken: true,
});

export async function submitContactForm(data: ContactFormData): Promise<string> {
  const response = await client.post<{ message: string }>("/contact", data);

  return response.data.message;
}

export function parseContactFormErrors(error: unknown): ContactFormErrors | null {
  if (!axios.isAxiosError(error) || error.response?.status !== 422) {
    return null;
  }

  return (error.response.data?.errors ?? {}) as ContactFormErrors;
}

export function contactFormErrorMessage(error: unknown): string {
  if (axios.isAxiosError(error) && typeof error.response?.data?.message === "string") {
    return error.response.data.message;
  }

  return "Something went wrong. Please try again or call us directly.";
}
