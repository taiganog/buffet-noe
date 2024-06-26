<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import { router } from '@inertiajs/vue3';

export default {
    props: ['eventos', 'complementos'],

    components: {
        LayoutAdministrativo,
        PrimaryButton,
        SecondaryButton,
        DangerButton,
        Modal
    },

    data() {
        return {
            eventoModal: false,
        }
    },

    methods: {
        fecharModal() {
            this.eventoModal = false
        }
    }
}
</script>
<template>
    <LayoutAdministrativo>
        <div class="shadow-xl bg-white p-5 mx-40 mt-24 max-h-[700px] overflow-auto">
            <!-- Header -->
            <div class="flex justify-between items-center">
                <p class="text-gray-400 text-center italic">Clique em um card para ver detalhes</p>
                <PrimaryButton @click="$inertia.get(route('admin.evento.cadastro'))">Novo evento</PrimaryButton>
            </div>
            <hr class="my-2 border-yellow-400"/>
            <!-- Titulo tabela -->
            <div class="grid grid-cols-5 text-center font-bold">
                <span>Tipo</span>
                <span>Cliente</span>
                <span>Duração</span>
                <span>Capacidade</span>
                <span>Data</span>
                <hr class="col-span-5 mt-2 w-11/12 m-auto border-yellow-400" />
            </div>
            <!-- Conteúdo dos eventos -->
            <div v-for="(evento, key) in eventos"
            @click = "$inertia.get(route('admin.evento', evento.id))"
            class="grid grid-cols-5 text-center my-3 py-2 rounded-md hover:bg-gray-100 transition duration-300 text-md cursor-pointer">
                <span class="font-bold">{{ evento.tipo }}</span>
                <span>{{ evento.cliente.nome }}</span>
                <span>{{ evento.duracao }} horas</span>
                <span>{{ evento.numero_convidados }} convidados</span>
                <span>{{ evento.data }}</span>
            </div>
        </div>
    </LayoutAdministrativo>
</template>
