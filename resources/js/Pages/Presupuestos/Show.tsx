import { Head } from "@inertiajs/react";
import { Presupuesto } from "@/types/presupuestos";
import MontoDisponible from "@/components/MontoDisponible";
import ExpenseModal from "@/components/ExpenseModal";
import { useExpenseModalStore } from "@/stores/expense.modal";
import { Category } from "@/types/category";
type Props = {
    presupuesto: Presupuesto;
    categories: Category[];
}
export default function Show({ presupuesto, categories }: Props) {
    const openModal = useExpenseModalStore((state) => state.openModal);
    useExpenseModalStore.getState().setPresupuesto(presupuesto);

    return (
        <>
            <Head title={`Presupuesto: ${presupuesto.name}`} />
            <section className="sm:flex sm:items-center mt-10">
                <div className="sm:flex-auto">
                    <h1 className="font-bold text-4xl">Presupuesto: {presupuesto.name}</h1>
                    <p className="mt-2 text-xl text-gray-500">Maneja tu Presupuesto, añade, quita o edita tus gastos aquí.</p>
                </div>
                <div className="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a
                        href={'/dashboard'}
                        className="block bg-amber-500 text-white w-full px-5 py-3 rounded-lg  font-bold  text-xl cursor-pointer text-center">Volver a Presupuestos</a>
                </div>
            </section>

            <main className='grid grid-cols-1 md:grid-cols-2 items-center gap-20 mt-10'>

                <div className='space-y-5'>
                    <MontoDisponible label='Presupuesto' amount={+presupuesto.amount} />
                    <MontoDisponible label='Gastado' amount={0} />
                    <MontoDisponible label='Restante' amount={0} />
                </div>
            </main>
            {/*tomar el el amount de Presupuesto para Gastado y Restante*/}

            <section className="mt-10 flex ">
                <div className="bg-gray-50 text-black p-100 py-2 rounded justify-center">
                    <h2>Gastos</h2>
                    <button onClick={openModal} className="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded justify-left">
                        Nuevo Gastos
                    </button>
                </div>
            </section>


            <ExpenseModal />
        </>
    );
}