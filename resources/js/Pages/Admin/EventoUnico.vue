<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';
import ConditionalButton from '@/Components/ConditionalButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ConditionalInput from '@/Components/ConditionalInput.vue';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import OptionConditional from '@/Components/OptionConditional.vue';
import Swal from 'sweetalert2';

import { router } from '@inertiajs/vue3';
import { defineAsyncComponent } from 'vue'


export default {
    props: ['evento', 'servicos', 'tipo', 'funcionarios', 'funcionariosAtivos'],

    components: {
        LayoutAdministrativo,
        ConditionalButton,
        PrimaryButton,
        ConditionalInput,
        Modal,
        InputError,
        TextInput,
        OptionConditional
    },

    data() {
        return {
            complementoModal: false,
            equipeModal: false,

            // ------------------ Variáveis relacionadas a serviço ---------------- //
            // Variável que controla o status do botão de Adicionar/Remover serviços
            // [0, 0, 0, ...]
            statusBotaoServico: Array(this.servicos.length).fill(0),

            // Variável que observa os valores de cada serviço
            // [100, 200, 150, ...]
            valores: Array(this.servicos.length).fill(0),

            // Serviços selecionados
            // [{id: servico.id, quantidade: n, valor: servico.valor * n}]
            form: this.$inertia.form({
                servicosEscolhidos: [],
                evento_id: this.evento.id
            }),
            // ------------------ Variáveis relacionadas a equipe ---------------- //
            cargo: '',
            funcionarioAtual: 'Escolha um funcionário',

            // Funcionários selecionados
            // [{id: funcionario.id, nome: funcionario.nome, funcao: n}]
            formEquipe: this.$inertia.form({
                funcionariosEscolhidos: [],
                evento_id: this.evento.id
            }),

            desconto: {
                valorDesconto: 0,
            },
        }
    },

    methods: {
        enviarServicos() {
            this.form.post(route('admin.complemento.create'), {
                onSuccess: () => this.complementoModal = false
            })
        },

        enviarEquipe() {
            this.formEquipe.post(route('admin.equipe.create'), {
                onSuccess: () => Swal.fire('Funcionários adicionados!', '', 'success').then(() => this.equipeModal = false)
            })
        },

        funcionarioExiste(funcionario) {
            for(let i = 0; i < this.formEquipe.funcionariosEscolhidos.length; i++) {
                if (this.formEquipe.funcionariosEscolhidos[i].id == funcionario.id) {
                    return true
                }
            }
            return false
        },

        adicionarFuncionario() {
            if(this.funcionarioAtual != 'Escolha um funcionário' && this.cargo != '') {
                this.formEquipe.funcionariosEscolhidos.push({
                    id: this.funcionarioAtual.id,
                    nome: this.funcionarioAtual.nome,
                    funcao: this.cargo
                })

                this.funcionarioAtual = 'Escolha um funcionário'
                return
            } else {
                Swal.fire({
                    title: 'Selecione um cargo e um funcionário antes de adicionar',
                    icon: 'warning',
                })
            }
        },

        async adicionarServico(servico) {
            // Verificar se o serviço foi adicionado
            let id = -1
            for(let i = 0; i < this.form.servicosEscolhidos.length; i++) {
                if (this.form.servicosEscolhidos[i].id == servico.id) {
                    id = i
                    break
                }
            }
            // Remover o serviço se já tiver sido adicionado
            if(id > -1) {
                this.form.servicosEscolhidos.splice(id, 1)
                this.statusBotaoServico[servico.id - 1] = 0

                return
            }

            // Verificar se o valor foi informado
            if(this.valores[servico.id - 1] < 1) {
                Swal.fire({
                    title: 'Informe o valor antes de adicionar o serviço',
                    icon: 'warning',
                })

                return
            }


            // Incluir serviço se não existir no array
            // Alert de solicitar quantidade
            const { value: quantidade } = await Swal.fire({
                title: "Informe a quantidade do serviço",
                input: "number",
                inputLabel: "Quantidade",
                showCancelButton: false,
                allowOutsideClick: false,
                inputValidator: (value) => {
                    if (!value) {
                        return "É obrigatório informar a quantidade!";
                    }
                }
            })

            // Alterar situação do botão específico desse serviço
            this.statusBotaoServico[servico.id - 1] = 1

            // Criar objeto de serviço escolhido
            let servicoEscolhido = {
                id: servico.id,
                quantidade: quantidade,
                valor: this.valores[servico.id - 1] * quantidade
            }
            // Incluir objeto em array
            this.form.servicosEscolhidos.push(servicoEscolhido)
        },

        async pegarDesconto() {
            const { value: desconto } = await Swal.fire({
                title: "Defina o desconto",
                input: "number",
                inputLabel: "Desconto",
                showCancelButton: false,
                allowOutsideClick: false,
                inputValidator: (value) => {
                    if (!value) {
                        return "É obrigatório informar o desconto!";
                    }
                }
            })

            this.desconto.valorDesconto = desconto;
        }
    },

    computed: {
        contrato() {
            return this.evento.complemento ? 'Gerar contrato' : 'Insira serviços antes de gerar o contrato'
        },
    },

    mounted() {
        // Inicializar variável dos serviços
        this.servicos.forEach(servico => {
            this.valores[servico.id - 1] = servico.valor
        })
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
                    <div v-if="evento.servicos.length">
                        <PrimaryButton @click="$inertia.get(route('admin.evento.editar', evento.id))">Editar</PrimaryButton>
                    </div>
                    <div v-if="evento.servicos.length">
                        <a :href="route('admin.evento.contrato', evento.id, desconto)" @click="pegarDesconto">Gerar Contrato</a>
                    </div>
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
                <!-- Serviços -->
                <div class="text-center">
                    <div class="font-bold text-xl p-4">
                        <span>Serviços</span>
                        <hr class="w-3/12 m-auto border-yellow-400" />
                    </div>
                    <!-- Mostrar serviços se evento já possuir serviços cadastrados -->
                    <div v-if="evento.servicos.length">
                        <div class="grid grid-cols-4 gap-2 font-bold p-2">
                            <p>Serviço</p>
                            <p>Quantidade</p>
                            <p>Valor Unitário</p>
                            <p>Total</p>
                        </div>
                        <div></div>
                        <div v-for="(chave, valor) in evento.servicos" class="grid grid-cols-4 gap-2">
                            <p v-if="evento.servicos[valor] !== null">{{ servicos[chave.servico_id - 1].nome }}</p>
                            <p v-if="evento.servicos[valor] !== null">{{ chave.quantidade }}</p>
                            <p v-if="evento.servicos[valor] !== null">R$ {{ chave.valor / chave.quantidade }},00</p>
                            <p v-if="evento.servicos[valor] !== null">R$ {{ chave.valor }},00</p>
                        </div>
                    </div>
                    <!-- Mostrar opção de cadastrar serviços se evento não já possuir -->
                    <div v-else>
                        <p class="p-2 mb-3">Esse evento ainda não possui serviços cadastrados :(</p>
                        <PrimaryButton @click="complementoModal = true">Cadastrar</PrimaryButton>
                    </div>
                </div>
                <!-- Informação de equipe -->
                <div class="text-center">
                    <div class="font-bold text-xl p-4">
                        <span>Equipe</span>
                        <hr class="w-3/12 m-auto border-yellow-400" />
                    </div>
                    <!-- Listagem de equipe se existir e já cadastrada -->
                    <div v-if="evento.equipes.length" class="p-2">
                        <div class="grid grid-cols-2 font-bold text-xl">
                            <p>Nome</p>
                            <p>Função</p>
                        </div>
                        <div v-for="equipe in evento.equipes" class="grid grid-cols-2">
                            <p>{{ funcionarios[equipe.funcionario_id - 1].nome }}</p>
                            <p>{{ equipe.funcao }}</p>
                        </div>
                    </div>
                    <!-- Opção de cadastrar equipe se não existir -->
                    <div v-else class="p-2">
                        <p class="p-2 mb-3">Esse evento ainda não possui equipe cadastrada :(</p>
                        <PrimaryButton @click="equipeModal = true">Cadastrar</PrimaryButton>
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
            <!-- Serviços -->
            <form @submit.prevent="enviarServicos" class="p-5">
                <!-- Títulos -->
                <div class="grid grid-cols-3 gap-2 font-bold text-xl p-2 text-center mb-4">
                    <p></p>
                    <p>Serviço</p>
                    <p>Valor (und)</p>
                </div>
                <div v-for="servico in servicos">
                    <div class="grid grid-cols-3 gap-2 font-bold p-2 text-center">
                        <div class="">
                            <ConditionalButton :disabled="false" :class="statusBotaoServico[servico.id - 1] ? 'bg-gray-400' : ''" @click="adicionarServico(servico)">
                                {{ statusBotaoServico[servico.id - 1] ? 'Remover' : 'Adicionar' }}
                            </ConditionalButton>
                        </div>
                        <p>{{ servico.nome }}</p>
                        <TextInput type="number" v-model="valores[servico.id - 1]" :placeholder="servico.valor + ',00'" />
                    </div>
                </div>
                <!-- Cadastrar -->
                <div class="flex flex-row-reverse gap-5 p-5">
                    <PrimaryButton type="submit">Cadastrar</PrimaryButton>
                </div>
            </form>
        </Modal>
        <!-- Modal para cadastro de equipe -->
        <Modal :show="equipeModal" @close="equipeModal = false" maxWidth="5xl">
            <div class="text-center">
                <h3 class="font-bold text-2xl p-4">Cadastrar Equipe</h3>
                <hr class="border-yellow-400 w-10/12 m-auto" />
            </div>
            <form @submit.prevent="enviarEquipe" class="p-5">
                <div class="text-center">
                    <p>Selecione o funcionário e em seguida informe sua função</p>
                    <select class="w-5/12 border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500" id="funcionarios" v-model="funcionarioAtual">
                        <OptionConditional selected disabled>Escolha um funcionário</OptionConditional>
                        <OptionConditional v-for="funcionario in funcionariosAtivos" :value="funcionario"
                        :disabled="funcionarioExiste(funcionario)">
                        {{ funcionario.nome }}
                        </OptionConditional>
                    </select>
                    <TextInput type="text" class="w-5/12 ml-5" v-model="cargo" placeholder="Cargo" />
                </div>

                <div class="text-center p-5">
                    <PrimaryButton type="button" @click="adicionarFuncionario">Adicionar</PrimaryButton>
                </div>

                <!-- Listagem de funcionarios escolhidos até o momento -->
                <div v-show="formEquipe.funcionariosEscolhidos.length > 0">
                    <div class="grid grid-cols-2 text-center">
                        <p class="font-bold text-xl">Funcionário</p>
                        <p class="font-bold text-xl">Cargo</p>
                    </div>

                    <div v-for="funcionario in formEquipe.funcionariosEscolhidos" class="grid grid-cols-2 text-center">
                        <p>{{ funcionario.nome }}</p>
                        <p>{{ funcionario.funcao }}</p>
                    </div>
                </div>

                <!-- Cadastrar -->
                <div class="flex flex-row-reverse gap-5 p-5">
                    <PrimaryButton type="submit">Registrar</PrimaryButton>
                </div>
            </form>
        </Modal>
    </LayoutAdministrativo>
</template>
