<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';

export default {
    props: ['evento', 'complementos'],

    components: {
        LayoutAdministrativo
    }
}
</script>
<template>
    <LayoutAdministrativo>
        <div>{{ evento }}</div>
        <br />
        <div></div>
    </LayoutAdministrativo>
</template>