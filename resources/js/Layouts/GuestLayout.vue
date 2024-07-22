<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#adadad]">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden">
            <div class="flex justify-center">
                <a href="/">
                    <img src="img/logo.png" width="300" height="100">
                </a>
            </div>

            <slot />
        </div>
    </div>
</template>
