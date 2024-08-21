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
    let carousel;
    let currentSlide = 0;


    const slideXMouseEnter = (e) => {
        carousel.classList.replace("w-0", "w-full");
    };

    const slideXMouseLeave = (e) => {
        carousel.classList.replace("w-full", "w-0");
    };

    const slideYMouseEnter = (e) => {
        carousel.classList.replace("h-0", "h-full");
    };

    const slideYMouseLeave = (e) => {
        carousel.classList.replace("h-full", "h-0");
    };

    const getMouseEnterHandler = (animation) => {
        switch (animation) {
            case "grid-to-right":
                return slideXMouseEnter;
            case "grid-to-left":
                return slideXMouseEnter;
            case "grid-to-top":
                return slideYMouseEnter;
            case "grid-to-bottom":
                return slideYMouseEnter;
            default:
                return () => {};
        }
    };

    const getMouseLeaveHandler = (animation) => {
        switch (animation) {
            case "grid-to-right":
                return slideXMouseLeave;
            case "grid-to-left":
                return slideXMouseLeave;
            case "grid-to-top":
                return slideYMouseLeave;
            case "grid-to-bottom":
                return slideYMouseLeave;
            default:
                return () => {};
        }
    };

    const getAnimationClass = (animation) => {
        switch (animation) {
            case "grid-to-right":
                return "top-0 left-full w-0 h-full";
            case "grid-to-left":
                return "top-0 right-full w-0 h-full";
            case "grid-to-top":
                return "bottom-full left-0 w-full h-0";
            case "grid-to-bottom":
                return "top-full left-0 w-full h-0";
            default:
                return "";
        }
    };

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

<!-- svelte-ignore a11y-no-static-element-interactions -->
<div {key}
    class="{item.animation} group p-20 h-full flex items-center"
    on:mouseenter={getMouseEnterHandler(item.animation)}
    on:mouseleave={getMouseLeaveHandler(item.animation)}
>
    <div class="w-full h-full relative">
        <div
            class="text-3xl font-bold absolute top-1/2 -translate-y-1/2 overflow-hidden max-h-[40px] group-hover:max-h-full"
            style="transition: all .3s linear;"
        >
            {item.title}
            <p
                class="opacity-0 font-normal text-base group-hover:opacity-100"
                style="transition: all .3s linear;"
            >
                {item.description}
            </p>
        </div>
    </div>
</div>
<div {key} bind:this={carousel}
    class="slider absolute bg-white z-10 {getAnimationClass(item.animation)}"
    style="transition: all .3s linear"
>
    {#each item.images as image, i}
        <GridCarouselImage {image} {i} activeIndex={currentSlide} key={key+i}/>
    {/each}
</div>
