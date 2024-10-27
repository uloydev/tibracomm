<script>
    import { page } from "@inertiajs/svelte";

    /**
     * @typedef {Object} Section
     * @property {number} id
     * @property {string} name
     * @property {string} slug
     * @property {string} [description]
     * @property {string} viewUrl
     */

    /**
     * @type {Section[]}
     */
    export let fixed = false;
    let sections = $page.props.sections;
    let isMobile = window.innerWidth < 640;

    // on window resize
    window.addEventListener("resize", () => {
        isMobile = window.innerWidth < 640;
    });

    let fixedClass = "";
    $: {
        fixedClass = fixed ? "fixed top-0 z-10" : "";
    }

    let sidebarOpen = false;
    let showLogo = false;

    const handleLogoClick = () => {
        if (!showLogo && isMobile) {
            showLogo = true;
            setTimeout(() => {
                showLogo = false;
            }, 2000);
            return;
        }
        showLogo = false;
        window.location.href = "/";
    };
</script>

<nav class="w-full h-20 bg-tibrablue font-inter overflow-x-hidden {fixedClass}">
    <div class="h-full flex justify-between items-center overflow-hidden">
        <!-- svelte-ignore a11y-no-static-element-interactions -->
        <div
            class="h-20 text-white sm:text-8xl text-5xl font-bold relative group"
        >
            <!-- svelte-ignore a11y-click-events-have-key-events -->
            <!-- svelte-ignore a11y-missing-attribute -->
            <a class="h-20" on:click={()=>handleLogoClick()}>
                <div class="flex h-20 bg-tibrared sm:bg-inherit">
                    <span
                        class="logo-text-1 pl-8 group-hover:pr-0 sm:bg-tibrared pt-3 sm:pt-0"
                    >
                        T
                    </span>
                    <span
                        class="pt-3 sm:pt-0 relative overflow-hidden logo-text-2 block w-0 group-hover:w-full pr-8 bg-tibrared"
                        style="transition: all .5s linear;"
                    >
                        ibracomm.
                        <div
                            class="absolute z-10 top-0 h-full w-8 bg-tibrared left-0 group-hover:left-full group-hover:w-64 sm:group-hover:w-96 border-0 shadow-0"
                            style="transition: all .5s linear;"
                        ></div>
                    </span>
                </div>
            </a>
        </div>
        <div class="mr-4 h-full">
            <button
                on:click={() => {
                    sidebarOpen = !sidebarOpen;
                }}
                class="relative h-full"
            >
                <img
                    src="/icons/burger.svg"
                    alt="burger"
                    class="absolute top-1/2 right-1/2 -translate-x-1/2 -translate-y-1/2 w-10 h-10 trasition duration-500"
                    class:opacity-0={sidebarOpen}
                />
                <img
                    src="/icons/cross.svg"
                    alt="burger"
                    class="absolute top-1/2 right-1/2 -translate-x-1/2 -translate-y-1/2 w-9 h-9 trasition duration-500"
                    class:opacity-0={!sidebarOpen}
                />
            </button>
        </div>
    </div>
</nav>
<div
    class="absolute z-10 bottom-0 w-full sm:w-1/4 h-[calc(100%-5rem)] bg-tibrablue {sidebarOpen
        ? 'right-0'
        : '-right-full sm:-right-1/4'}"
    style="transition: all .2s linear;"
>
    <ul class=" text-right text-white font-inter text-xl sm:text-2xl uppercase">
        {#each sections as section}
            <li class="hover:bg-tibrared hover:font-bold">
                <a class="block px-10 py-6" href={section.viewUrl}
                    >{section.name}</a
                >
            </li>
        {/each}
    </ul>
</div>
