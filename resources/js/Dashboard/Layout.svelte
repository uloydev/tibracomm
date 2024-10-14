<script>
    import { page } from "@inertiajs/svelte";
    import { onMount } from "svelte";
    import Swal from "sweetalert2";
    import Footer from "./Component/Footer.svelte";
    import NavBar from "./Component/NavBar.svelte";
    import SideNav from "./Component/SideNav.svelte";

    onMount(() => {
        // handle success message
        if ($page.props.success) {
            Swal.fire({
                title: "Success!",
                text: $page.props.success,
                icon: "success",
                confirmButtonText: "Ok",
                confirmButtonColor: "#3085d6",
            });
        }

        // handle errors messages
        if ($page.props.error) {
            Swal.fire({
                title: "Error!",
                text: $page.props.error,
                icon: "error",
                confirmButtonText: "Ok",
                confirmButtonColor: "#3085d6",
            });
        }

        // Dropdown
        var dropdown_triggers = document.querySelectorAll("[dropdown-trigger]");
        dropdown_triggers.forEach((dropdown_trigger) => {
            let dropdown_menu =
                dropdown_trigger.parentElement.querySelector("[dropdown-menu]");

            dropdown_trigger.addEventListener("click", function () {
                dropdown_menu.classList.toggle("opacity-0");
                dropdown_menu.classList.toggle("pointer-events-none");
                dropdown_menu.classList.toggle("before:-top-5");
                if (dropdown_trigger.getAttribute("aria-expanded") == "false") {
                    dropdown_trigger.setAttribute("aria-expanded", "true");
                    dropdown_menu.classList.remove("transform-dropdown");
                    dropdown_menu.classList.add("transform-dropdown-show");
                } else {
                    dropdown_trigger.setAttribute("aria-expanded", "false");
                    dropdown_menu.classList.remove("transform-dropdown-show");
                    dropdown_menu.classList.add("transform-dropdown");
                }
            });

            window.addEventListener("click", function (e) {
                if (
                    !dropdown_menu.contains(e.target) &&
                    !dropdown_trigger.contains(e.target)
                ) {
                    if (
                        dropdown_trigger.getAttribute("aria-expanded") == "true"
                    ) {
                        dropdown_trigger.click();
                    }
                }
            });
        });

        // tooltip
        var buttons = document.querySelectorAll(
            "[data-target='tooltip_trigger']",
        );

        buttons.forEach((button) => {
            var tooltip = button.nextElementSibling;
            var placement = button.getAttribute("data-placement");

            const popperInstance = Popper.createPopper(button, tooltip, {
                modifiers: [
                    {
                        name: "offset",
                        options: {
                            offset: [0, 8],
                        },
                    },
                ],
                placement: placement,
            });

            function show() {
                // Make the tooltip visible
                tooltip.classList.remove("hidden");
                tooltip.classList.add("block");

                // Enable the event listeners
                popperInstance.setOptions((options) => ({
                    ...options,
                    modifiers: [
                        ...options.modifiers,
                        { name: "eventListeners", enabled: true },
                    ],
                }));

                // Update its position
                popperInstance.update();
            }

            function hide() {
                // Hide the tooltip

                tooltip.classList.remove("block");
                tooltip.classList.add("hidden");

                // Disable the event listeners
                popperInstance.setOptions((options) => ({
                    ...options,
                    modifiers: [
                        ...options.modifiers,
                        { name: "eventListeners", enabled: false },
                    ],
                }));
            }

            const showEvents = ["mouseenter", "focus"];
            const hideEvents = ["mouseleave", "blur"];

            showEvents.forEach((event) => {
                button.addEventListener(event, show);
            });

            hideEvents.forEach((event) => {
                button.addEventListener(event, hide);
            });
        });
    });

    // perfect-scrollbar
    (function () {
        var isWindows = navigator.platform.indexOf("Win") > -1 ? true : false;

        if (isWindows) {
            // if we are on windows OS we activate the perfectScrollbar function
            if (document.querySelector("main")) {
                var mainpanel = document.querySelector("main");
                var ps = new PerfectScrollbar(mainpanel);
            }

            if (document.querySelectorAll(".overflow-auto")[0]) {
                var sidebar = document.querySelectorAll(".overflow-auto");
                var i = 0;
                var ps;
                sidebar.forEach((element) => {
                    ps[i++] = new PerfectScrollbar(element);
                });
            }
            if (document.querySelectorAll(".overflow-y-auto")[0]) {
                var sidebar = document.querySelectorAll(".overflow-y-auto");
                var i = 0;
                var ps;
                sidebar.forEach((element) => {
                    ps[i++] = new PerfectScrollbar(element);
                });
            }
            if (document.querySelectorAll(".overflow-x-auto")[0]) {
                var sidebar = document.querySelectorAll(".overflow-x-auto");
                var i = 0;
                var ps;
                sidebar.forEach((element) => {
                    ps[i++] = new PerfectScrollbar(element);
                });
            }
        }
    })();
</script>

<!-- set title -->
<svelte:head>
    <title>Tibracomm. - {$page.props.title}</title>
</svelte:head>

<SideNav />
<main
    class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200"
>
    <NavBar />
    <div
        class="w-full min-h-[90vh] flex flex-col justify-between px-6 py-6 mx-auto"
    >
        <slot></slot>
        <Footer />
    </div>
</main>

<style>
    /*
 * Container style
 */
    .ps {
        overflow: hidden !important;
        overflow-anchor: none;
        -ms-overflow-style: none;
        touch-action: auto;
        -ms-touch-action: auto;
    }

    /*
   * Scrollbar rail styles
   */
    .ps__rail-x {
        display: none;
        opacity: 0;
        transition:
            background-color 0.2s linear,
            opacity 0.2s linear;
        -webkit-transition:
            background-color 0.2s linear,
            opacity 0.2s linear;
        height: 15px;
        /* there must be 'bottom' or 'top' for ps__rail-x */
        bottom: 0px;
        /* please don't change 'position' */
        position: absolute;
    }

    .ps__rail-y {
        display: none;
        opacity: 0;
        transition:
            background-color 0.2s linear,
            opacity 0.2s linear;
        -webkit-transition:
            background-color 0.2s linear,
            opacity 0.2s linear;
        width: 15px;
        /* there must be 'right' or 'left' for ps__rail-y */
        right: 0;
        /* please don't change 'position' */
        position: absolute;
    }

    .ps--active-x > .ps__rail-x,
    .ps--active-y > .ps__rail-y {
        display: block;
        background-color: transparent;
    }

    .ps:hover > .ps__rail-x,
    .ps:hover > .ps__rail-y,
    .ps--focus > .ps__rail-x,
    .ps--focus > .ps__rail-y,
    .ps--scrolling-x > .ps__rail-x,
    .ps--scrolling-y > .ps__rail-y {
        opacity: 0.6;
    }

    .ps .ps__rail-x:hover,
    .ps .ps__rail-y:hover,
    .ps .ps__rail-x:focus,
    .ps .ps__rail-y:focus,
    .ps .ps__rail-x.ps--clicking,
    .ps .ps__rail-y.ps--clicking {
        background-color: #eee;
        opacity: 0.9;
    }

    /*
   * Scrollbar thumb styles
   */
    .ps__thumb-x {
        background-color: #aaa;
        border-radius: 6px;
        transition:
            background-color 0.2s linear,
            height 0.2s ease-in-out;
        -webkit-transition:
            background-color 0.2s linear,
            height 0.2s ease-in-out;
        height: 6px;
        /* there must be 'bottom' for ps__thumb-x */
        bottom: 2px;
        /* please don't change 'position' */
        position: absolute;
    }

    .ps__thumb-y {
        background-color: #aaa;
        border-radius: 6px;
        transition:
            background-color 0.2s linear,
            width 0.2s ease-in-out;
        -webkit-transition:
            background-color 0.2s linear,
            width 0.2s ease-in-out;
        width: 6px;
        /* there must be 'right' for ps__thumb-y */
        right: 2px;
        /* please don't change 'position' */
        position: absolute;
    }

    .ps__rail-x:hover > .ps__thumb-x,
    .ps__rail-x:focus > .ps__thumb-x,
    .ps__rail-x.ps--clicking .ps__thumb-x {
        background-color: #999;
        height: 11px;
    }

    .ps__rail-y:hover > .ps__thumb-y,
    .ps__rail-y:focus > .ps__thumb-y,
    .ps__rail-y.ps--clicking .ps__thumb-y {
        background-color: #999;
        width: 11px;
    }

    /* MS supports */
    @supports (-ms-overflow-style: none) {
        .ps {
            overflow: auto !important;
        }
    }

    @media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
        .ps {
            overflow: auto !important;
        }
    }
</style>
