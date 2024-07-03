<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';
import TextInput from '@/Components/TextInput.vue';
import ConditionalInput from '@/Components/ConditionalInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';

import { router } from '@inertiajs/vue3';

export default {
    props: ['complementos', 'clientes', 'tipos'],

    components: {
        LayoutAdministrativo,
        TextInput,
        ConditionalInput,
        PrimaryButton,
        Modal,
        InputError
    },

    data() {
        return {
            tituloAtual: 'Cliente',

            clienteModal: false,

            clienteCadastrado: false,
            eventoCadastrado: false,

            formCliente: this.$inertia.form({
                nome: '',
                telefone: '',
                telefone_2: '',
                endereco: '',
                cpf: '',
                rg: '',
            }),


            formEvento: this.$inertia.form({
                cpf_cliente: '',
                tipo: '',
                dia: '',
                duracao: '',
                numero_convidados: '',
                local: '',
                observacao: ''
            }),
        }
    },

    methods: {
        enviarCliente() {
            this.formCliente.post(route('admin.cliente.create'), {
                onSuccess: () => {
                    this.clienteCadastrado = true;
                    this.formEvento.cpf_cliente = this.formCliente.cpf;
                    this.tituloAtual = 'Evento'
                }
            })
        },

        enviarEvento() {
            this.formEvento.post(route('admin.evento.create'), {
                onSuccess: () => { this.eventoCadastrado = true; this.tituloAtual = 'Complementos' }
            })
        },

        fecharModal() {
            this.clienteModal = false
        },

        setCliente(cliente) {
            this.formCliente.nome = cliente.nome
            this.formEvento.cpf_cliente = cliente.cpf
            this.clienteCadastrado = true
            this.tituloAtual = 'Evento'
            this.clienteModal = false
        }
    },

    computed: {
        atualizarTitulo() {
            return this.tituloAtual
        },
    },

}
</script>

<template>
    <LayoutAdministrativo>
        <div class="shadow-xl bg-white p-5 mx-40 mt-24 max-h-[700px] overflow-auto">
            <!-- Título atual -->
            <div class="text-center">
                <h3 class="font-bold text-2xl">{{ atualizarTitulo }}</h3>
                <hr class="border-yellow-400 w-10/12 m-auto" />
            </div>

            <div class="p-5">
                <!-- Formulário de cliente -->
                <form @submit.prevent="enviarCliente" v-show="!clienteCadastrado">
                    <div class="text-xs">
                        <div class="relative my-5">
                            <label for="nome" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Nome</label>
                            <TextInput type="text" class="w-full" id="nome" v-model="formCliente.nome" />
                            <InputError :message="formCliente.errors.nome" class="mt-2" />
                        </div>
                        <div class="relative my-5">
                            <label for="telefone" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Telefone Principal</label>
                            <TextInput type="tel" class="w-full" id="telefone" v-model="formCliente.telefone" v-mask="['(##) ####-####', '(##) #####-####']"/>
                            <InputError :message="formCliente.errors.telefone" class="mt-2" />

                        </div>
                        <div class="relative my-5">
                            <label for="telefone_backup" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Telefone Secundário</label>
                            <TextInput type="tel" class="w-full" id="telefone_backup" v-model="formCliente.telefone_2" v-mask="['(##) ####-####', '(##) #####-####']"/>
                            <InputError :message="formCliente.errors.telefone_2" class="mt-2" />

                        </div>
                        <div class="relative my-5">
                            <label for="endereco" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Endereço (CEP e Logradouro)</label>
                            <TextInput type="text" class="w-full" id="endereco" v-model="formCliente.endereco" />
                            <InputError :message="formCliente.errors.endereco" class="mt-2" />

                        </div>
                        <div class="relative my-5">
                            <label for="cpf" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">CPF/CNPJ</label>
                            <TextInput type="text" class="w-full" id="cpf" v-model="formCliente.cpf" v-mask="['###.###.###-##', '##.###.###/####-##']"/>
                            <InputError :message="formCliente.errors.cpf" class="mt-2" />

                        </div>
                        <div class="relative my-5">
                            <label for="rg" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">RG</label>
                            <TextInput type="text" class="w-full" id="rg" v-model="formCliente.rg" />
                            <InputError :message="formCliente.errors.rg" class="mt-2" />

                        </div>
                    </div>

                    <div class="flex flex-row-reverse gap-5">
                        <PrimaryButton type="submit">Cadastrar</PrimaryButton>
                        <PrimaryButton @click="clienteModal = true">Selecionar Cliente</PrimaryButton>
                    </div>
                </form>
                <!-- Formulário de evento -->
                <form @submit.prevent="enviarEvento" v-show="clienteCadastrado && !eventoCadastrado">
                    <div class="text-xs">
                        <div class="relative my-5">
                            <label for="nome_cliente" class="absolute top-[-10px] left-[10px] z-index-20 bg-none">Cliente</label>
                            <TextInput type="text" class="w-full bg-gray-300" id="nome_cliente" :value="formCliente.nome" disabled />
                            <InputError :message="formEvento.errors.rg" class="mt-2" />
                        </div>
                        <div class="relative my-5">
                            <label for="tipo" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Tipo do evento</label>
                            <select class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500" id="tipo" v-model="formEvento.tipo">
                                <option value="" selected disabled>Selecione uma opção</option>
                                <option v-for="(tipo, chave) in tipos" :value="chave">{{ tipo }}</option>
                            </select>
                            <InputError :message="formEvento.errors.tipo" class="mt-2" />
                        </div>
                        <div class="relative my-5">
                            <label for="data" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Data e hora de início</label>
                            <TextInput type="datetime-local" class="w-full" id="data" v-model="formEvento.dia" />
                            <InputError :message="formEvento.errors.dia" class="mt-2" />
                        </div>
                        <div class="relative my-5">
                            <label for="duracao" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Duração (em horas)</label>
                            <TextInput type="number" class="w-full" id="duracao" v-model="formEvento.duracao" />
                            <InputError :message="formEvento.errors.duracao" class="mt-2" />
                        </div>
                        <div class="relative my-5">
                            <label for="local" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Local do evento (Endereço)</label>
                            <TextInput type="text" class="w-full" id="local" v-model="formEvento.local" />
                            <InputError :message="formEvento.errors.local" class="mt-2" />
                        </div>
                        <div class="relative my-5">
                            <label for="convidados" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Nº de Convidados</label>
                            <TextInput type="number" class="w-full" id="convidados" v-model="formEvento.numero_convidados" />
                            <InputError :message="formEvento.errors.numero_convidados" class="mt-2" />
                        </div>
                        <div class="relative my-5">
                            <label for="observacao" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Observação</label>
                            <textarea type="text" class="border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 w-full" id="observacao" v-model="formEvento.observacao" />
                        </div>
                    </div>

                    <div class="flex flex-row-reverse gap-5">
                        <PrimaryButton type="submit">Cadastrar</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal de escolha de cliente -->
        <Modal :show="clienteModal" maxWidth="md" @close="clienteModal = false">
            <div class="p-5">
                <!-- Título -->
                <div class="text-center">
                    <span class="text-xl font-bold">Clientes</span>
                    <hr class="border-yellow-400 w-10/12 m-auto" />
                </div>
                <!-- Listagem -->
                <div class="grid grid-cols-2 text-center font-bold mt-1">
                    <span>Nome</span>
                    <span>CPF</span>
                </div>
                <div v-for="cliente in clientes"
                @click="setCliente(cliente)"
                class="grid grid-cols-2 text-sm hover:cursor-pointer hover:bg-gray-100 transition duration-300 p-2 px-8">
                    <p>{{ cliente.nome }}</p>
                    <p class="text-right">{{ cliente.cpf }}</p>
                </div>
            </div>
        </Modal>
    </LayoutAdministrativo>
</template>
