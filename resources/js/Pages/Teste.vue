<script>
export default {
    props: ['numeroEventosTotal', 'eventos', 'clientes', 'valorDoMes'],

    data() {

    },

    methods: {

    }
}
</script>

<template>
    <div>
        <p>{{ valorDoMes }}</p>
        <br /><br />
        <p>{{ eventos }}</p>
        <br /><br />
        <p>{{ v3 }}</p>
        <br /><br />
    </div>
</template>
