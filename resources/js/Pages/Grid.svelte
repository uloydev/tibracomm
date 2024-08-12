<script>
    import { onMount } from "svelte";

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

    /**
     * @type {GridItem[]}
     */
    export let gridItems = [];

    const colSpanMap = {
        1: "col-span-1",
        2: "col-span-2",
        3: "col-span-3",
    };

    const rowSpanMap = {
        1: "row-span-1",
        2: "row-span-2",
    };

    const colStartMap = {
        1: "col-start-1",
        2: "col-start-2",
        3: "col-start-3",
    };

    const rowStartMap = {
        1: "row-start-1",
        2: "row-start-2",
        3: "row-start-3",
    };

    const SLIDER_INTERVAL = 2000;

    const slideXMouseEnter = (e) => {
        const elem = e.target;
        const slider = elem.parentElement.querySelector(".slider");
        slider.classList.replace("w-0", "w-full");
    };

    const slideXMouseLeave = (e) => {
        const elem = e.target;
        const slider = elem.parentElement.querySelector(".slider");
        slider.classList.replace("w-full", "w-0");
    };

    const slideYMouseEnter = (e) => {
        const elem = e.target;
        const slider = elem.parentElement.querySelector(".slider");
        slider.classList.replace("h-0", "h-full");
    };

    const slideYMouseLeave = (e) => {
        const elem = e.target;
        const slider = elem.parentElement.querySelector(".slider");
        slider.classList.replace("h-full", "h-0");
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

    const getGridItemClasses = (item) => {
        return [
            colSpanMap[item.colSpan],
            rowSpanMap[item.rowSpan],
            colStartMap[item.colStart],
            rowStartMap[item.rowStart],
        ].join(" ");
    };

    onMount(() => {
        const sliders = document.querySelectorAll(".slider");
        sliders.forEach((slider) => {
            let currentSlide = 0;
            const slides = slider.querySelectorAll("img");
            const slideCount = slides.length;
            slides[currentSlide].classList.remove("opacity-0");

            setInterval(() => {
                slides[currentSlide].classList.add("opacity-0");
                currentSlide = (currentSlide + 1) % slideCount;
                slides[currentSlide].classList.remove("opacity-0");
            }, SLIDER_INTERVAL);
        });
    });
</script>

<div class="h-screen w-screen bg-slate-800">
    <div class="grid grid-cols-3 grid-rows-2 h-full w-full cursor-default">
        {#each gridItems as item}
            <div
                class="relative {getGridItemClasses(item)}"
                style="color: {item.textColor}; background-color: {item.bgColor};"
            >
                {#if item.isCarousel}
                    <div class="slider relative bg-white w-full h-full">
                        {#each item.images as image, i}
                            <img
                                src={image}
                                alt="slider image {i}"
                                class="absolute top-0 left-0 h-full w-full object-cover opacity-0"
                                style="transition: all .5s linear"
                            />
                        {/each}
                    </div>
                {:else}
                    <!-- svelte-ignore a11y-no-static-element-interactions -->
                    <div
                        class="{item.animation} group p-20 h-full flex items-center"
                        on:mouseenter={getMouseEnterHandler(item.animation)}
                        on:mouseleave={getMouseLeaveHandler(item.animation)}
                    >
                        <div class="w-full h-full relative">
                            <div
                                class="text-3xl font-bold absolute top-1/2 -translate-y-1/2 overflow-hidden max-h-[40px] group-hover:max-h-full"
                                style="transition: all 1s linear; transition-delay:1s"
                            >
                                {item.title}
                                <p
                                    class="opacity-0 font-normal text-base group-hover:opacity-100"
                                    style="transition: all 1s linear; transition-delay:1s"
                                >
                                    {item.description}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="slider absolute bg-white z-10 {getAnimationClass(
                            item.animation,
                        )}"
                        style="transition: all .5s linear"
                    >
                        {#each item.images as image, i}
                            <img
                                src={image}
                                alt="slider image {i}"
                                class="absolute top-0 left-0 h-full w-full object-cover opacity-0"
                                style="transition: all .5s linear"
                            />
                        {/each}
                    </div>
                {/if}
            </div>
        {/each}
    </div>
</div>
