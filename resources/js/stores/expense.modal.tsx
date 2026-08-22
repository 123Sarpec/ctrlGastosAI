import { create } from "zustand";
import { Expense, Presupuesto } from "@/types/presupuestos";
import { Category } from "@/types/category";
import { devtools } from "zustand/middleware";




interface ExpenseModalState {
    isOpen: boolean;
    presupuesto: Presupuesto | null;
    expense: Expense | null;
    categories: Category[];
    openModal: () => void;
    openEditModal: (expense: Expense) => void;
    closeModal: () => void;
    setPresupuesto: (presupuesto: Presupuesto) => void;
    setCategories: (categories: Category[]) => void;
}
export const useExpenseModalStore = create<ExpenseModalState>()(devtools((set) => ({
    isOpen: false,
    presupuesto: null,
    expense: null,
    categories: [],
    openModal: () => set({ isOpen: true }),

    openEditModal: (expense) => set({ isOpen: true, expense }),

    closeModal: () => set({ isOpen: false, expense: null }),

    setPresupuesto: (presupuesto) => set({ presupuesto }),

    setCategories: (categories) => set({ categories }),
}))); 