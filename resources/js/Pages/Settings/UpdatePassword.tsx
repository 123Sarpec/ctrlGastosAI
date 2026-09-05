import AppLayout from "@/layouts/AppLayout";
import { useForm } from "@inertiajs/react";
import { route } from "ziggy-js";

export default function UpdatePassword() {

    const { data, setData, errors, put, processing, clearErrors } = useForm({
        current_password: "",
        password: "",
        password_confirmation: "",
    });

    const submit = (e: React.SubmitEvent) => {
        e.preventDefault();

        put(route("settings.password.update"), {
            onSuccess: () => {
                setData({
                    current_password: "",
                    password: "",
                    password_confirmation: "",
                });
            }
        });
    };

    return (
        < AppLayout title="Cambiar contraseña" >
            <div className="min-h-screen bg-gray-50 py-10">
                <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                    {/* Encabezado */}
                    <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 mb-10">

                        <div>
                            <h1 className="text-3xl sm:text-4xl font-bold text-gray-900">
                                Cambiar contraseña
                            </h1>

                            <p className="mt-2 text-gray-500 text-lg">
                                Actualiza la contraseña de tu cuenta para mantenerla segura.
                            </p>
                        </div>

                        <a
                            href={route("dashboard")}
                            className="
                            inline-flex items-center justify-center gap-2
                            bg-amber-500 hover:bg-amber-600
                            text-white font-semibold
                            px-5 py-3
                            rounded-xl
                            shadow-sm
                            transition duration-200
                        "
                        >
                            ← Volver a presupuestos
                        </a>

                    </div>


                    {/* Tarjeta */}
                    <div className="max-w-2xl mx-auto">

                        <div className="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

                            {/* Cabecera */}
                            <div className="bg-gradient-to-r from-purple-950 to-purple-800 px-6 sm:px-10 py-8">

                                <div className="flex items-center gap-5">

                                    <div className="text-white">

                                        <h2 className="text-2xl font-bold">
                                            Seguridad de la cuenta
                                        </h2>

                                        <p className="text-purple-200 mt-1">
                                            Cambia tu contraseña de forma segura.
                                        </p>

                                    </div>

                                </div>

                            </div>


                            {/* Formulario */}
                            <form
                                onSubmit={submit}
                                className="p-6 sm:p-10 space-y-7"
                            >

                                {/* Información */}
                                <div className="bg-purple-50 border border-purple-100 rounded-xl p-4">

                                    <p className="text-sm text-purple-900">
                                        <span className="font-bold">
                                            Consejo de seguridad:
                                        </span>{" "}
                                        utiliza una contraseña de al menos 8 caracteres,
                                        combinando letras, números y símbolos.
                                    </p>

                                </div>


                                {/* Contraseña actual */}
                                <div className="space-y-2">

                                    <label
                                        htmlFor="current_password"
                                        className="block text-sm font-semibold text-gray-700"
                                    >
                                        Contraseña actual
                                    </label>

                                    <input
                                        id="current_password"
                                        type="password"
                                        autoComplete="current-password"
                                        placeholder="Introduce tu contraseña actual"
                                        value={data.current_password}
                                        onChange={(e) => {
                                            setData(
                                                "current_password",
                                                e.target.value
                                            );
                                            clearErrors("current_password");
                                        }}
                                        className={`
                                        w-full
                                        px-4 py-3
                                        rounded-xl
                                        border
                                        bg-gray-50
                                        outline-none
                                        transition
                                        focus:bg-white
                                        focus:ring-2
                                        ${errors.current_password
                                                ? "border-red-500 focus:ring-red-200"
                                                : "border-gray-300 focus:border-purple-600 focus:ring-purple-200"
                                            }
                                    `}
                                    />

                                    {errors.current_password && (
                                        <p className="text-sm text-red-500">
                                            {errors.current_password}
                                        </p>
                                    )}

                                </div>


                                {/* Nueva contraseña */}
                                <div className="space-y-2">

                                    <label
                                        htmlFor="password"
                                        className="block text-sm font-semibold text-gray-700"
                                    >
                                        Nueva contraseña
                                    </label>

                                    <input
                                        id="password"
                                        type="password"
                                        autoComplete="new-password"
                                        placeholder="Mínimo 8 caracteres"
                                        value={data.password}
                                        onChange={(e) => {
                                            setData(
                                                "password",
                                                e.target.value
                                            );
                                            clearErrors("password");
                                        }}
                                        className={`
                                        w-full
                                        px-4 py-3
                                        rounded-xl
                                        border
                                        bg-gray-50
                                        outline-none
                                        transition
                                        focus:bg-white
                                        focus:ring-2
                                        ${errors.password
                                                ? "border-red-500 focus:ring-red-200"
                                                : "border-gray-300 focus:border-purple-600 focus:ring-purple-200"
                                            }
                                    `}
                                    />

                                    {errors.password && (
                                        <p className="text-sm text-red-500">
                                            {errors.password}
                                        </p>
                                    )}

                                </div>


                                {/* Confirmar contraseña */}
                                <div className="space-y-2">

                                    <label
                                        htmlFor="password_confirmation"
                                        className="block text-sm font-semibold text-gray-700"
                                    >
                                        Confirmar nueva contraseña
                                    </label>

                                    <input
                                        id="password_confirmation"
                                        type="password"
                                        autoComplete="new-password"
                                        placeholder="Repite tu nueva contraseña"
                                        value={data.password_confirmation}
                                        onChange={(e) => {
                                            setData(
                                                "password_confirmation",
                                                e.target.value
                                            );
                                            clearErrors("password_confirmation");
                                        }}
                                        className={`
                                        w-full
                                        px-4 py-3
                                        rounded-xl
                                        border
                                        bg-gray-50
                                        outline-none
                                        transition
                                        focus:bg-white
                                        focus:ring-2
                                        ${errors.password_confirmation
                                                ? "border-red-500 focus:ring-red-200"
                                                : "border-gray-300 focus:border-purple-600 focus:ring-purple-200"
                                            }
                                    `}
                                    />

                                    {errors.password_confirmation && (
                                        <p className="text-sm text-red-500">
                                            {errors.password_confirmation}
                                        </p>
                                    )}

                                </div>


                                {/* Separador */}
                                <div className="border-t border-gray-200" />


                                {/* Botones */}
                                <div className="flex flex-col sm:flex-row gap-3">

                                    <a
                                        href={route("dashboard")}
                                        className="
                                        flex-1
                                        px-6 py-3
                                        rounded-xl
                                        border border-gray-300
                                        text-gray-700
                                        font-semibold
                                        text-center
                                        hover:bg-gray-50
                                        transition
                                    "
                                    >
                                        Cancelar
                                    </a>

                                    <button
                                        type="submit"
                                        disabled={processing}
                                        className="
                                        flex-1
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
                                            ? "Cambiando..."
                                            : "Cambiar contraseña"
                                        }
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>
        </AppLayout>
    );
}
