export default function InputError({
    children,
}: {
    children: React.ReactNode;
}) {
    return (
        <div className="mt-2 text-red-500 text-sm">
            {children}
        </div>
    );
}