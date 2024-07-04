<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';
import ConditionalButton from '@/Components/ConditionalButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ConditionalInput from '@/Components/ConditionalInput.vue';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';

import { router } from '@inertiajs/vue3';

export default {
    props: ['evento', 'servicos', 'tipo'],

    components: {
        LayoutAdministrativo,
        ConditionalButton,
        PrimaryButton,
        ConditionalInput,
        Modal,
        InputError,
    },

    data() {
        return {
            complementoModal: false,
            editarComplementoModal: false,

            // Formulário de complemento e valores
            formComplemento: this.$inertia.form({

            }),
        }
    },

    methods: {
        enviarComplemento() {
            this.formComplemento.post(route('admin.complemento.create', this.evento.id), {
                onSuccess: () => this.complementoModal = false
            })
        },

        enviarEditarComplemento() {
            this.formEditarComplemento.patch(route('admin.complemento.update', this.evento.complemento.id), {
                onSuccess: () => this.editarComplementoModal = false
            })
        }
    },

    computed: {
        contrato() {
            return this.evento.complemento ? 'Gerar contrato' : 'Insira serviços antes de gerar o contrato'
        },
    }
}
</script>
<template>
    <LayoutAdministrativo>
        <div class="shadow-xl bg-white p-5 mx-40 mt-24 max-h-[700px] overflow-auto">
            <!-- Header -->
            <div class="flex justify-between text-center font-bold text-xl">
                <h2>{{ tipo[evento.tipo] }} - {{ evento.cliente.nome }}</h2>
                <div class="flex gap-3">
                    <div v-if="evento.complemento">
                        <PrimaryButton @click="$inertia.get(route('admin.evento.editar', evento.id))">Editar</PrimaryButton>
                    </div>
                    <ConditionalButton :title="contrato" :disabled="!evento.complemento" @click="$inertia.get(route('admin.evento.contrato', evento.id))">Gerar contrato</ConditionalButton>
                </div>
            </div>
            <hr class="my-2 border-yellow-400"/>
            <!-- Conteúdo -->
            <div class="p-5">
                <!-- Informações do evento -->
                <div class="grid grid-cols-2 gap-2">
                    <p><b>Quantidade de convidados:</b> {{ evento.numero_convidados }} pessoas</p>
                    <p><b>Duração:</b> {{ evento.duracao }} horas</p>
                    <p><b>Local:</b> {{ evento.local }}</p>
                    <p><b>Data: </b> {{ evento.data }}</p>
                    <hr class="col-span-2 my-2 border-yellow-400" />
                </div>
                <!-- Complementos -->
                <div class="text-center">
                    <div class="font-bold text-xl p-4">
                        <span>Serviços</span>
                        <hr class="w-3/12 m-auto border-yellow-400" />
                    </div>
                    <!-- Mostrar complementos se evento já possuir serviços cadastrados -->
                    <div v-if="evento.complemento">
                        <div class="grid grid-cols-3 gap-2 font-bold p-2">
                            <p>Serviço</p>
                            <p>Quantidade</p>
                            <p>Valor</p>
                        </div>
                        <div v-for="(chave, valor) in complementos" class="grid grid-cols-3 gap-2">
                            <p v-if="evento.complemento[valor] !== null">{{ chave }}</p>
                            <p v-if="evento.complemento[valor] !== null">{{ evento.complemento[valor] }}</p>
                            <p v-if="evento.complemento[valor] !== null">R$ {{ evento.valor[valor] }},00</p>
                        </div>
                    </div>
                    <!-- Mostrar opção de cadastrar complementos se evento não já possuir -->
                    <div v-else>
                        <p class="p-2">Esse evento ainda não possui serviços cadastrados :(</p>
                        <PrimaryButton @click="complementoModal = true">Cadastrar</PrimaryButton>
                    </div>
                </div>
                <!-- Observação -->
                <div class="text-center">
                    <div class="font-bold text-xl p-4">
                        <span>Observação</span>
                        <hr class="w-3/12 m-auto border-yellow-400" />
                    </div>
                    <div>
                        <p v-if="evento.observacao" class="p-2">{{ evento.observacao }}</p>
                        <p v-else class="p-2">Nenhuma observação.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para cadastro de complemento -->
        <Modal :show="complementoModal" @close="complementoModal = false" maxWidth="5xl">
            <!-- Título -->
            <div class="text-center">
                <h3 class="font-bold text-2xl p-4">Cadastrar Serviços</h3>
                <hr class="border-yellow-400 w-10/12 m-auto" />
            </div>
            <form @submit.prevent="enviarComplemento">
                <!-- Serviços -->
                <div v-for="servico in servicos">
                    <div class="grid grid-cols-3 gap-2 font-bold p-2">
                        <PrimaryButton>Adicionar</PrimaryButton>
                        <p>{{ servico.nome }}</p>
                        <p>R$ {{ servico.valor }},00</p>
                    </div>
                </div>
                <!-- Cadastrar -->
                <div class="flex flex-row-reverse gap-5 p-5">
                    <PrimaryButton type="submit">Cadastrar</PrimaryButton>
                </div>
            </form>
        </Modal>
    </LayoutAdministrativo>
</template>
