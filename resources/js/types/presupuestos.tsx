export interface Expense {
    id: number;
    name: string;
    amount: number | string;
    category?: string;
    presupuesto_id?: number;
    created_at?: string;
    updated_at?: string;
}

export interface Presupuesto {
    id: number;
    name: string;
    amount: number | string;
    type?: string;
    user_id?: number;
    expenses?: Expense[];
    created_at?: string;
    updated_at?: string;
}
