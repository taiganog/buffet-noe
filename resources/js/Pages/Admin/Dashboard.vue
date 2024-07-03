<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';
import { Link } from '@inertiajs/vue3';

export default {
    props: ['numeroEventosTotal', 'eventos', 'valorDoMes', 'valorRecebido', 'tipo'],

    components: {
        LayoutAdministrativo,
        Link
    },

    methods: {

    }
}
</script>

<template>
    <LayoutAdministrativo>
        <!-- Seção topo do dashboard -->
        <div class="grid grid-cols-3 gap-5 px-40 pt-24">

            <!-- Listagem dos próximos eventos -->
            <div class="min-h-[250px] shadow-xl bg-white">
                <div class="font-black text-[#ffa32c] text-xl p-4 pb-2">
                    <span>Próximos eventos</span>
                </div>

                <div class="p-5 text-md">
                    <div v-for="evento in eventos">
                        <Link :href="route('admin.evento.unico', evento.id)">
                            <div class="flex justify-between hover:cursor-pointer hover:bg-gray-200 transition duration-300 p-1 rounded">
                                <div>
                                    <span><b>{{ tipo[evento.tipo] }}</b> - </span>
                                    <span>{{ evento.cliente.nome }}</span>
                                </div>
                                <span>{{ evento.data }}</span>
                            </div>
                        </Link>
                        <hr class="my-3" />
                    </div>
                </div>
            </div>

            <!-- Listagem de eventos totais do mês -->
            <div class="shadow-xl bg-white">
                <div class="font-black text-[#ffa32c] text-xl p-4 pb-2">
                    <span>Eventos totais do mês</span>
                </div>

                <div class="p-5 text-2xl font-bold">
                    <span>{{ numeroEventosTotal }}</span>
                </div>
            </div>

            <!-- Listagem de rendimentos do mês -->
            <div class="shadow-xl bg-white">
                <div class="font-black text-[#ffa32c] text-xl p-4 pb-2">
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
        <div class="px-40 mt-8">
            <div class="shadow-xl px-5 min-h-[500px] bg-white items-center">
        </div>

        </div>
    </LayoutAdministrativo>
</template>
