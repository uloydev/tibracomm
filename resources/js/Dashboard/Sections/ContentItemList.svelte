<script>
    import { router } from "@inertiajs/svelte";
    import Swal from "sweetalert2";
    import Form from "./Form.svelte";
    import { gridStatus } from "./util";

    export let section;
    let selectedItem = {
        id: null,
        section_id: section.id,
        title: "",
        animation: "",
        mobileAnimation: "",
        bgColor: null,
        textColor: null,
        colSpan: null,
        rowSpan: null,
        colStart: null,
        rowStart: null,
        isCarousel: false,
        images: [],
        description: null,
    };

    if (!section) {
        console.log("section is null");
        section = {
            name: "",
            description: "",
            items: [],
        };
    }
    console.log(section);

    let showModal = false;
    let formTitle = "Add Section Item";
    let gridMatrix;
    let isEdit = false;

    const onEditBtnClick = (item) => {
        calculateGridMatrix(item);
        selectedItem = item;
        showModal = true;
        formTitle = "Edit Section Item";
        isEdit = true;

        // // calculate grid martix
        // item.items;
    };

    const hasAvailableSpace = () => {
        let available = false;
        for (let i = 1; i <= 2; i++) {
            for (let j = 1; j <= 3; j++) {
                if (gridMatrix[i][j] === gridStatus.AVAILABLE) {
                    available = true;
                    break;
                }
            }
        }
        return available;
    };

    const onAddBtnClick = () => {
        isEdit = false;
        calculateGridMatrix();
        if (!hasAvailableSpace()) {
            Swal.fire({
                icon: "error",
                title: "No available space",
                text: "Please remove an item to add a new one, or edit an existing item",
                confirmButtonColor: "#f87171",
            });
            return;
        }
        selectedItem = {
            id: null,
            section_id: section.id,
            title: "",
            animation: "",
            mobileAnimation: "",
            bgColor: "#ffffff",
            textColor: "#000000",
            colSpan: null,
            rowSpan: null,
            colStart: null,
            rowStart: null,
            isCarousel: false,
            images: [],
            description: null,
        };
        showModal = true;
        formTitle = "Add Section Item";
    };

    const onDeleteBtnClick = (item) => {
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
                router.delete(
                    `/dashboard/sections/${item.section_id}/items/${item.id}`,
                );
            }
        });
    };

    const resetGridMatrix = () => {
        gridMatrix = {
            1: {
                1: gridStatus.AVAILABLE,
                2: gridStatus.AVAILABLE,
                3: gridStatus.AVAILABLE,
            },
            2: {
                1: gridStatus.AVAILABLE,
                2: gridStatus.AVAILABLE,
                3: gridStatus.AVAILABLE,
            },
        };
    };

    const calculateGridMatrix = (selectedItem) => {
        resetGridMatrix();
        section.items.forEach((item) => {
            for (let i = item.rowStart; i < item.rowStart + item.rowSpan; i++) {
                for (
                    let j = item.colStart;
                    j < item.colStart + item.colSpan;
                    j++
                ) {
                    gridMatrix[i][j] = gridStatus.OCCUPIED;
                }
            }
        });
        if (selectedItem) {
            for (
                let i = selectedItem.rowStart;
                i < selectedItem.rowStart + selectedItem.rowSpan;
                i++
            ) {
                for (
                    let j = selectedItem.colStart;
                    j < selectedItem.colStart + selectedItem.colSpan;
                    j++
                ) {
                    gridMatrix[i][j] = gridStatus.RESERVED;
                }
            }
        }

        console.log(gridMatrix);
    };
</script>

<Form
    id="createModal"
    bind:gridMatrix
    bind:sectionItem={selectedItem}
    bind:showModal
    bind:sectionID={section.id}
    bind:isEdit
    title={formTitle}
/>
<div class="flex flex-col gap-y-4 p-6 bg-slate-100 shadow-xl rounded-4">
    <div class="flex gap-y-2 justify-between">
        <h6 class="text-xl font-semibold">Content Items</h6>
        <button
            on:click={onAddBtnClick}
            type="button"
            class="bg-gradient-to-tl from-gray-900 to-slate-800 text-white px-2 py-1 rounded-2 hover:shadow-lg"
        >
            <i class="bx bx-plus"></i> Add Item</button
        >
    </div>
    <div class="flex-auto px-6">
        <div class="overflow-x-auto">
            <table
                class="items-center w-full mb-0 align-top border-gray-200 text-slate-500"
            >
                <thead class="align-bottom">
                    <tr class="text-slate-900 text-sm">
                        <th
                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200"
                        >
                            Action</th
                        >
                        <th
                            class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200"
                        >
                            Title</th
                        >
                        <th
                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200"
                        >
                            Is Slider Only</th
                        >
                        <th
                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200"
                        >
                            Image Count</th
                        >
                        <th
                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200"
                        >
                            Column Span</th
                        >
                        <th
                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200"
                        >
                            Row Span</th
                        >
                        <th
                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200"
                        >
                            Column Start</th
                        >
                        <th
                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200"
                        >
                            Row Start</th
                        >
                        <th
                            class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200"
                        >
                            Desktop Animation</th
                        >
                        <th
                            class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200"
                        >
                            Mobile Animation</th
                        >
                        <th
                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200"
                        >
                            Background Color</th
                        >
                        <th
                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200"
                        >
                            Text Color</th
                        >
                        <th
                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid whitespace-nowrap border-b-gray-200"
                        >
                            Description</th
                        >
                    </tr>
                </thead>
                <tbody>
                    {#each section.items as item}
                        <tr class="text-sm text-slate-600 hover:bg-slate-50">
                            <td
                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap"
                            >
                                <div
                                    class="flex justify-center text-lg gap-x-1"
                                >
                                    <div>
                                        <button
                                            on:click={() =>
                                                onEditBtnClick(item)}
                                            class="hover:bg-gradient-to-tl hover:from-gray-900 hover:to-slate-800 hover:text-white px-2 py-1 rounded-2 hover:shadow-lg"
                                            data-placement="top"
                                            data-target="tooltip_trigger"
                                        >
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <div
                                            class="z-50 hidden px-2 py-1 text-center text-white bg-dark-gradient rounded-lg max-w-46 text-sm"
                                            id="tooltip"
                                            role="tooltip"
                                            data-target="tooltip"
                                        >
                                            edit
                                            <div
                                                id="arrow"
                                                class="invisible absolute h-2 w-2 bg-slate-800 before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-slate-800 before:content-['']"
                                                data-popper-arrow
                                            ></div>
                                        </div>
                                    </div>
                                    <div>
                                        <button
                                            class="hover:bg-gradient-to-tl hover:from-gray-900 hover:to-slate-800 hover:text-white px-2 py-1 rounded-2 hover:shadow-lg"
                                            data-placement="top"
                                            data-target="tooltip_trigger"
                                            on:click={() =>
                                                onDeleteBtnClick(item)}
                                        >
                                            <i class="bx bx-trash"></i>
                                        </button>
                                        <div
                                            class="z-50 hidden px-2 py-1 text-center text-white bg-dark-gradient rounded-lg max-w-46 text-sm"
                                            id="tooltip"
                                            role="tooltip"
                                            data-target="tooltip"
                                        >
                                            delete
                                            <div
                                                id="arrow"
                                                class="invisible absolute h-2 w-2 bg-slate-800 before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-slate-800 before:content-['']"
                                                data-popper-arrow
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap text-slate-800"
                            >
                                <h6 class="mb-0 leading-normal px-4">
                                    {item.title}
                                </h6>
                            </td>
                            <td
                                class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap"
                            >
                                <p
                                    class="mb-0 leading-normal text-sm font-bold"
                                >
                                    {item.isCarousel ? "Yes" : "No"}
                                </p>
                            </td>
                            <td
                                class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap"
                            >
                                <p
                                    class="mb-0 leading-normal text-sm font-bold"
                                >
                                    {item.images.length}
                                </p>
                            </td>
                            <td
                                class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap"
                            >
                                <p
                                    class="mb-0 leading-normal text-sm font-bold"
                                >
                                    {item.colSpan}
                                </p>
                            </td>
                            <td
                                class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap"
                            >
                                <p
                                    class="mb-0 leading-normal text-sm font-bold"
                                >
                                    {item.rowSpan}
                                </p>
                            </td>
                            <td
                                class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap"
                            >
                                <p
                                    class="mb-0 leading-normal text-sm font-bold"
                                >
                                    {item.colStart}
                                </p>
                            </td>
                            <td
                                class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap"
                            >
                                <p
                                    class="mb-0 leading-normal text-sm font-bold"
                                >
                                    {item.rowStart}
                                </p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap"
                            >
                                <p
                                    class="mb-0 leading-normal text-sm text-ellipsis"
                                >
                                    {item.animation}
                                </p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap"
                            >
                                <p
                                    class="mb-0 leading-normal text-sm text-ellipsis"
                                >
                                    {item.mobileAnimation}
                                </p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap"
                            >
                                <p
                                    class="mb-0 leading-normal text-sm text-ellipsis text-center border-b-4"
                                    style="border-color: {item.bgColor};"
                                >
                                    {item.bgColor}
                                </p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap"
                            >
                                <p
                                    class="mb-0 leading-normal text-sm text-ellipsis text-center border-b-4"
                                    style="border-color: {item.textColor};"
                                >
                                    {item.textColor}
                                </p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap"
                            >
                                <p
                                    class="mb-0 leading-normal text-sm text-ellipsis"
                                >
                                    {item.description}
                                </p>
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        </div>
    </div>
</div>
