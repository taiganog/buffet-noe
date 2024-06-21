<script setup lang="ts">
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    href: string;
    active?: boolean;
}>();

const classes = computed(() =>
    props.active ? 'font-bold text-2xl hover:text-white transition ease-in-out duration-300' :
    'hover:text-white transition ease-in-out duration-300'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
