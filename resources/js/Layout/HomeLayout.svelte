<script>
    import Navbar from "../Component/Navbar.svelte";

    export let overrideClasses = "min-h-screen w-full relative overflow-x-hidden";
    export let fixedNavbar = true;
</script>

<div class="{overrideClasses} pt-20" >
    <Navbar fixed={fixedNavbar}/>
    <slot></slot>
</div>
