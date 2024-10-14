<script>
    import Layout from "../Layout.svelte";
    import ContentItemList from "./ContentItemList.svelte";

    export let section;
    let form = {
        name: "",
        description: "",
        items: [],
    };

    let sectionID;

    if (section) {
        form = {
            name: section.name,
            description: section.description,
            items: section.items,
        };
        sectionID = section.id;
    }

    let selectedItem = null;

    
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
                        <h6>Edit Content Section</h6>
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
                            value={form.name}
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
                            >{form.description}</textarea
                        >
                    </div>
                </div>
                <ContentItemList bind:section={section}/>
            </div>
        </div>
    </div></Layout
>
