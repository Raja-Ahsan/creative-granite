import {
  createContext,
  useCallback,
  useContext,
  useEffect,
  useMemo,
  useState,
  type ReactNode,
} from "react";
import { EstimateModal } from "@/components/site/EstimateModal";

type EstimateModalContextValue = {
  openEstimateModal: () => void;
  closeEstimateModal: () => void;
  isOpen: boolean;
};

const EstimateModalContext = createContext<EstimateModalContextValue>({
  openEstimateModal: () => undefined,
  closeEstimateModal: () => undefined,
  isOpen: false,
});

export function EstimateModalProvider({ children }: { children: ReactNode }) {
  const [isOpen, setIsOpen] = useState(false);

  const openEstimateModal = useCallback(() => setIsOpen(true), []);
  const closeEstimateModal = useCallback(() => setIsOpen(false), []);

  useEffect(() => {
    const onClick = (event: MouseEvent) => {
      const anchor = (event.target as HTMLElement | null)?.closest("a");
      if (!anchor) return;

      const href = anchor.getAttribute("href") ?? "";
      if (!href.includes("#estimate")) return;

      event.preventDefault();
      openEstimateModal();
    };

    document.addEventListener("click", onClick);
    return () => document.removeEventListener("click", onClick);
  }, [openEstimateModal]);

  useEffect(() => {
    if (!isOpen) return;

    const onKeyDown = (event: KeyboardEvent) => {
      if (event.key === "Escape") closeEstimateModal();
    };

    document.body.style.overflow = "hidden";
    window.addEventListener("keydown", onKeyDown);

    return () => {
      document.body.style.overflow = "";
      window.removeEventListener("keydown", onKeyDown);
    };
  }, [isOpen, closeEstimateModal]);

  const value = useMemo(
    () => ({ openEstimateModal, closeEstimateModal, isOpen }),
    [openEstimateModal, closeEstimateModal, isOpen],
  );

  return (
    <EstimateModalContext.Provider value={value}>
      {children}
      <EstimateModal />
    </EstimateModalContext.Provider>
  );
}

export function useEstimateModal(): EstimateModalContextValue {
  return useContext(EstimateModalContext);
}
