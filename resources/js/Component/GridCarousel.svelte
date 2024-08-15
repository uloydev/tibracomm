<script>
    import { onDestroy, onMount } from "svelte";
    import { GRID_SLIDER_INTERVAL } from "../constants";
    import GridCarouselImage from "./GridCarouselImage.svelte";

    /**
     * @typedef {Object} GridItem
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

    /** @type {GridItem} */
    export let item;
    export let key;
    let currentSlide = 0;
    let interval;

    onMount(() => {
        interval = setInterval(() => {
            currentSlide = (currentSlide + 1) % item.images.length;
        }, GRID_SLIDER_INTERVAL);
    });

    onDestroy(() => {
        clearInterval(interval);
    });
</script>

<div {key} class="slider relative bg-white w-full h-full">
    {#each item.images as image, i}
        <GridCarouselImage {image} {i} activeIndex={currentSlide} key={key+i}/>
    {/each}
</div>
