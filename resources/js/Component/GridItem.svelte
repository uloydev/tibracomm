<script>
    import { onDestroy, onMount } from "svelte";
    import { GRID_SLIDER_INTERVAL } from "../constants";
    import GridCarouselImage from "./GridCarouselImage.svelte";

    /**
     * @typedef {Object} GridItem
     * @property {number} section_id
     * @property {string} title
     * @property {string} [animation]
     * @property {string} [mobileAnimation]
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
    let mobileItemClicked = false;

    let isScreenSmall = window.innerWidth < 640;

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

    const toggleMobileSlideY = (e) => {
        // check if it has h-full class
        mobileItemClicked = !mobileItemClicked;
        if (!mobileItemClicked) {
            console.log("unclicked");
            carousel.classList.replace("h-full", "h-0");
        } else {
            console.log("clicked");
            carousel.classList.replace("h-0", "h-full");
        }
    };

    const getMouseEnterHandler = (animation) => {
        if (isScreenSmall) {
            return () => {};
        }
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
        if (isScreenSmall) {
            return () => {};
        }
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

    const getMobileAnimationClass = (animation) => {
        switch (animation) {
            case "mobile-grid-to-top":
                return "bottom-full left-0 w-full h-0";
            case "mobile-grid-to-bottom":
                return "top-full left-0 w-full h-0";
            default:
                return "";
        }
    };

    const toggleMobileAnimation = (animation) => {
        if (!isScreenSmall) {
            console.log("not small");
            return () => {};
        }
        switch (animation) {
            case "mobile-grid-to-top":
                return toggleMobileSlideY;
            case "mobile-grid-to-bottom":
                return toggleMobileSlideY;
            default:
                return () => {};
        }
    };

    let interval;

    // update isScreenSmall on window resize
    window.addEventListener("resize", () => {
        isScreenSmall = window.innerWidth < 640;
        if (mobileItemClicked) {
            mobileItemClicked = false;
        }
    });

    let animation;
    let animationClass;
    let groupHoverHeightClass;
    let groupHoverOpacityClass;
    let groupOverflowClass;
    $: {
        animationClass = isScreenSmall
            ? getMobileAnimationClass(item.mobileAnimation)
            : getAnimationClass(item.animation);
        animation = isScreenSmall ? item.mobileAnimation : item.animation;
        groupHoverHeightClass = isScreenSmall
            ? mobileItemClicked
                ? "max-h-full h-full"
                : "h-full"
            : "group-hover:max-h-full";
        groupHoverOpacityClass = isScreenSmall
            ? mobileItemClicked
                ? "opacity-100 h-[30%] max-h-[30%]"
                : "opacity-0 max-h-0"
            : "group-hover:opacity-100 group-hover:h-[30%] group-hover:max-h-[30%]";
        groupOverflowClass = isScreenSmall
            ? mobileItemClicked
                ? "overflow-y-auto"
                : ""
            : "group-hover:overflow-y-auto";
    }

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
<!-- svelte-ignore a11y-click-events-have-key-events -->
<div
    {key}
    class="{animation} group p-4 sm:p-8 2xl:p-12 h-full aspect-video sm:aspect-auto flex items-center"
    on:mouseenter={getMouseEnterHandler(item.animation)}
    on:mouseleave={getMouseLeaveHandler(item.animation)}
    on:click={toggleMobileAnimation(item.mobileAnimation)}
>
    <div class="w-full h-full relative overflow-hidden {groupOverflowClass}">
        <div class="w-full h-full absolute top-1/2 -translate-y-1/2">
            <div
                class="text-xl sm:text-3xl w-full h-full font-bold flex flex-col justify-center {groupHoverHeightClass}"
                style="transition: all .3s linear;"
            >
                {item.title}
                <p
                    class=" flex-none mt-2 opacity-0 font-normal text-base h-0 {groupHoverOpacityClass}"
                    style="transition: all .3s linear;"
                >
                    {item.description}
                </p>
            </div>
        </div>
    </div>
</div>
<div
    {key}
    bind:this={carousel}
    class="slider absolute bg-white z-10 {animationClass}"
    style="transition: all .3s linear"
>
    {#each item.images as image, i}
        <GridCarouselImage
            {image}
            {i}
            activeIndex={currentSlide}
            key={key + i}
        />
    {/each}
</div>
