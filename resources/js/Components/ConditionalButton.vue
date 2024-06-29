<script setup lang="ts">
withDefaults(
    defineProps<{
        type?: 'button' | 'submit' | 'reset';
        disabled?: boolean
    }>(),
    {
        disabled: false,
        type: 'button',
    }
);
</script>

<template>
    <button
        v-if="!disabled"
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-300">
        <slot />
    </button>

    <button
        v-else
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-yellow-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-300"
        disabled
        >
        <slot />
    </button>
</template>
