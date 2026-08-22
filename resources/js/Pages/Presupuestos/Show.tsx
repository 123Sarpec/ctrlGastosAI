import { Head, usePage } from "@inertiajs/react";
import { useEffect, useState } from "react";

import { Presupuesto } from "@/types/presupuestos";
import { Category } from "@/types/category";
import { ToastContainer, toast } from "react-toastify";

import AmountDisplay from "@/components/MontoDisponible";
import ExpenseModal from "@/components/ExpenseModal";
import { useExpenseModalStore } from "@/stores/expense.modal";
import { formatearCantidad, formatearFecha } from "@/utils";
import ProgressBar from "@/components/ProgressBar";
import ExpenseDropdown from "@/components/ExpenseDropwn";

type Props = {
    presupuesto: Presupuesto;
    categories: Category[];
    spent: string;
};

export default function Show({ presupuesto, categories, spent }: Props) {

    const openModal = useExpenseModalStore((state) => state.openModal);

    const { flash } = usePage().props;
    /*mensaje de exito*/
    useEffect(() => {
        if (flash.success) {
            toast.success(flash.success);
        }
    }, [flash]);

    /*para que el modal tenga la informacion del presupuesto y las categorias*/
    useEffect(() => {
        useExpenseModalStore.getState().setPresupuesto(presupuesto);
        useExpenseModalStore.getState().setCategories(categories);
    }, [presupuesto, categories]);

    /*calcular porcentaje usado*/
    const restatante = +presupuesto.amount - +spent;
    const porcentajeUsed = +((+spent / +presupuesto.amount) * 100).toFixed(2);
    const [progress, setProgress] = useState(0);
    useEffect(() => {
        const timeout = setTimeout(() => {
            setProgress(porcentajeUsed);
        }, 100)

        return () => clearTimeout(timeout);
    }, [porcentajeUsed]);

    return (
        <>
            <Head title={`Presupuesto: ${presupuesto.name}`} />
            <div className="min-h-screen bg-gray-50 px-4 py-6 sm:px-6 lg:px-8">
                <div className="mx-auto max-w-7xl">
                    <section className="mb-8">
                        <div className="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p className="text-sm font-semibold uppercase tracking-wide text-gray-500">
                                    Nombre del presupuesto
                                </p>
                                <h1 className="mt-1 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                                    {presupuesto.name}
                                </h1>
                                <p className="mt-2 max-w-2xl text-sm text-gray-500 sm:text-base">
                                    Administra tu presupuesto, controla tus gastos
                                    y revisa cuánto dinero tienes disponible.
                                </p>
                            </div>
                            <a
                                href="/dashboard"
                                className="inline-flex w-full items-center justify-center rounded-lg bg-gray-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-700 sm:w-auto"
                            >
                                Volver a presupuestos
                            </a>
                        </div>
                    </section>
                    <main className="grid grid-cols-1 md:grid-cols-2 items-center rounded-2xl border border-gray-100">

                        <div className="flex justify-center">
                            <ProgressBar porcentajeUsed={progress} />
                        </div>
                        <div className="space-y-4">
                            <AmountDisplay
                                label="Presupuesto"
                                amount={Number(presupuesto.amount)}
                            />

                            <AmountDisplay
                                label="Gastado"
                                amount={+spent}
                            />

                            <AmountDisplay
                                label="Restante"
                                amount={restatante}
                            />
                        </div>
                    </main>

                    {/* GASTOS */}
                    <section className="mt-8 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">

                        {/* HEADER DE GASTOS */}
                        <div className="flex flex-col gap-4 border-b border-gray-200 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">

                            <div>
                                <h2 className="text-xl font-bold text-gray-900">
                                    Gastos
                                </h2>

                                <p className="mt-1 text-sm text-gray-500">
                                    Agrega y administra los gastos de tu presupuesto.
                                </p>
                            </div>

                            <button
                                type="button"
                                onClick={openModal}
                                className="inline-flex w-full items-center justify-center rounded-lg bg-green-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:w-auto"
                            >
                                Nuevo gasto
                            </button>

                        </div>
                        {presupuesto.expenses?.length ? (
                            <>
                                <div className="p-5 sm:p-6">
                                    <div className="rounded-lg border border-dashed border-gray-300 bg-gray-50 px-4 py-10 ">
                                        <table className="relative min-w-full">
                                            <thead>
                                                <tr>
                                                    <th scope="col">
                                                        <span className="sr-only">
                                                            Gastos
                                                        </span>
                                                    </th>
                                                    <th scope="col">
                                                        <span className="sr-only">
                                                            Acciones
                                                        </span>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody className="divide-y divide-gray-300 ">
                                                {presupuesto.expenses.map((expense) => (
                                                    <tr key={expense.id} className="flex items-center justify-between">

                                                        <td className="relative px-10 pb-5 gap-2">
                                                            {presupuesto.type === 'general' && (
                                                                <p className={`text-sm text-gray-900 border-b rounded-2xl text-center ${expense.category_color}`}>
                                                                    {expense.category_label}
                                                                </p>
                                                            )}

                                                            <p className="text-xl font-bold text-gray-500">
                                                                {expense.name}
                                                            </p>
                                                            <p className="text-lg text-gray-500">
                                                                {formatearCantidad(expense.amount)}
                                                            </p>
                                                            <p className="text-sm text-gray-400"> Agregado el: {formatearFecha(expense.created_at)}</p>
                                                        </td>

                                                        <td className="flex justify-end gap-3 px-10 py-6">
                                                            <ExpenseDropdown expense={expense} />
                                                        </td>
                                                    </tr>
                                                ))}

                                                <tr className="flex items-center justify-between">

                                                    <td className="relative px-10 pb-5">

                                                        <p className="absolute left-0 top-0 inline-block w-40 rounded-br-2xl px-3 py-1 text-sm font-medium">
                                                            Categoría
                                                        </p>

                                                        <p className="text-xl font-bold text-gray-500">
                                                        </p>

                                                        <p className="text-lg text-gray-500">
                                                        </p>

                                                        <p className="text-sm text-gray-400">
                                                        </p>

                                                    </td>

                                                    <td className="flex justify-end gap-3 px-10 py-6">
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </>
                        ) : (
                            <p className="mt-10 text-center text-xl">
                                No hay gastos.
                                <button
                                    type="button"
                                    onClick={openModal}
                                    className="ml-2 text-amber-500 hover:text-amber-600"
                                >
                                    Comienza creando uno
                                </button>
                            </p>
                        )}

                    </section>
                </div>
            </div>

            <ExpenseModal />
            <ToastContainer />
        </>
    );
}