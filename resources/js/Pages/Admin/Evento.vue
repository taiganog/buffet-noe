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
        <!-- Conteúdo geral -->
        <div v-if="!evento">a</div>
        <!-- Detalhes de um evento -->
        <div v-else>{{ evento }}</div>
        <br />
        <div></div>
    </LayoutAdministrativo>
</template>
