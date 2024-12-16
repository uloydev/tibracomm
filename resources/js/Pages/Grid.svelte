<script>
    import GridCarousel from "../Component/GridCarousel.svelte";
    import GridItem from "../Component/GridItem.svelte";
    import HomeLayout from "../Layout/HomeLayout.svelte";

    /**
     * @typedef {Object} GridItem
     * @property {number} id
     * @property {number} section_id
     * @property {string} title
     * @property {string} [animation]
     * @property {string} bgColor
     * @property {string} textColor
     * @property {number} colSpan
     * @property {number} rowSpan
     * @property {number} colStart
     * @property {number} rowStart
     * @property {boolean} isCarousel
     * @property {string[]} [images]
     * @property {string} [description]
     */

    /**
     * @type {GridItem[]}
     */
    export let finishedLoading = false;
    export let gridItems = [];
    export let slug = "";
    $: {
        console.log(gridItems);
    }

    const colSpanMap = {
        1: "sm:col-span-1",
        2: "sm:col-span-2",
        3: "sm:col-span-3",
    };

    const rowSpanMap = {
        1: "sm:row-span-1",
        2: "sm:row-span-2",
    };

    const colStartMap = {
        1: "sm:col-start-1",
        2: "sm:col-start-2",
        3: "sm:col-start-3",
    };

    const rowStartMap = {
        1: "sm:row-start-1",
        2: "sm:row-start-2",
        3: "sm:row-start-3",
    };

    const getGridItemClasses = (item) => {
        return [
            colSpanMap[item.colSpan],
            rowSpanMap[item.rowSpan],
            colStartMap[item.colStart],
            rowStartMap[item.rowStart],
        ].join(" ");
    };
</script>

<HomeLayout overrideClasses="h-screen w-full relative overflow-x-hidden" fixedNavbar=true>
    <div key={slug} class="grid sm:grid-cols-3 sm:grid-rows-2 h-full w-full cursor-default font-inter">
        {#each gridItems as item}
            <div
                class="relative {getGridItemClasses(item)}"
                style="color: {item.textColor}; background-color: {item.bgColor};"
            >
                {#if item.isCarousel}
                    <GridCarousel {item}  key={slug+item.id}/>
                {:else}
                    <GridItem {item} key={slug+item.id}/>
                {/if}
            </div>
        {/each}
    </div>
</HomeLayout>
