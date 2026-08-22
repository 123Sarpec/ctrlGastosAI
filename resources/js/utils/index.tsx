export function formatearCantidad(amount: number) {
    return new Intl.NumberFormat('en-US', {
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
