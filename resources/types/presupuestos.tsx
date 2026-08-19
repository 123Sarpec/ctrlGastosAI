type PresupuetoType = 'general' | 'goal';

export interface Presupuesto {
    id: number;
    name: string;
    amount: string;
    type: PresupuetoType;
    created_at: string;
} 