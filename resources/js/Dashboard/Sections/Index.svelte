<script>
    import { inertia, router } from "@inertiajs/svelte";
    import Swal from "sweetalert2";
    import Layout from "../Layout.svelte";

    export let sections = [];

    const deleteConfirmation = (section) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(section.delete_url, {
                    onSuccess: () => deleteSuccess(),
                });
            }
        });
    };

    const deleteSuccess = () => {
        Swal.fire({
            title: "Success!",
            text: "Section deleted successfully.",
            icon: "success",
            confirmButtonText: "Ok",
            confirmButtonColor: "#3085d6",
        });
    };
</script>


<Layout>

    
    <div class="w-full max-w-full px-3 mt-0 mb-6">
        <div
            class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                <div class="flex flex-wrap mt-0 -mx-3">
                    <div class="flex-none w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                        <h6>Content Sections</h6>
                    </div>
                    <div class="flex-none w-full px-3 my-auto text-right lg:w-1/2 lg:flex-none">
                        <div class="relative pr-6 lg:float-right">
                            <a dropdown-trigger data-placement="top" data-target="tooltip_trigger" class="cursor-pointer text-xl hover:text-2xl hover:text-slate-900 transition-all text-center"
                                aria-expanded="false">
                                <i class='bx bx-dots-horizontal-rounded'></i>
                            </a>
                            <div class="z-50 hidden px-2 py-1 text-center text-white bg-dark-gradient rounded-lg max-w-46 text-sm"
                                id="tooltip" role="tooltip" data-target="tooltip">
                                options
                                <div id="arrow"
                                    class="invisible absolute h-2 w-2 bg-slate-800 before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-slate-800 before:content-['']"
                                    data-popper-arrow></div>
                            </div>
                            <p class="hidden transform-dropdown-show"></p>
                            <ul dropdown-menu
                                class="z-100 text-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 m-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                                <li
                                    class="relative group rounded-lg hover:bg-gradient-to-tl hover:from-gray-900 hover:to-slate-800">
                                    <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition lg:duration-300 group-hover:text-white group-hover:font-bold"
                                        href="/dashboard/sections/create" use:inertia>Create</a>
                                </li>
                                <li
                                    class="relative group rounded-lg hover:bg-gradient-to-tl hover:from-gray-900 hover:to-slate-800">
                                    <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition lg:duration-300 group-hover:text-white group-hover:font-bold"
                                        href="javascript:;">Export</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-auto p-6 px-0">
                <div class="overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr class="text-slate-900 text-sm">
                                <th
                                    class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200">
                                    Name</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200">
                                    Description</th>
                                <th
                                    class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200">
                                    Section Items</th>
                                <th
                                    class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {#each sections as section}
                                <tr class="text-sm text-slate-600 hover:bg-slate-50">
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap text-slate-800">
                                        <h6 class="mb-0 leading-normal px-4">{section.name}</h6>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                        <p class="mb-0 leading-normal text-sm text-ellipsis">{section.description }</p>
                                    </td>
                                    <td
                                        class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap">
                                        <p class="mb-0 leading-normal text-sm font-bold">{ section.items_count }</p>

                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                        <div class="flex justify-center text-lg gap-x-4">
                                            <div>
                                                <a href="{section.view_url}"
                                                    class="hover:bg-gradient-to-tl hover:from-gray-900 hover:to-slate-800 hover:text-white px-2 py-1 rounded-2 hover:shadow-lg" data-placement="top"
                                                    data-target="tooltip_trigger">
                                                    <i class='bx bxs-show'></i>
                                                </a>
                                                <div class="z-50 hidden px-2 py-1 text-center text-white bg-dark-gradient rounded-lg max-w-46 text-sm"
                                                    id="tooltip" role="tooltip" data-target="tooltip">
                                                    view
                                                    <div id="arrow"
                                                        class="invisible absolute h-2 w-2 bg-slate-800 before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-slate-800 before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="{section.edit_url}" use:inertia
                                                    class="hover:bg-gradient-to-tl hover:from-gray-900 hover:to-slate-800 hover:text-white px-2 py-1 rounded-2 hover:shadow-lg" data-placement="top"
                                                    data-target="tooltip_trigger">
                                                    <i class='bx bx-edit'></i>
                                                </a>
                                                <div class="z-50 hidden px-2 py-1 text-center text-white bg-dark-gradient rounded-lg max-w-46 text-sm"
                                                    id="tooltip" role="tooltip" data-target="tooltip">
                                                    edit
                                                    <div id="arrow"
                                                        class="invisible absolute h-2 w-2 bg-slate-800 before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-slate-800 before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                            </div>
                                            <div>
                                                <button on:click={() => deleteConfirmation(section)}
                                                    class="hover:bg-gradient-to-tl hover:from-gray-900 hover:to-slate-800 hover:text-white px-2 py-1 rounded-2 hover:shadow-lg" data-placement="top"
                                                    data-target="tooltip_trigger">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                                <div class="z-50 hidden px-2 py-1 text-center text-white bg-dark-gradient rounded-lg max-w-46 text-sm"
                                                    id="tooltip" role="tooltip" data-target="tooltip">
                                                    delete
                                                    <div id="arrow"
                                                        class="invisible absolute h-2 w-2 bg-slate-800 before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-slate-800 before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            {/each}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</Layout>