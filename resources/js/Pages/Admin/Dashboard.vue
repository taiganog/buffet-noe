<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';

export default {
    props: ['numeroEventosTotal', 'eventos', 'valorDoMes', 'valorRecebido'],

    components: {
        LayoutAdministrativo
    },

    methods: {

    }
}
</script>

<template>
    <LayoutAdministrativo>
        <!-- Seção topo do dashboard -->
        <div class="grid grid-cols-3 gap-5 p-5 m-5">

            <!-- Listagem dos próximos eventos -->
            <div class="min-h-[250px] shadow-xl bg-white">
                <div class="font-black text-[#ffa32c] text-xl p-4">
                    <span>Próximos eventos</span>
                </div>

                <div class="p-5 text-md">
                    <div v-for="evento in eventos">
                        <div class="flex justify-between">
                            <div>
                                <span><b>{{ evento.tipo }}</b> - </span>
                                <span>{{ evento.cliente.nome }}</span>
                            </div>
                            <span>{{ evento.data }}</span>
                        </div>
                        <hr class="my-3" />
                    </div>
                </div>
            </div>

            <!-- Listagem de eventos totais do mês -->
            <div class="shadow-xl bg-white">
                <div class="font-black text-[#ffa32c] text-xl p-4">
                    <span>Eventos totais do mês</span>
                </div>

                <div class="p-5 text-xl font-bold">
                    <span>{{ numeroEventosTotal }}</span>
                </div>
            </div>

            <!-- Listagem de rendimentos do mês -->
            <div class="shadow-xl bg-white">
                <div class="font-black text-[#ffa32c] text-xl p-4">
                    <span>Rendimentos do mês</span>
                </div>

                <div class="p-5 text-md">
                    <p class="font-bold">Valor total do mês</p>
                    <span v-if="valorDoMes">R$ {{ valorDoMes }},00</span>
                    <span v-else>R$ 0,00</span>

                    <p class="font-bold mt-3">Valor já recebido</p>
                    <span v-if="valorRecebido">R$ {{ valorRecebido }},00</span>
                    <span v-else>R$ 0,00</span>
                </div>
            </div>
        </div>

        <!-- Calendário -->
        <div class="shadow-xl p-5 mx-10 min-h-[550px] bg-white items-center">
        </div>
    </LayoutAdministrativo>
</template>
