<script>
    export let image;
    export let i;
    export let activeIndex;
    export let key;
</script>

<img
    {key}
    src={image}
    alt={key}
    class="absolute top-0 left-0 h-full w-full object-cover" class:opacity-0={i != activeIndex}
    style="transition: all .5s linear"
/>
