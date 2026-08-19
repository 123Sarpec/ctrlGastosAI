/// <reference types="vite/client" />
import { createInertiaApp } from '@inertiajs/react'

createInertiaApp({
    title: title => `Ver Presupuesto - ${title}`,
    pages: {
        path: './Pages',
        extension: '.tsx',
    },
}) 