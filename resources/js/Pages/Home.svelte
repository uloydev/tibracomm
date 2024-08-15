<script>
    import { onMount } from "svelte";
    import Typewriter from "typewriter-effect/dist/core";
    import HomeLayout from "../Layout/HomeLayout.svelte";

    let tpContainer;
    let hideTagline = true;

    onMount(() => {
        let tp = new Typewriter(tpContainer, {
            autoStart: true,
            delay: 100,
        });
        tp.pauseFor(2000)
            .typeString("<span>THE ONLY ONE</br></span>")
            .pauseFor(800)
            .typeString("<span>THING WE`RE</br></span>")
            .pauseFor(800)
            .typeString("<span>SERIOUS ABOUT,</br></span>")
            .pauseFor(800)
            .typeString(
                '<span class="bg-tibrared text-white px-4">INNOVATION</span>',
            )
            .pauseFor(1000)
            .deleteChars(8)
            .pauseFor(500)
            .typeString(
                '<span class="bg-tibrared text-white pr-4 -ml-4">CREASE</span>',
            )
            .pauseFor(1000)
            .deleteChars(8)
            .pauseFor(500)
            .typeString(
                '<span class="bg-tibrared text-white pr-4 -ml-4">CREATIVITY<span>',
            )
            .pauseFor(500)
            .callFunction(() => {
                hideTagline = false;
            })
            .start();
    });
</script>

<HomeLayout>
    <div class="px-20 text-tibrablue font-inter">
        <div
            id="typewriter"
            class="text-[8rem] font-bold mt-8 leading-40"
            bind:this={tpContainer}
        ></div>
        <div
            id="tagline"
            class="text-2xl transition duration-500"
            class:opacity-0={hideTagline}
        >
            <p class="mb-0 mt-8">Mind in Action<br />#tibrain</p>
        </div>
    </div>
</HomeLayout>
