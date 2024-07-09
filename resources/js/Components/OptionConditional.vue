<script setup lang="ts">
withDefaults(
    defineProps<{
        disabled?: boolean;
    }>(),
    {
        disabled: false,
    }
);
</script>

<template>
    <option
        v-if="!disabled"
        >
        <slot />
    </option>

    <option
        v-else
        disabled
        >
        <slot />
    </option>
</template>
