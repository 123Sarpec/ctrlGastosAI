import AppLayout from "@/layouts/AppLayout";
import { useForm, usePage } from "@inertiajs/react";
import { route } from "ziggy-js";

export default function UpdateProfile() {

    const { user: { user: { name, email } } } = usePage().props;

    const {
        data,
        setData,
        errors,
        put,
        processing,
        clearErrors
    } = useForm({
        name,
        email
    });

    const submit = (e: React.SubmitEvent) => {
        e.preventDefault();

        put(route("settings.profile.update"), {

        });
    };

    console.log(errors);

    return (
        <AppLayout title="Ajustes">

            <div className="min-h-screen bg-gray-50 py-10">

                <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

                    {/* Encabezado */}
                    <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 mb-10">

                        <div>
                            <h1 className="text-3xl sm:text-4xl font-bold text-gray-900">
                                Ajustes
                            </h1>

                            <p className="mt-2 text-gray-500 text-lg">
                                Administra tu información personal y los datos de tu cuenta.
                            </p>
                        </div>

                        <a
                            href={route("dashboard")}
                            className="inline-flex items-center justify-center gap-2
                            bg-amber-500 hover:bg-amber-600
                            text-white font-semibold
                            px-5 py-3 rounded-xl
                            shadow-sm transition duration-200"
                        >
                            ← Volver a presupuestos
                        </a>

                    </div>


                    {/* Tarjeta principal */}
                    <div className="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

                        {/* Cabecera de perfil */}
                        <div className="bg-gradient-to-r from-purple-950 to-purple-800 px-6 sm:px-10 py-8">

                            <div className="flex items-center gap-5">

                                {/* Avatar */}
                                <div className="w-20 h-20 rounded-full bg-white/20
                                    border-2 border-white/40
                                    flex items-center justify-center
                                    text-white text-3xl font-bold
                                    backdrop-blur-sm">

                                    {name?.charAt(0)?.toUpperCase()}

                                </div>

                                <div className="text-white">

                                    <h2 className="text-2xl font-bold">
                                        {name}
                                    </h2>

                                    <p className="text-purple-200 mt-1">
                                        {email}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {/* Formulario */}
                        <form
                            onSubmit={submit}
                            className="p-6 sm:p-10 space-y-8"
                        >

                            <div>
                                <h3 className="text-xl font-bold text-gray-900">
                                    Información personal
                                </h3>

                                <p className="text-gray-500 mt-1">
                                    Actualiza los datos asociados a tu cuenta.
                                </p>
                            </div>


                            {/* Nombre */}
                            <div className="space-y-2">

                                <label
                                    htmlFor="name"
                                    className="block text-sm font-semibold text-gray-700"
                                >
                                    Nombre completo
                                </label>

                                <input
                                    id="name"
                                    type="text"
                                    placeholder="Tu nombre"
                                    value={data.name}
                                    onChange={(e) => {
                                        setData("name", e.target.value);
                                        clearErrors("name");
                                    }}
                                    className={`
                                        w-full
                                        px-4 py-3
                                        rounded-xl
                                        border
                                        outline-none
                                        transition
                                        bg-gray-50
                                        focus:bg-white
                                        focus:ring-2
                                        ${errors.name
                                            ? "border-red-500 focus:ring-red-200"
                                            : "border-gray-300 focus:border-purple-600 focus:ring-purple-200"
                                        }
                                    `}
                                />

                                {errors.name && (
                                    <p className="text-sm text-red-500">
                                        {errors.name}
                                    </p>
                                )}

                            </div>


                            {/* Email */}
                            <div className="space-y-2">

                                <label
                                    htmlFor="email"
                                    className="block text-sm font-semibold text-gray-700"
                                >
                                    Correo electrónico
                                </label>

                                <input
                                    id="email"
                                    type="email"
                                    placeholder="tu@email.com"
                                    value={data.email}
                                    onChange={(e) => {
                                        setData("email", e.target.value);
                                        clearErrors("email");
                                    }}
                                    className={`
                                        w-full
                                        px-4 py-3
                                        rounded-xl
                                        border
                                        outline-none
                                        transition
                                        bg-gray-50
                                        focus:bg-white
                                        focus:ring-2
                                        ${errors.email
                                            ? "border-red-500 focus:ring-red-200"
                                            : "border-gray-300 focus:border-purple-600 focus:ring-purple-200"
                                        }
                                    `}
                                />

                                {errors.email && (
                                    <p className="text-sm text-red-500">
                                        {errors.email}
                                    </p>
                                )}

                            </div>


                            {/* Separador */}
                            <div className="border-t border-gray-200" />


                            {/* Botón */}
                            <div className="flex flex-col sm:flex-row sm:justify-end gap-3">

                                <a
                                    href={route("dashboard")}
                                    className="px-6 py-3 rounded-xl
                                    border border-gray-300
                                    text-gray-700 font-semibold
                                    text-center
                                    hover:bg-gray-50
                                    transition"
                                >
                                    Cancelar
                                </a>

                                <button
                                    type="submit"
                                    disabled={processing}
                                    className="
                                        px-6 py-3
                                        rounded-xl
                                        bg-purple-950
                                        hover:bg-purple-800
                                        disabled:bg-gray-400
                                        disabled:cursor-not-allowed
                                        text-white
                                        font-semibold
                                        shadow-sm
                                        transition
                                    "
                                >
                                    {processing
                                        ? "Guardando..."
                                        : "Guardar cambios"
                                    }
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </AppLayout>
    );
}
