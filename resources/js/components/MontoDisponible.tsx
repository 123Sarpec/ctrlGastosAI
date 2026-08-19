import React from 'react';
import { formatearCantidad } from '@/utils';


type Props = {
    label: string;
    amount: number;
}

export default function MontoDisponible({ label, amount }: Props) {
    /* mostrar en una tabla el monto disponible en una columna */
    return (
        <p className='mt-5'>
            {label}
            <span className='block text-4xl font-bold mt-2'>{formatearCantidad(amount)}</span>
        </p>

    )
}  