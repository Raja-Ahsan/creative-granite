import axios from "axios";

/**
 * Shared Axios instance for Laravel API routes.
 * Wire endpoints here as the backend is migrated.
 */
const api = axios.create({
  baseURL: "/api",
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
    "X-Requested-With": "XMLHttpRequest",
  },
  withCredentials: true,
  withXSRFToken: true,
});

export default api;
