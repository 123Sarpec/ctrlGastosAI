import { create } from "zustand";
import { Presupuesto } from "@/types/presupuestos";
interface ExpenseModalState {
    isOpen: boolean;
    presupuesto: Presupuesto;
    openModal: () => void;
    closeModal: () => void;
    setPresupuesto: (presupuesto: Presupuesto) => void;
}
export const useExpenseModalStore = create<ExpenseModalState>((set) => ({
    isOpen: false,
    presupuesto: null,
    openModal: () => set({ isOpen: true }),
    closeModal: () => set({ isOpen: false }),
    setPresupuesto: (presupuesto) => set({ presupuesto }),
})); 