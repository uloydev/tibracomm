<script>
    import { onMount } from 'svelte';
    import Typewriter from 'typewriter-effect/dist/core';

    let tpContainer;
    let hideTagline = true;


    const onLogoHover = (e) => {
        console.log("hover");
        const parent = e.target;
        const logoText2 = parent.querySelector(".logo-text-2");
        const logoText2Overlay = logoText2.querySelector("div.absolute");

        logoText2Overlay.classList.add("!w-0");
    };

    const onLogoHoverLeave = (e) => {
        console.log("onLogoHoverLeave");
        const parent = e.target;
        const logoText2 = parent.querySelector(".logo-text-2");
        const logoText2Overlay = logoText2.querySelector("div.absolute");

        logoText2Overlay.classList.remove("!w-0");
    };


    onMount(() => {

        let tp = new Typewriter(tpContainer, {
        // loop: true,
        autoStart: true,
        delay: 100
    });
        tp
            .pauseFor(2000)
            .typeString('<span>THE ONLY ONE</br></span>')
            .pauseFor(800)
            .typeString('<span>THING WE`RE</br></span>')
            .pauseFor(800)
            .typeString('<span>SERIOUS ABOUT,</br></span>')
            .pauseFor(800)
            .typeString('<span class="bg-tibrared text-white px-4">INNOVATION</span>')
            .pauseFor(1000)
            .deleteChars(8)
            .pauseFor(500)
            .typeString('<span class="bg-tibrared text-white pr-4 -ml-4">CREASE</span>')
            .pauseFor(1000)
            .deleteChars(8)
            .pauseFor(500)
            .typeString('<span class="bg-tibrared text-white pr-4 -ml-4">CREATIVITY<span>')
            .pauseFor(500)
            .callFunction(() => {
                hideTagline = false;
            })
            .start();
    })
</script>

<div class="min-h-screen w-full">
    <nav class="w-full h-20 bg-tibrablue font-inter">
        <div class="h-full flex justify-between items-center overflow-hidden">
            <!-- svelte-ignore a11y-no-static-element-interactions -->
            <div class="h-full bg-tibrared text-white text-8xl font-bold relative" on:mouseenter={onLogoHover} on:mouseleave={onLogoHoverLeave}>
                <a class="" href="#">
                    <span class="logo-text-1 pl-8 relative">
                        T
                    </span>
                    <span class="logo-text-2 relative pr-8 inlineblock w-full cursor-default -ml-4">
                        ibracomm.
                        <div class="absolute z-10 right-0 h-full w-full bg-tibrablue top-0" style="transition: all .5s linear;">
                            <div class="absolute z-10 left-0 top-0 h-full w-8 bg-tibrared"></div>
                        </div>
                    </span>
                </a>
            </div>
            <!-- <div class="text-transparent"> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias fugit cupiditate eos porro tempora impedit voluptates dicta rerum harum quam, quia possimus vel placeat suscipit inventore dolores quis. Nostrum, eaque.</div> -->
        </div>
    </nav>
    <div class="px-20 text-tibrablue font-inter">
        <div id="typewriter" class="text-[8rem] font-bold mt-8 leading-40" bind:this={tpContainer}></div>
        <div id="tagline" class="text-2xl transition duration-500" class:opacity-0={hideTagline}>
            <p class="mb-0 mt-8">Mind in Action<br/>#tibrain</p>
        </div>
    </div>
</div>
