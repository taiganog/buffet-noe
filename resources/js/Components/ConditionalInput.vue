<script setup lang="ts">
import { onMounted, ref } from 'vue';

const model = defineModel<string>({ required: true });

const input = ref<HTMLInputElement | null>(null);

const props = defineProps<{
    ativo: boolean;
}>();

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <input v-if="ativo" class="border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500"
           v-model="model" ref="input" />
    <input v-else class="border border-gray-500 focus:border-yellow-500 focus:ring-yellow-500 bg-gray-300"
           v-model="model" ref="input" disabled />
</template>
