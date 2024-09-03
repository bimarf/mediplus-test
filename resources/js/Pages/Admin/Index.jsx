import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import PrimaryButton from "@/Components/PrimaryButton";
import FlashMessage from "@/Components/FlashMessage";
import { Link, Head, useForm } from "@inertiajs/react";

export default function Index({ auth, flashMessage, clinic }) {
    const { delete: destroy, put } = useForm();
    return (
        <AuthenticatedLayout auth={auth}>
            <Head title="Admin Dashboard" />
            <Link href={route("admin.dashboard.clinic.create")}>
                <PrimaryButton type="button" className="w-40 mb-8">
                    Insert New Clinic
                </PrimaryButton>
            </Link>
            {flashMessage?.message && (
                <FlashMessage message={flashMessage.message} />
            )}
            <div className="flex flex-col">
                <div className="-m-1.5 overflow-x-auto">
                    <div className="p-1.5 min-w-full inline-block align-middle">
                        <div className="overflow-hidden">
                            <table className="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead>
                                    <tr>
                                        <th
                                            scope="col"
                                            className="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500"
                                        >
                                            No.
                                        </th>
                                        <th
                                            scope="col"
                                            className="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500"
                                        >
                                            Name
                                        </th>
                                        <th
                                            scope="col"
                                            className="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500"
                                        >
                                            Category
                                        </th>
                                        <th
                                            scope="col"
                                            className="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500"
                                        >
                                            Image
                                        </th>
                                        <th colSpan={2}>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {clinic.map((clinic, index) => (
                                        <tr key={clinic.id}>
                                            <td>{index + 1}</td>
                                            <td>{clinic.name}</td>
                                            <td>{clinic.category}</td>
                                            <td>
                                                <img
                                                    src={`/storage/${clinic.image}`}
                                                    width={100}
                                                    height={100}
                                                />
                                            </td>
                                            <td>
                                                <div
                                                    onClick={() => {
                                                        destroy(
                                                            route(
                                                                "admin.dashboard.clinic.destroy",
                                                                clinic.id
                                                            )
                                                        );
                                                    }}
                                                >
                                                    <PrimaryButton
                                                        type="button"
                                                        variant="danger"
                                                    >
                                                        {clinic.deleted_at
                                                            ? "Restore"
                                                            : "Delete"}
                                                    </PrimaryButton>
                                                </div>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
