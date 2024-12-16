<script>
    import { onMount, getContext } from "svelte";
    import Typewriter from "typewriter-effect/dist/core";
    import HomeLayout from "../Layout/HomeLayout.svelte";
    import { finishLoading } from "../store";

    let tpContainer;
    let hideTagline = true;

    const startWriting = () => {
        let isMobile = window.innerWidth < 640;

        let tp = new Typewriter(tpContainer, {
            autoStart: true,
            delay: 100,
        });
        if (isMobile) {
            tp.pauseFor(2000)
                .typeString("<span>THE ONLY</br></span>")
                .pauseFor(800)
                .typeString("<span>ONE THING</br></span>")
                .pauseFor(800)
                .typeString("<span>WE ARE</br></span>")
                .pauseFor(800)
                .typeString("<span>SERIOUS</br></span>")
                .pauseFor(800)
                .typeString("<span>ABOUT,</br></span>")
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
                    '<span class="bg-tibrared text-white pr-4 -ml-4 ">CREATIVITY<span>',
                )
                .pauseFor(500)
                .callFunction(() => {
                    hideTagline = false;
                })
                .start();
        } else {
            tp.pauseFor(2000)
                .typeString("<span>THE ONLY ONE</br></span>")
                .pauseFor(800)
                .typeString("<span>THING WE`RE</br></span>")
                .pauseFor(800)
                .typeString("<span>SERIOUS ABOUT,</br></span>")
                .pauseFor(800)
                .typeString(
                    '<span class="bg-tibrared text-white px-2 sm:px-4">INNOVATION</span>',
                )
                .pauseFor(1000)
                .deleteChars(8)
                .pauseFor(500)
                .typeString(
                    '<span class="bg-tibrared text-white pr-2 -ml-2 sm:pr-4 sm:-ml-4">CREASE</span>',
                )
                .pauseFor(1000)
                .deleteChars(8)
                .pauseFor(500)
                .typeString(
                    '<span class="bg-tibrared text-white pr-2 -ml-2 sm:pr-4 sm:-ml-4 ">CREATIVITY<span>',
                )
                .pauseFor(500)
                .callFunction(() => {
                    hideTagline = false;
                })
                .start();
        }
    };

    onMount(() => {
        finishLoading.subscribe((value) => {
            if (value) {
                startWriting();
            }
        });
    });
</script>

<HomeLayout>
    <div
        class="pb-10 sm:pb-0 px-4 sm:px-20 text-tibrablue font-inter h-[calc(100vh-5rem)] sm:h-auto flex flex-col justify-between sm:block"
    >
        <div
            id="typewriter"
            class="text-[3.5rem] sm:text-[7rem] font-bold mt-[6.5rem] sm:mt-8 leading-[4.25rem] sm:leading-32"
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
