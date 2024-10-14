<script>
    import Swal from "sweetalert2";
    import { gridStatus } from "./util";

    export let id = null;

    export let sectionItem;
    export let showModal;
    export let title;
    export let gridMatrix = {
        1: { 1: false, 2: false, 3: false },
        2: { 1: false, 2: false, 3: false },
    };

    if (!sectionItem) {
        sectionItem = {
            id: null,
            section_id: null,
            title: null,
            description: null,
            isCarousel: false,
            animation: null,
            bgColor: null,
            textColor: null,
            images: [],
            colSpan: null,
            rowSpan: null,
            colStart: null,
            rowStart: null,
        };
        console.log(sectionItem);
    }
    const colSpanOptions = {
        1: "col-span-1",
        2: "col-span-2",
        3: "col-span-3",
    };

    const rowSpanOptions = {
        1: "row-span-1",
        2: "row-span-2",
    };

    const colStartOptions = {
        1: "col-start-1",
        2: "col-start-2",
        3: "col-start-3",
    };

    const rowStartOptions = {
        1: "row-start-1",
        2: "row-start-2",
    };

    let newImages = [];

    const animationOptions = [
        "grid-to-right",
        "grid-to-left",
        "grid-to-top",
        "grid-to-bottom",
    ];

    // const selectedGrid = {
    //     minRow: null,
    //     maxRow: null,
    //     minCol: null,
    //     maxCol: null,
    // };

    const selectGrid = (row, col) => {
        switch (gridMatrix[row][col]) {
            case gridStatus.OCCUPIED:
                Swal.fire({
                    title: "Error!",
                    text: "This grid is already occupied by another item",
                    icon: "error",
                    confirmButtonText: "Ok",
                });
                return;
            case gridStatus.RESERVED:
                gridMatrix[row][col] = gridStatus.AVAILABLE;
                break;
            case gridStatus.AVAILABLE:
                gridMatrix[row][col] = gridStatus.RESERVED;
                break;
            default:
                break;
        }
    };
</script>

<!-- svelte-ignore a11y-click-events-have-key-events -->
<!-- svelte-ignore a11y-no-static-element-interactions -->
<div
    on:click={(e) => {
        if (e.target === e.currentTarget) {
            showModal = false;
        }
    }}
    {id}
    class="absolute top-0 left-0 w-screen h-screen z-50 bg-black/50 xl:-ml-68.5"
    class:opacity-0={!showModal}
    class:hidden={!showModal}
>
    <div
        class="w-full h-full absolute max-w-3xl max-h-[80%] bg-white left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rounded-2 shadow-xl py-4 px-6 flex flex-col"
    >
        <h3 class="border-b py-4">{title}</h3>
        <div class="overflow-y-scroll flex-grow">
            <div class="relative flex-auto p-4">
                <label for="itemIsCarousel">Is Carousel</label>
                <input
                    id="itemIsCarousel"
                    type="checkbox"
                    name="isCarousel"
                    class="dark:bg-gray-950 mb-4 focus:shadow-soft-primary-outline dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                    bind:checked={sectionItem.isCarousel}
                />
                <label for="itemTitle">Title</label>
                <input
                    id="itemTitle"
                    type="text"
                    placeholder="title"
                    name="title"
                    class="dark:bg-gray-950 mb-4 focus:shadow-soft-primary-outline dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                    bind:value={sectionItem.title}
                />

                <!-- show only when item is not pure carousel -->
                {#if !sectionItem.isCarousel}
                    <label for="itemDescription">Description</label>
                    <textarea
                        name="description"
                        id="itemDescription"
                        placeholder="Description"
                        class="dark:bg-gray-950 mb-4 focus:shadow-soft-primary-outline dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                        bind:value={sectionItem.description}
                    ></textarea>

                    <label for="itemAnimation">Animation</label>
                    <select
                        id="itemAnimation"
                        name="animation"
                        class="dark:bg-gray-950 mb-4 focus:shadow-soft-primary-outline dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                        bind:value={sectionItem.animation}
                    >
                        {#each animationOptions as option}
                            <option value={option}>{option}</option>
                        {/each}
                    </select>

                    <div class="grid grid-cols-2 gap-x-8">
                        <div class="flex flex-col gap-y-2">
                            <label for="itemBgColor">Background Color</label>
                            <input
                                id="itemBgColor"
                                type="color"
                                name="bgColor"
                                placeholder="Background Color"
                                class="dark:bg-gray-950 mb-4 focus:shadow-soft-primary-outline dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                                bind:value={sectionItem.bgColor}
                            />
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <label for="itemTextColor">Text Color</label>
                            <input
                                id="itemTextColor"
                                type="color"
                                name="textColor"
                                placeholder="Text Color"
                                class="dark:bg-gray-950 mb-4 focus:shadow-soft-primary-outline dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                                bind:value={sectionItem.textColor}
                            />
                        </div>
                    </div>
                {/if}

                <div class="p-4 bg-slate-100 rounded-2 shadow-lg my-8">
                    <h5>Images</h5>
                    <div class="grid grid-cols-4 mb-4 gap-4">
                        {#if !sectionItem.images || sectionItem.images.length === 0}
                            <div class="col-span-4 text-center text-gray-500">
                                No images uploaded
                            </div>
                        {:else}
                            {#each sectionItem.images as image}
                                <div class="relative">
                                    <img
                                        src={image}
                                        alt="image"
                                        class="w-full h-24 object-cover rounded-lg"
                                    />
                                    <button
                                        type="button"
                                        class="absolute top-0 right-0 px-1 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-full cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-red-500 shadow-soft-md bg-150 bg-x-25 hover:scale-125 active:opacity-85"
                                        on:click={() =>
                                            (sectionItem.images =
                                                sectionItem.images.filter(
                                                    (img) => img !== image,
                                                ))}
                                    >
                                        <!-- using box icon -->
                                        <i class="bx bx-x text-lg font-bold"
                                        ></i>
                                    </button>
                                </div>
                            {/each}
                        {/if}
                    </div>

                    <h5>Add Image</h5>
                    <input
                        type="file"
                        accept="image/*"
                        multiple
                        class="dark:bg-gray-950 mb-4 focus:shadow-soft-primary-outline dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                        on:change={(e) => {
                            const files = e.target.files;
                            for (let i = 0; i < files.length; i++) {
                                const file = files[i];
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    newImages.push(e.target.result);
                                    sectionItem.images = [
                                        ...sectionItem.images,
                                        ...newImages,
                                    ];
                                };
                                reader.readAsDataURL(file);
                            }
                        }}
                    />
                </div>

                <div class="bg-slate-100 p-4 shadow-lg rounded-2">
                    <h4>Item Position</h4>
                    <div class="pl-4 mb-8">
                        <p class="mb-0">Notes:</p>
                        <ul class="text-sm pl-4">
                            <li>Red = not available / occupied</li>
                            <li>Grey = available / not occupied</li>
                            <li>Green = selected</li>
                            <li>Click on the grid to select the position</li>
                            <li>Click on the selected grid to deselect</li>
                        </ul>
                    </div>
                    <div class="grid grid-cols-3 grid-rows-2 gap-1">
                        {#each [1, 2] as row}
                            {#each [1, 2, 3] as col}
                                <button
                                    class="{
                                    gridMatrix[row][col] === gridStatus.OCCUPIED
                                        ? 'bg-red-300'
                                        : gridMatrix[row][col] === gridStatus.RESERVED
                                            ? 'bg-green-300'
                                            : 'bg-gray-300'
                                    } w-full h-full aspect-video flex items-center justify-center"
                                    on:click={() => selectGrid(row, col)}
                                >
                                    {row} - {col}
                                </button>
                            {/each}
                        {/each}
                    </div>
                </div>
            </div>
            <div
                class="flex justify-end py-2 my-2 border-t items-center font-bold gap-x-2"
            >
                <button
                    class="px-12 py-2 bg-red-400 text-white rounded-lg hover:bg-red-500 hover:shadow-soft-lg transition-all duration-200 ease-in-out"
                    on:click={() => {
                        showModal = false;
                    }}
                >
                    Close
                </button>
                <button
                    class="px-12 py-2 bg-green-400 text-white rounded-lg hover:bg-green-500 hover:shadow-soft-lg transition-all duration-200 ease-in-out ml-2"
                    on:click={saveItem()}
                >
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
