export function formatearCantidad(amount: number) {
    return new Intl.NumberFormat('es-GT', {
        style: 'currency',
        currency: 'GTQ',
    }).format(amount);
}

// formatear la fecha 

export function formatearFecha(date: string) {
    return new Intl.DateTimeFormat('es-GT', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    }).format(new Date(date));
}
