<script>
    import { inertia, router } from "@inertiajs/svelte";
    import Swal from "sweetalert2";
    import Layout from "../Layout.svelte";
    let form = {
        name: "",
        description: "",
    };

    const submitForm = () => {
        // validation
        if (!form.name || !form.description) {
            Swal.fire({
                title: "Error!",
                text: "Please fill all the fields",
                icon: "error",
                confirmButtonText: "Ok",
            });
            return;
        }

        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, save it!",
        }).then((result) => {
            if (result.isConfirmed) {
                router.post("/dashboard/sections", form);
            }
        });

    };
</script>

<Layout>
    <div class="w-full max-w-full px-3 mt-0 mb-6">
        <div
            class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border"
        >
            <div
                class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0"
            >
                <div class="flex flex-wrap mt-0 -mx-3">
                    <div
                        class="flex-none w-full px-3 mt-0 lg:w-1/2 lg:flex-none"
                    >
                        <h6>Create Content Section</h6>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/2">
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-600"
                            >Name</label
                        >
                        <input
                            id="name"
                            type="text"
                            placeholder="Name"
                            name="name"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                            bind:value={form.name}
                        />
                    </div>

                    <div class="w-full px-3 mb-6 md:w-1/2">
                        <label
                            for="description"
                            class="block mb-2 text-sm font-medium text-gray-600"
                            >Description</label
                        >
                        <textarea
                            id="description"
                            placeholder="Description"
                            name="description"
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" 
                            bind:value={form.description}></textarea
                        >
                    </div>
                </div>
            </div>

            <div class="flex justify-end items-center p-4 gap-x-4">
                <button on:click={submitForm}
                    class="bg-fuchsia-500 text-white active:bg-fuchsia-600 font-normal text-sm px-6 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 hover:bg-fuchsia-600"
                >
                    Save
                </button>
                <a href="/dashboard/sections" use:inertia
                    class="bg-gray-300 text-black active:bg-gray-200 font-normal text-sm px-6 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 hover:bg-gray-200"
                >
                    Cancel
                </a>
            </div>
        </div>
    </div></Layout
>
