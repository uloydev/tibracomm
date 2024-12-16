<script>
    import Navbar from "../Component/Navbar.svelte";
    import { onMount } from "svelte";
    import { finishLoading } from "../store";
    import { page } from "@inertiajs/svelte";

    export let overrideClasses =
        "min-h-screen w-full relative overflow-x-hidden";
    export let fixedNavbar = true;
    let showLogo,
        showButton = false;
    let loadingComponent;
    let showLoading = false;

    const btnClick = () => {
        loadingComponent.classList.add("opacity-0");
        setTimeout(() => {
            loadingComponent.classList.add("hidden");
            $finishLoading = true;
            console.log("changed !!!!!");
        }, 1000);
    };
    onMount(() => {
        showLoading = window.location.pathname === "/";
        setTimeout(() => {
            showLogo = true;
            setTimeout(() => {
                showButton = true;
            }, 750);
        }, 1000);
    });
</script>

<div class="{overrideClasses} pt-20 transition-all duration-1000">
    <svelte:component this={Navbar} fixed={fixedNavbar} />
    {#if showLoading}
        <div
            bind:this={loadingComponent}
            class="overflow-hidden transition-all duration-1000"
        >
            <div
                class="min-h-screen w-screen bg-tibrared fixed top-0 left-0 z-50"
            >
                <div
                    class=" w-2/3 xl:w-1/3 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col gap-y-20 items-center"
                >
                    <img
                        class="w-full max-w-lg transition-all duration-1000"
                        class:opacity-0={!showLogo}
                        src="/assets/img/logo.png"
                        alt="loading logo"
                    />
                    <button
                        on:click={btnClick}
                        class:opacity-0={!showButton}
                        class="block w-2/3 max-w-xs rounded-full outline outline-2 outline-white font-inter font-bold text-white text-center text-sm xl:text-lg bg-tibrared py-1 transition-all duration-1000"
                        >LET'S COLLABORATE</button
                    >
                </div>
            </div>
        </div>
    {/if}
    <slot></slot>
</div>
