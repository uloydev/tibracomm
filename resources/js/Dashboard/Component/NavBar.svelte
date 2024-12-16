<script>
    import { inertia, page } from "@inertiajs/svelte";

    const breadcrumbs = $page.props.breadcrumbs;

</script>


<nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
    navbar-main navbar-scroll="true">
    <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
            <!-- breadcrumb -->
            <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                <li class="leading-normal text-sm">
                    <a class="opacity-50 hover:opacity-100 text-slate-700"
                        href="/" use:inertia>Dashboard</a>
                </li>
                {#each breadcrumbs as breadcrumb}
                        <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                            aria-current="page">
                            <a class="opacity-50 hover:opacity-100 text-slate-700"
                                href="{breadcrumb.url}" use:inertia>{breadcrumb.name }</a>
                        </li>
                    
                {/each}
            </ol>
            <h6 class="mb-0 font-bold capitalize">{$page.props.title}</h6>
        </nav>

        <div class="flex justify-end items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                <li class="flex items-center">
                    <button use:inertia="{{ href: '/logout', method: 'post' }}" type="button" class="block px-0 py-2 font-semibold transition-all ease-nav-brand text-sm text-slate-500">
                        <i class="fa fa-user sm:mr-1"></i>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
                </li>
                <li class="flex items-center pl-4 xl:hidden">
                    <!-- svelte-ignore a11y-invalid-attribute -->
                    <a href="javascript:;" class="block p-0 transition-all ease-nav-brand text-sm text-slate-500"
                        sidenav-trigger>
                        <div class="w-4.5 overflow-hidden">
                            <i
                                class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                            <i
                                class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                            <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
