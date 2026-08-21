import { create } from "zustand";
import { Presupuesto } from "@/types/presupuestos";
import { Category } from "@/types/category";
interface ExpenseModalState {
    isOpen: boolean;
    presupuesto: Presupuesto | null;
    categories: Category[];
    openModal: () => void;
    closeModal: () => void;
    setPresupuesto: (presupuesto: Presupuesto) => void;
    setCategories: (categories: Category[]) => void;
}
export const useExpenseModalStore = create<ExpenseModalState>((set) => ({
    isOpen: false,
    presupuesto: null,
    categories: [],
    openModal: () => set({ isOpen: true }),
    closeModal: () => set({ isOpen: false }),
    setPresupuesto: (presupuesto) => set({ presupuesto }),
    setCategories: (categories) => set({ categories }),
}));