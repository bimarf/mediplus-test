import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import ValidationErrors from "@/Components/ValidationErrors";
import InputLabel from "@/Components/InputLabel";
import TextInputForm from "@/Components/TextInputForm";
import FlashMessage from "@/Components/FlashMessage";
import PrimaryButton from "@/Components/PrimaryButton";
import { Head, useForm } from "@inertiajs/react";
import { Input } from "postcss";

export default function Booking({ auth, clinic, schedule, flash }) {
    const { setData, post, processing, errors } = useForm({
        clinic_id: clinic.id,
        schedule_id: "",
    });

    const handleOnChange = (event) => {
        setData(
            event.target.name,
            event.target.type === "file"
                ? event.target.files[0]
                : event.target.value
        );
    };
    const submit = (e) => {
        e.preventDefault();

        post(route("user.dashboard.store"));
    };
    return (
        <AuthenticatedLayout auth={auth}>
            <Head title="Booking" />
            {flash?.message && <FlashMessage message={flash.message} />}
            <h1 className="text-xl">Booking an Appointment</h1>
            <hr className="mb-4" />
            <ValidationErrors errors={errors} />
            <form onSubmit={submit}>
                <InputLabel forInput="clinic_id" value="Name:" />
                <h1 className="text-xl">{clinic.name}</h1>
                <InputLabel forInput="schedule_id" value="Schedule:" />
                <select
                    name="schedule_id"
                    className="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                    onChange={(e) => setData("schedule_id", e.target.value)}
                >
                    <option value="">---</option>
                    {schedule.map((schedule) => (
                        <option key={schedule.id} value={schedule.id}>
                            {schedule.date}
                        </option>
                    ))}
                </select>
                <PrimaryButton
                    type="submit"
                    className="mt-4"
                    processing={processing}
                >
                    Book
                </PrimaryButton>
            </form>
        </AuthenticatedLayout>
    );
}
