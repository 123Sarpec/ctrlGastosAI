import '@inertiajs/core';

declare module '@inertiajs/core' {
    export interface InertiaConfig {
        sharedPageProps: {
            flash: {
                success?: string,
            },
            user: {
                user: {
                    id: number;
                    name: string;
                    email: string;
                },
            };
            suscribed: boolean;
            plan: string | null;
        }
    }
}