import { Head, usePage } from "@inertiajs/react";
import { useEffect } from "react";

import { Presupuesto } from "@/types/presupuestos";
import { Category } from "@/types/category";

import MontoDisponible from "@/components/MontoDisponible";
import ExpenseModal from "@/components/ExpenseModal";
import { useExpenseModalStore } from "@/stores/expense.modal";

type Props = {
    presupuesto: Presupuesto;
    categories: Category[];
};

export default function Show({ presupuesto, categories }: Props) {

    const openModal = useExpenseModalStore(
        (state) => state.openModal
    );

    const { flash } = usePage().props;

    useEffect(() => {
        useExpenseModalStore
            .getState()
            .setPresupuesto(presupuesto);

        useExpenseModalStore
            .getState()
            .setCategories(categories);
    }, [presupuesto, categories]);

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

                    {/* TARJETAS DE DINERO */}
                    <section className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

                        <MontoDisponible
                            label="Presupuesto"
                            amount={Number(presupuesto.amount)}
                        />

                        <MontoDisponible
                            label="Gastado"
                            amount={0}
                        />

                        <MontoDisponible
                            label="Restante"
                            amount={Number(presupuesto.amount)}
                        />

                    </section>

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

                        {/* CONTENIDO */}
                        <div className="p-5 sm:p-6">

                            <div className="rounded-lg border border-dashed border-gray-300 bg-gray-50 px-4 py-10 text-center">
                                <h3 className="mt-4 text-base font-semibold text-gray-900">
                                    No hay gastos registrados
                                </h3>
                                <p className="mx-auto mt-1 max-w-md text-sm text-gray-500">
                                    Cuando agregues un gasto, aparecerá aquí
                                    para que puedas llevar el control de tu dinero.
                                </p>

                            </div>

                        </div>

                    </section>

                </div>
            </div>

            <ExpenseModal />
        </>
    );
}