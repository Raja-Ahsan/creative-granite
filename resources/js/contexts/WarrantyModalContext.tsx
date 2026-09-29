import {
  createContext,
  useCallback,
  useContext,
  useEffect,
  useMemo,
  useState,
  type ReactNode,
} from "react";
import { WarrantyModal } from "@/components/site/WarrantyModal";

type WarrantyModalContextValue = {
  openWarrantyModal: () => void;
  closeWarrantyModal: () => void;
  isOpen: boolean;
};

const WarrantyModalContext = createContext<WarrantyModalContextValue>({
  openWarrantyModal: () => undefined,
  closeWarrantyModal: () => undefined,
  isOpen: false,
});

export function WarrantyModalProvider({ children }: { children: ReactNode }) {
  const [isOpen, setIsOpen] = useState(false);

  const openWarrantyModal = useCallback(() => setIsOpen(true), []);
  const closeWarrantyModal = useCallback(() => setIsOpen(false), []);

  useEffect(() => {
    const onClick = (event: MouseEvent) => {
      const anchor = (event.target as HTMLElement | null)?.closest("a");
      if (!anchor) return;

      const href = anchor.getAttribute("href") ?? "";
      if (!href.includes("#warranty")) return;

      event.preventDefault();
      openWarrantyModal();
    };

    document.addEventListener("click", onClick);
    return () => document.removeEventListener("click", onClick);
  }, [openWarrantyModal]);

  useEffect(() => {
    if (!isOpen) return;

    const onKeyDown = (event: KeyboardEvent) => {
      if (event.key === "Escape") closeWarrantyModal();
    };

    document.body.style.overflow = "hidden";
    window.addEventListener("keydown", onKeyDown);

    return () => {
      document.body.style.overflow = "";
      window.removeEventListener("keydown", onKeyDown);
    };
  }, [isOpen, closeWarrantyModal]);

  const value = useMemo(
    () => ({ openWarrantyModal, closeWarrantyModal, isOpen }),
    [openWarrantyModal, closeWarrantyModal, isOpen],
  );

  return (
    <WarrantyModalContext.Provider value={value}>
      {children}
      <WarrantyModal />
    </WarrantyModalContext.Provider>
  );
}

export function useWarrantyModal(): WarrantyModalContextValue {
  return useContext(WarrantyModalContext);
}
