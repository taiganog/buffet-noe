<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';
import ConditionalButton from '@/Components/ConditionalButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ConditionalInput from '@/Components/ConditionalInput.vue';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';

import { router } from '@inertiajs/vue3';

export default {
    props: ['evento', 'complementos', 'tipo'],

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
                cascata: null, cascata_valor: null,
                crepe: null, crepe_valor: null,
                salgado: null, salgado_valor: null,
                buffet: null, buffet_valor: null,
                maitre: null, maitre_valor: null,
                porteiro: null, porteiro_valor: null,
                montagem: null, montagem_valor: null,
                taca: null, taca_valor: null,
                cumbuca: null, cumbuca_valor: null,
                prataria: null, prataria_valor: null,
                louca_sobremesa: null, louca_sobremesa_valor: null,
                cestinha: null, cestinha_valor: null,
                garcom: null, garcom_valor: null,
                cozinheiro: null, cozinheiro_valor: null,
                bar: null, bar_valor: null,
                ajudante_cozinha: null, ajudante_cozinha_valor: null,
                entrada: null, cardapio: null,
                evento_id: this.evento.id
            }),

            // Valor checkboxes
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
                <div class="grid grid-cols-3 gap-3 text-center items-center text-sm p-3">
                    <!-- Título colunas -->
                    <span></span>
                    <span class="font-bold">Quantidade</span>
                    <span class="font-bold">Valor em reais</span>
                    <!-- Início de complementos -->
                    <!-- Cascata -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="cascata" />
                        </div>
                        <span>Cascata (máquina)</span>
                    </div>
                    <ConditionalInput type="text" placeholder="Quantidade" :ativo="cascata" v-model="formComplemento.cascata" />
                    <ConditionalInput type="text" placeholder="Valor" :ativo="cascata" v-model="formComplemento.cascata_valor" />
                    <!-- Crepe -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="crepe"/>
                        </div>
                        <span>Crepe (máquina)</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="crepe" v-model="formComplemento.crepe" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="crepe" v-model="formComplemento.crepe_valor" />
                    <!-- Salgado -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="salgado"/>
                        </div>
                        <span>Salgado (fritadeira)</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="salgado" v-model="formComplemento.salgado" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="salgado" v-model="formComplemento.salgado_valor" />
                    <!-- Buffet -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="buffet"/>
                        </div>
                        <span>Réchaud</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="buffet" v-model="formComplemento.buffet" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="buffet" v-model="formComplemento.buffet_valor" />
                    <!-- Maitre -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="maitre"/>
                        </div>
                        <span>Maitre e/ou Cerimonialista</span>
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
                        <span>Prataria (pratos e talheres)</span>
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
                <div class="grid grid-cols-2 gap-5 p-5">
                    <div class="relative my-5">
                        <label for="entrada" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Entradas</label>
                        <textarea class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 h-16" id="entrada" v-model="formComplemento.entrada"></textarea>
                        <InputError :message="formComplemento.errors.entrada" class="mt-2" />
                    </div>
                    <div class="relative my-5">
                        <label for="cardapio" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Cardápio</label>
                        <textarea class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 h-16" id="cardapio" v-model="formComplemento.cardapio"></textarea>
                        <InputError :message="formComplemento.errors.cardapio" class="mt-2" />
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
