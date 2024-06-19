<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';

export default {
    props: ['evento'],

    components: {
        LayoutAdministrativo
    }
}
</script>
<template>
    <LayoutAdministrativo>
        <div v-if="!evento">a</div>
        <div v-else>{{ evento }}</div>
    </LayoutAdministrativo>
</template>
