import { useRef, useState } from 'react';
import { useChat } from '@ai-sdk/react';
import { DefaultChatTransport } from 'ai';
import { toast } from 'react-toastify';
import { router, usePage } from '@inertiajs/react';
import { Presupuesto } from '@/types/presupuestos';


type Props = {
    budgetId: number
    name: string;
    presupuesto: Presupuesto;
}


export default function CashTrackrAgent({ budgetId, name }: Props) {

    const [input, setInput] = useState('');
    const [isScanning, setIsScanning] = useState(false);
    const fileInputRef = useRef<HTMLInputElement>(null);


    const { sendMessage, messages, status, setMessages } = useChat({
        transport: new DefaultChatTransport({
            api: `/dashboard/Presupuestos/${budgetId}/chat`
        }),
        onFinish: ({ message }) => {
            const expenseCreated = message.parts.some(part => {
                if (!part.output) return null
                console.log(message)
                return part.output.startsWith('[EXPENSE_CREATED]')
            })
            if (expenseCreated) {
                toast.success('Gasto creado correctamente')
                router.reload({ only: ['expenses', 'presupuesto', 'spent'] })
            }

        }
    })
    const handleImageUpload = async (e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files?.[0]
        if (!file) return
        setIsScanning(true);
        setMessages(prev => [
            ...prev,
            {
                id: crypto.randomUUID(),
                role: 'user' as const,
                content: 'Imagen subida correctamente',
                parts: [{ type: 'text', text: 'Imagen subida correctamente' }],
            }
        ])
        try {
            const csrfToken = document.querySelector<HTMLMetaElement>('meta[name="csrf-token"]')?.content ?? ''
            const formData = new FormData()
            formData.append('image', file)

            const response = await fetch(`/dashboard/Presupuestos/${budgetId}/addimage`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                credentials: 'same-origin',
                body: formData
            })
            const data = await response.json()
            console.log('ADD TICKET RESPONSE:', {
                // status: response.status,
                // ok: response.ok,
                // data,
            })
            setMessages(prev => [
                ...prev,
                {
                    id: crypto.randomUUID(),
                    role: 'assistant' as const,
                    content: data.message,
                    parts: [{ type: 'text', text: data.message }],
                }
            ])
            if (data.success) {
                toast.success('Ticket agregado correctamente');
                router.reload();
            }
        } catch (error) {
            console.error('Error al subir la imagen', error)
            setMessages(prev => [
                ...prev,
                {
                    id: crypto.randomUUID(),
                    role: 'assistant' as const,
                    content: 'Error al subir la imagen, intentalo de nuevo',
                    parts: [{ type: 'text', text: 'Error al subir la imagen, intentalo de nuevo' }],
                }
            ])
        } finally {
            setIsScanning(false);
            if (fileInputRef.current) fileInputRef.current.value = '';
        }

    }
    // /*deslaivilitar el boton cuando es pensando la <ia></ia>
    const isBusy = status === 'streaming' || status === 'submitted' || isScanning;

    return (
        <section className='p-10 lg:px-5 shadow-lg mt-10'>
            <h2 className="text-3xl font-bold">Pregunta sobre tu Presupuesto, añade gastos y más.</h2>
            <div className="space-y-3 mb-4 mt-8">
                {messages.map((m, i) => (
                    <div
                        key={m.id}
                        className={`p-3 rounded-lg max-w-[80%] lg:max-w-[60%]  rounded-lg p-3 mt-4 ${m.role === 'user'
                            ? 'bg-gray-300 ml-auto rounded-tr-none text-wrap text-black'
                            : 'bg-gray-100 text-black mr-auto rounded-tl-none text-wrap'}`}
                    >
                        {m.parts.map((part, i) => {
                            if (part.type !== 'text') return null;

                            const text = part.text.trim();

                            if (!text) return null;

                            return (
                                <p className="text-xl" key={i}>
                                    <strong>
                                        {m.role === 'user' ? name + ': ' : 'Asistente: '}
                                    </strong>
                                    {text.replace('[EXPENSE_CREATED]', '').trim()}
                                </p>
                            );
                        })}
                    </div>
                ))}
                {isScanning && (
                    <div className='flex items-center gap-2 mt-4'>
                        <strong className='text-2xl animate-spin'>...</strong>
                        <p className='text-gray-700 text-xl'>Analizando imagen...</p>
                    </div>
                )}
                {(status === 'submitted' || status === 'streaming') && !isScanning && (
                    <div className="flex items-center gap-2 mt-4">
                        <strong className='text-2xl animate-spin'>...</strong>
                        <span className="text-gray-600">
                            Analizando datos...
                        </span>

                    </div>
                )}
            </div>

            <form
                onSubmit={(e) => {
                    e.preventDefault();
                    if (input) {
                        sendMessage({ text: input });
                        setInput('');
                    }
                }}
                className="flex flex-col gap-2"
            >
                <textarea
                    value={input}
                    onChange={(e) => setInput(e.target.value)}
                    placeholder="Consulta dudas sobre tu Presupuesto o Agrega Gastos"
                    className="w-full border border-gray-300 p-3 rounded-lg text-xl"
                    disabled={isBusy}
                />
                <div className="flex gap-2">
                    <button
                        type="submit"
                        className="flex-1 mt-5 bg-purple-950 hover:bg-purple-800 p-3 rounded-lg text-white font-bold text-xl cursor-pointer disabled:opacity-20"
                        disabled={isBusy || !input.trim()}
                    >
                        {status == 'streaming' ? 'Pensando...' : 'Consultar'}
                    </button>
                    <button
                        type="button"
                        onClick={() => fileInputRef.current?.click()}
                        className="mt-5 bg-amber-500 hover:bg-amber-500 p-3 rounded-lg text-white font-bold text-xl cursor-pointer disabled:opacity-20"
                    >
                        {isScanning ? 'Subiendo imagen...' : 'Subir Ticket'}
                    </button>
                </div>
                <input
                    type="file"
                    accept="image/*"
                    className="hidden"
                    ref={fileInputRef}
                    onChange={handleImageUpload}
                // ref={fileInput}
                // onChange={(e) => {
                //     const file = e.target.files?.[0];
                //     if (file) {
                //         sendMessage({ file });
                //     }
                // }}
                />
            </form>
        </section>
    );
}