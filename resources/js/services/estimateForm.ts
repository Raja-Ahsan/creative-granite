import axios from "axios";

export type EstimateFormData = {
  name: string;
  email: string;
  phone: string;
  project_type: string;
  message: string;
};

export type EstimateFormErrors = Partial<Record<keyof EstimateFormData, string[]>>;

const client = axios.create({
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
    "X-Requested-With": "XMLHttpRequest",
  },
  withCredentials: true,
  withXSRFToken: true,
});

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");
if (csrfToken) {
  client.defaults.headers.common["X-CSRF-TOKEN"] = csrfToken;
}

export async function submitEstimateForm(data: EstimateFormData): Promise<string> {
  const response = await client.post<{ message: string }>("/estimate-request", data);

  return response.data.message;
}

export function parseEstimateFormErrors(error: unknown): EstimateFormErrors | null {
  if (!axios.isAxiosError(error) || error.response?.status !== 422) {
    return null;
  }

  return (error.response.data?.errors ?? {}) as EstimateFormErrors;
}

export function estimateFormErrorMessage(error: unknown): string {
  if (axios.isAxiosError(error) && typeof error.response?.data?.message === "string") {
    return error.response.data.message;
  }

  return "Something went wrong. Please try again or call us directly.";
}
