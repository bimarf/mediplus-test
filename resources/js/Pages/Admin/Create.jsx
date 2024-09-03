import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import ValidationErrors from "@/Components/ValidationErrors";
import InputLabel from "@/Components/InputLabel";
import TextInputForm from "@/Components/TextInputForm";
import PrimaryButton from "@/Components/PrimaryButton";
import { Head, useForm } from "@inertiajs/react";
import { Input } from "postcss";

export default function Create({ auth }) {
    const { setData, post, processing, errors } = useForm({
        name: "",
        category: "",
        address: "",
        image: "",
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

        post(route("admin.dashboard.clinic.store"));
    };
    return (
        <AuthenticatedLayout auth={auth}>
            <Head title="Create Clinic" />
            <h1 className="text-xl">Create New Clinic</h1>
            <hr className="mb-4" />
            <ValidationErrors errors={errors} />
            <form onSubmit={submit}>
                <InputLabel forInput="name" value="Name" />
                <TextInputForm
                    name="name"
                    type="text"
                    variant="primary-outline"
                    className="w-full"
                    handleChange={handleOnChange}
                    placeholder="Enter the name of the building"
                    isErrors={errors.name}
                />
                <InputLabel
                    forInput="category"
                    value="Category"
                    className="mt-4"
                />
                <select
                    name="category"
                    className="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                    onChange={(e) => setData("category", e.target.value)}
                >
                    <option value="">---</option>
                    <option value="Rumah Sakit">Rumah Sakit</option>
                    <option value="Clinic">Clinic</option>
                    <option value="Praktek">Praktek</option>
                </select>
                <InputLabel
                    forInput="address"
                    value="Address"
                    className="mt-4"
                />
                <TextInputForm
                    name="address"
                    type="text"
                    variant="primary-outline"
                    className="w-full"
                    handleChange={handleOnChange}
                    placeholder="Enter the Address of the building"
                    isErrors={errors.video_url}
                />
                <InputLabel forInput="image" value="Image" className="mt-4" />
                <TextInputForm
                    name="image"
                    type="file"
                    variant="primary-outline"
                    handleChange={handleOnChange}
                    placeholder="Insert the thumbnail of the movie"
                    isErrors={errors.thumbnail}
                />

                <PrimaryButton
                    type="submit"
                    className="mt-4"
                    processing={processing}
                >
                    Save
                </PrimaryButton>
            </form>
        </AuthenticatedLayout>
    );
}
