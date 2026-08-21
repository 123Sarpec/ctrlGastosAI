import { useExpenseModalStore } from "@/stores/expense.modal";
import { useForm } from "@inertiajs/react";
import Ziggy from "ziggy-js";
import { route } from "ziggy-js";
import inputerror from "./inputerror";
import InputError from "@/components/inputerror";
export default function ExpensForm() {


    const presupuesto = useExpenseModalStore(state => state.presupuesto);
    const categories = useExpenseModalStore(state => state.categories);

    const { data, setData, post, errors } = useForm({
        name: '',
        amount: '',
        category: '',
    });
    if (!presupuesto) return null;

    const submit = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();

        post(route('expenses.store', presupuesto.id));

    }


    return (
        <div className='p-10 flex justify-center'>
            <form onSubmit={submit} className='flex flex-col space-y-3 w-full'>

                <div className='space-y-3'>
                    <label htmlFor="name" className='block text-xl font-bold'>Nombre Gasto</label>
                    <input
                        id="name"
                        type="text"
                        placeholder="Nombre del gasto"
                        className="w-full border border-gray-300 p-3 rounded-lg"
                        value={data.name}
                        onChange={(e) => {
                            // console.log("VALOR ESCRITO:", e.target.value);
                            setData("name", e.target.value);
                        }}
                    />
                    {errors.name && (
                        <InputError>
                            {errors.name}
                        </InputError>
                    )}
                </div>
                <div className='space-y-3'>
                    <label htmlFor="amount" className='block text-xl font-bold'>Cantidad Gasto</label>
                    <input
                        id='amount'
                        type="number"
                        placeholder="Cantidad"
                        className="w-full border border-gray-300 p-3 rounded-lg"
                        value={data.amount}
                        onChange={(e) => setData("amount", e.target.value)}
                    />
                    {errors.amount && <InputError>{errors.amount}</InputError>}

                </div>

                {presupuesto.type === 'general' && (
                    <div className='space-y-3'>
                        <label htmlFor="category" className='block text-xl font-bold'>Categoría Gasto</label>
                        <select
                            name="category"
                            id="category"
                            className='w-full border border-gray-300 p-3 rounded-lg text-black'
                            value={data.category}
                            onChange={(e) => setData("category", e.target.value)}
                        >
                            <option value="">Selecciona Categoría</option>
                            {categories.map(category => (
                                <option key={category.value} value={category.value}>{category.label}</option>
                            ))}
                        </select>
                        {errors.category && <InputError>{errors.category}</InputError>}

                    </div>
                )}

                <button type="submit" className="mt-5 bg-purple-950 hover:bg-purple-800 w-full p-3 rounded-lg text-white font-bold  text-xl cursor-pointer">
                    Agregar Gasto
                </button>
            </form>
        </div>
    )
} 