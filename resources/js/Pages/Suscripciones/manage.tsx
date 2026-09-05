import SuscripsionEstats from '@/Components/Suscripciones/SuscripsionEstatus';
import { Subscription } from "@/types/subscription";
import SuscripsionUpgrade from "@/components/Suscripciones/SuscripsionUpgrade";
import SuscripsionDowngrade from "@/components/Suscripciones/SuscripsionDowngrade";
import SubscriptionCancellation from "@/components/Suscripciones/SubscriptionCancellation";
import SuscriptionResumen from "@/components/Suscripciones/SuscriptionResumen";
import AppLayout from "@/layouts/AppLayout";

type Props = {
    subscription: Subscription;
}
const statusColors = {
    green: 'bg-green-50 text-green-600 border-green-200',
    yellow: 'bg-yellow-50 text-yellow-600 border-yellow-200',
    orange: 'bg-orange-50 text-orange-600 border-orange-200',
    red: 'bg-red-50 text-red-600 border-red-200',
    gray: 'bg-gray-50 text-gray-700 border-gray-200',
};
export default function manage({ subscription }: Props) {

    // console.log(subscription);


    const title = 'Adminstra tu Suscripcion'
    const isYearly = subscription.plan === 'yearly';


    return (
        < AppLayout title={title}>
            {/* <Head title={title}> */}

            {/* </Head> */}
            <main className=" min-h-screen   ">
                <h1 className="text-3xl font-bold w-full py-2 flex justify-center">
                    {title}
                </h1>
                <p className=" mb-4">
                    Administra tu suscripción cambia el plan o cancela la suscripción.
                </p>
                <SuscripsionEstats
                    isYearly={isYearly}
                    price={subscription.price}
                    status_label={subscription.status_label}
                    color={statusColors[subscription.status_label.color]}
                />

                {subscription.on_grace_period ? (
                    <div className="mt-6">
                        <SuscriptionResumen
                            ends_at={subscription.ends_at}
                        />

                    </div>
                ) : (
                    <div>
                        {!isYearly && (
                            <SuscripsionUpgrade />
                        )}

                        {isYearly && (
                            <SuscripsionDowngrade
                                next_billing_date={subscription.next_billing_date}
                                ends_at={subscription.ends_at}
                            />
                        )}

                        <SubscriptionCancellation
                            next_billing_date={subscription.next_billing_date}
                        />
                    </div>
                )}


            </main>
        </ AppLayout >
    );
}