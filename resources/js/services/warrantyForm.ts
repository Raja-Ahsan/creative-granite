import axios from "axios";

export type WarrantyFormData = {
  name: string;
  email: string;
  phone: string;
  address: string;
  message: string;
};

export type WarrantyFormErrors = Partial<Record<keyof WarrantyFormData, string[]>>;

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

export async function submitWarrantyForm(data: WarrantyFormData): Promise<string> {
  const response = await client.post<{ message: string }>("/warranty-request", data);

  return response.data.message;
}

export function parseWarrantyFormErrors(error: unknown): WarrantyFormErrors | null {
  if (!axios.isAxiosError(error) || error.response?.status !== 422) {
    return null;
  }

  return (error.response.data?.errors ?? {}) as WarrantyFormErrors;
}

export function warrantyFormErrorMessage(error: unknown): string {
  if (axios.isAxiosError(error) && typeof error.response?.data?.message === "string") {
    return error.response.data.message;
  }

  return "Something went wrong. Please try again or call us directly.";
}
