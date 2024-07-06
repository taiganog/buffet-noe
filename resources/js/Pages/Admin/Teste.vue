<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';

export default {
    props: ['evento', 'servicos'],

    components: {
        LayoutAdministrativo
    },

    data() {
        return {
            servicosEscolhidos: {
                idServicos: []
            }
        }
    },

    methods: {
        incluirEvento(servico) {
            let index = this.servicosEscolhidos.idServicos.indexOf(servico)
            if(index > -1) {
                this.servicosEscolhidos.idServicos.splice(index, 1)
                return
            }
            this.servicosEscolhidos.idServicos.push(servico)
        }
    },

    computed: {
        verServicos() {
            return this.servicosEscolhidos
        }
    }
}
</script>

<template>
    <LayoutAdministrativo>
        <div>
            <p>Formulário: {{ verServicos }}</p>
        </div>
        <br />
        <div v-for="servico in servicos" class="flex gap-5">
            <p>Nome: {{ servico.nome }} - Valor: {{ servico.valor }}</p>
            <span class="cursor-pointer" @click="incluirEvento(servico)">Adicionar</span>
        </div>
    </LayoutAdministrativo>
</template>
