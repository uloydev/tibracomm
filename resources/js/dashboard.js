import { createInertiaApp } from '@inertiajs/svelte'

createInertiaApp({
    id: 'app',
    resolve: name => {
        const pages = import.meta.glob('./Dashboard/**/*.svelte', { eager: true })
        return pages[`./Dashboard/${name}.svelte`]
    },
    setup({ el, App, props }) {
        new App({ target: el, props })
    },
})