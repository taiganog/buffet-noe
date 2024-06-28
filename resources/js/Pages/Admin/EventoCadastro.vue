<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';
import TextInput from '@/Components/TextInput.vue';
import ConditionalInput from '@/Components/ConditionalInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';

import { router } from '@inertiajs/vue3';

export default {
    props: ['complementos', 'clientes', 'tipos'],

    components: {
        LayoutAdministrativo,
        TextInput,
        ConditionalInput,
        PrimaryButton,
        Modal
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

            formComplemento: this.$inertia.form({
                cascata: '', cascata_valor: '',
                crepe: '', crepe_valor: '',
                salgado: '', salgado_valor: '',
                buffet: '', buffet_valor: '',
                maitre: '', maitre_valor: '',
                porteiro: '', porteiro_valor: '',
                montagem: '', montagem_valor: '',
                taca: '', taca_valor: '',
                cumbuca: '', cumbuca_valor: '',
                prataria: '', prataria_valor: '',
                louca_sobremesa: '', louca_sobremesa_valor: '',
                cestinha: '', cestinha_valor: '',
                garcom: '', garcom_valor: '',
                cozinheiro: '', cozinheiro_valor: '',
                bar: '', bar_valor: '',
                ajudante_cozinha: '', ajudante_cozinha_valor: '',
                entrada: '', cardapio: ''
            }),


            salgado: false,
            buffet: false,
            maitre: false,
            porteiro: false,
            montagem: false,
            taca: false,
            cumbuca: false,
            prataria: false,
            louca_sobremesa: false,
            cestinha: false,
            garcom: false,
            cozinheiro: false,
            bar: false,
            ajudante_cozinha: false,
            cascata: false,
            crepe: false,
        }
    },

    methods: {
        enviarCliente() {
            this.formCliente.post(route('admin.cliente.create'), {
                onSuccess: () => {
                    this.clienteCadastrado = true;
                    this.formEvento.nome_cliente = this.formCliente.nome;
                    this.tituloAtual = 'Evento'
                }
            })
        },

        enviarEvento() {
            this.formEvento.post(route('admin.evento.create'), {
                onSuccess: () => { this.eventoCadastrado = true; this.tituloAtual = 'Complementos' }
            })
        },

        enviarComplemento() {
            this.formComplementos.post(route('admin.complemento.create'))
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
                        </div>
                        <div class="relative my-5">
                            <label for="telefone" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Telefone Principal</label>
                            <TextInput type="tel" class="w-full" id="telefone" v-model="formCliente.telefone" />
                        </div>
                        <div class="relative my-5">
                            <label for="telefone_backup" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Telefone Secundário</label>
                            <TextInput type="tel" class="w-full" id="telefone_backup" v-model="formCliente.telefone_2" />
                        </div>
                        <div class="relative my-5">
                            <label for="endereco" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Endereço (CEP e Logradouro)</label>
                            <TextInput type="text" class="w-full" id="endereco" v-model="formCliente.endereco" />
                        </div>
                        <div class="relative my-5">
                            <label for="cpf" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">CPF/CNPJ</label>
                            <TextInput type="text" class="w-full" id="cpf" v-model="formCliente.cpf" />
                        </div>
                        <div class="relative my-5">
                            <label for="rg" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">RG</label>
                            <TextInput type="text" class="w-full" id="rg" v-model="formCliente.rg" />
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
                        </div>
                        <input type="hidden" :value="formEvento.cpf_cliente" />
                        <div class="relative my-5">
                            <label for="tipo" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Tipo do evento</label>
                            <select class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500" id="tipo" v-model="formEvento.tipo">
                                <option value="" selected disabled>Selecione uma opção</option>
                                <option v-for="(tipo, chave) in tipos" :value="chave">{{ tipo }}</option>
                            </select>
                        </div>
                        <div class="relative my-5">
                            <label for="data" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Data e hora de início</label>
                            <TextInput type="datetime-local" class="w-full" id="data" v-model="formEvento.dia" />
                        </div>
                        <div class="relative my-5">
                            <label for="duracao" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Duração (em horas)</label>
                            <TextInput type="number" class="w-full" id="duracao" v-model="formEvento.duracao" />
                        </div>
                        <div class="relative my-5">
                            <label for="local" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Local do evento (Endereço)</label>
                            <TextInput type="text" class="w-full" id="local" v-model="formEvento.local" />
                        </div>
                        <div class="relative my-5">
                            <label for="convidados" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Nº de Convidados</label>
                            <TextInput type="number" class="w-full" id="convidados" v-model="formEvento.numero_convidados" />
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
                <!-- Formulário de complementos -->
                <form @submit.prevent="enviarComplemento" v-show="eventoCadastrado">
                    <div class="text-xs">
                        <!-- Informações do cliente -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="relative my-5">
                                <label for="nome_cliente" class="absolute top-[-10px] left-[10px] z-index-20 bg-none">Cliente</label>
                                <TextInput type="text" class="w-full bg-gray-300" id="nome_cliente" :value="formCliente.nome" disabled />
                            </div>
                            <div class="relative my-5">
                                <label for="tipo" class="absolute top-[-10px] left-[10px] z-index-20 bg-none">Tipo do evento</label>
                                <select class="w-full bg-gray-300 border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500" id="tipo" v-model="formEvento.tipo" disabled>
                                    <option value="" selected disabled>Selecione uma opção</option>
                                    <option v-for="(tipo, chave) in tipos" :value="chave">{{ tipo }}</option>
                                </select>
                            </div>
                        </div>
                        <!-- Campos do formulário -->
                        <!-- Checkbox -> Quantidade -> Valor -->
                        <!-- Somente liberar o campo de quantidade e valor se a checkbox estiver marcada -->
                        <div class="grid grid-cols-3 gap-3 text-center items-center text-sm">
                            <!-- Título colunas -->
                            <span></span>
                            <span class="font-bold">Quantidade</span>
                            <span class="font-bold">Valor</span>
                            <!-- Início de complementos -->
                            <!-- Cascata -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="cascata" @click="console.log(cascata)"/>
                                </div>
                                <span>Cascata</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="cascata" v-model="formComplemento.cascata" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="cascata" v-model="formComplemento.cascata_valor" />
                            <!-- Crepe -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="crepe"/>
                                </div>
                                <span>Crepe</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="crepe" v-model="formComplemento.crepe" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="crepe" v-model="formComplemento.crepe_valor" />
                            <!-- Salgado -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="salgado"/>
                                </div>
                                <span>Salgado</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="salgado" v-model="formComplemento.salgado" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="salgado" v-model="formComplemento.salgado_valor" />
                            <!-- Buffet -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="buffet"/>
                                </div>
                                <span>Buffet</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="buffet" v-model="formComplemento.buffet" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="buffet" v-model="formComplemento.buffet_valor" />
                            <!-- Maitre -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="maitre"/>
                                </div>
                                <span>Maitre</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="maitre" v-model="formComplemento.maitre" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="maitre" v-model="formComplemento.maitre_valor" />
                            <!-- Proteiro -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="porteiro"/>
                                </div>
                                <span>Porteiro</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="porteiro" v-model="formComplemento.porteiro" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="porteiro" v-model="formComplemento.porteiro_valor" />
                            <!-- Montagem -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="montagem"/>
                                </div>
                                <span>Montagem</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="montagem" v-model="formComplemento.montagem" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="montagem" v-model="formComplemento.montagem_valor" />
                            <!-- Taças -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="taca"/>
                                </div>
                                <span>Taças</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="taca" v-model="formComplemento.taca" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="taca" v-model="formComplemento.taca_valor" />
                            <!-- Cumbuquinhas -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="cumbuca"/>
                                </div>
                                <span>Cumbuquinhas</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="cumbuca" v-model="formComplemento.cumbuca" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="cumbuca" v-model="formComplemento.cumbuca_valor" />
                            <!-- Prataria -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="prataria"/>
                                </div>
                                <span>Prataria (Pratos e talheres)</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="prataria" v-model="formComplemento.prataria" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="prataria" v-model="formComplemento.prataria_valor" />
                            <!-- Louça de Sobremesa -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="louca_sobremesa"/>
                                </div>
                                <span>Louça de Sobremesa</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="louca_sobremesa" v-model="formComplemento.louca_sobremesa" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="louca_sobremesa" v-model="formComplemento.louca_sobremesa_valor" />
                            <!-- Cestinhas -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="cestinha"/>
                                </div>
                                <span>Cestinhas</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="cestinha" v-model="formComplemento.cestinha" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="cestinha" v-model="formComplemento.cestinha_valor" />
                            <!-- Garçons -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="garcom"/>
                                </div>
                                <span>Garçons</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="garcom" v-model="formComplemento.garcom" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="garcom" v-model="formComplemento.garcom_valor" />
                            <!-- Cozinheiro -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="cozinheiro"/>
                                </div>
                                <span>Cozinheiro</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="cozinheiro" v-model="formComplemento.cozinheiro" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="cozinheiro" v-model="formComplemento.cozinheiro_valor" />
                            <!-- Ajudante de Cozinha -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="ajudante_cozinha"/>
                                </div>
                                <span>Ajudante de Cozinha</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="ajudante_cozinha" v-model="formComplemento.ajudante_cozinha" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="ajudante_cozinha" v-model="formComplemento.ajudante_cozinha_valor" />
                            <!-- Bar -->
                            <div class="grid grid-cols-2 font-bold">
                                <div class="text-center">
                                    <input type="checkbox" v-model="bar"/>
                                </div>
                                <span>Serviço de bar</span>
                            </div>
                            <ConditionalInput type="number" placeholder="Quantidade" :ativo="bar" v-model="formComplemento.bar" />
                            <ConditionalInput type="number" placeholder="Valor" :ativo="bar" v-model="formComplemento.bar_valor" />
                        </div>
                        <!-- Entrada e Cardápio-->
                        <div class="grid grid-cols-2 gap-5">
                            <div class="relative my-5">
                                <label for="entrada" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Entradas</label>
                                <textarea class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 h-16" id="entrada" v-model="formComplemento.entrada"></textarea>
                            </div>
                            <div class="relative my-5">
                                <label for="cardapio" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Cardápio</label>
                                <textarea class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 h-16" id="cardapio" v-model="formComplemento.cardapio"></textarea>
                            </div>
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
