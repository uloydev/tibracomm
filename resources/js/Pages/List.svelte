<script>
    import { inertia } from "@inertiajs/svelte";

    /** @typedef {Object} Section 
     * @property {number} id
     * @property {string} name
     * @property {string} slug
     * @property {string} [description]
     * @property {string} viewUrl
    */

    /** @type {Section[]} */
    export let sections = [];


</script>

<div>
    <h1>List Page</h1>
    <ul>
        {#each sections as section}
            <li>
                <a href={section.viewUrl} class="my-3 ml-8 text-2xl text-tibrared" use:inertia>{section.name}</a>
            </li>
        {/each}
    </ul>
</div>