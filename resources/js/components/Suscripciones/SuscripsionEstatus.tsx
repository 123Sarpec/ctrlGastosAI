import { Subscription } from "@/types/subscription";
import { formatDate } from "@/utils";

type Props = {
    isYearly: boolean;
    color: String;
    status_label: Subscription['status_label']
    price: Subscription['price']
}

export default function SubscriptionStatus({ isYearly, color, status_label, price }: Props) {

    return (
        <div className="rounded-xl border border-slate-300  p-6 mb-6">
            <div className="flex justify-between items-start mb-4">
                <div>
                    <span className="text-sm text-gray-500 uppercase tracking-wide">
                        Plan actual
                    </span>
                    <h2 className="text-2xl font-bold flex items-center gap-2 mt-1">
                        PRO {isYearly ? 'Anual' : 'Mensual'}
                    </h2>
                </div>
                <div className="text-right">
                    <div className="text-3xl font-black animate-bounce  w-full py-2">
                        ${price}
                        <span className="text-base font-normal text-gray-500">
                            /{isYearly ? 'Año' : 'Mes'}
                        </span>
                    </div>
                </div>
            </div>

            <div className="border-t border-slate-300 pt-4 space-y-2 text-sm">
                <div className={`rounded-lg border p-4 mb-4 ${color} `}>
                    <div className="font-bold text-xl">
                        {status_label.text}
                    </div>
                    {status_label.date ? (
                        <p className="mt-1 font-semibold">
                            {status_label.description}
                            <span className="font-medium">{formatDate(status_label.date)}</span>
                        </p>
                    ) : (
                        <p className="mt-1 text-black">
                            {status_label.description}
                        </p>
                    )}

                </div>
            </div>
        </div>
    )
}