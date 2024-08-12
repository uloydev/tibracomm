import { createInertiaApp } from '@inertiajs/svelte'

createInertiaApp({
    id: 'app',
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.svelte', { eager: true })
        return pages[`./Pages/${name}.svelte`]
    },
    setup({ el, App, props }) {
        new App({ target: el, props })
    },
})