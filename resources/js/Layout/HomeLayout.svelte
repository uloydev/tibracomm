<script>
    import Navbar from "../Component/Navbar.svelte";

    export let overrideClasses = "min-h-screen w-full relative overflow-x-hidden";
    export let fixedNavbar = false;
</script>

<div class={overrideClasses} class:pt-20={fixedNavbar}>
    <Navbar fixed={fixedNavbar}/>
    <slot></slot>
</div>
