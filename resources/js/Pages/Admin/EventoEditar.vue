<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import ConditionalButton from '@/Components/ConditionalButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ConditionalInput from '@/Components/ConditionalInput.vue';
import Swal from 'sweetalert2';

export default {
    props: ['evento', 'servicos', 'tipo', 'funcionarios', 'funcionariosAtivos'],

    components: {
        LayoutAdministrativo,
        PrimaryButton,
        ConditionalButton,
        TextInput,
        ConditionalInput,
    },

    data() {
        return {
            formEditarEvento: this.$inertia.form({
                tipo: this.evento.tipo,
                dia: this.evento.data,
                duracao: this.evento.duracao,
                local: this.evento.local,
                observacao: this.evento.observacao,
                numero_convidados: this.evento.numero_convidados,
            }),

            // Variável que controla o status do botão de Adicionar/Remover serviços
            // [0, 0, 0, ...]
            statusBotaoServico: Array(this.servicos.length).fill(0),

            // Variável que observa os valores de cada serviço
            // [100, 200, 150, ...]
            valores: Array(this.servicos.length).fill(0),

            // Serviços selecionados
            // [{id: servico.id, quantidade: n, valor: servico.valor * n}]
            formEditarServicos: this.$inertia.form({
                servicosEscolhidos: [],
                evento_id: this.evento.id
            }),

            // Funcionarios selecionados
            // [{}]
            formEditarEquipe: this.$inertia.form({
                equipeEscolhida: [],
                evento_id: this.evento.id
            })
        }
    },

    methods: {
        enviarEditarEvento() {
            this.formEditarEvento.put(route('admin.evento.update', this.evento.id), {
                onSuccess: () => this.$swal('Edição salva!', '', 'success')
            })
        },
        enviarEditarServicos() {
            this.formEditarServicos.put(route('admin.complemento.update'), {
                onSuccess: () => this.$swal('Edição salva!', '', 'success')
            })
        },
        enviarEditarEquipe() {
            this.formEditarEquipe.put(route('admin.equipe.update'), {
                onSuccess: () => this.$swal('Edição salva!', '', 'success')
            })
        },

        async adicionarServico(servico) {
            // Verificar se o serviço foi adicionado
            let id = -1
            for(let i = 0; i < this.formEditarServicos.servicosEscolhidos.length; i++) {
                if (this.formEditarServicos.servicosEscolhidos[i].id == servico.id) {
                    id = i
                    break
                }
            }
            // Remover o serviço se já tiver sido adicionado
            if(id > -1) {
                this.formEditarServicos.servicosEscolhidos.splice(id, 1)
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
            this.formEditarServicos.servicosEscolhidos.push(servicoEscolhido)
        },

        removerFuncionario(funcionario_id) {
            for(let i = 0; i < this.formEditarEquipe.equipeEscolhida.length; i++) {
                if(this.formEditarEquipe.equipeEscolhida[i].funcionario_id == funcionario_id) {
                    this.formEditarEquipe.equipeEscolhida.splice(i, 1)
                }
            }
        }
    },

    mounted() {
        for(let i = 0; i < this.servicos.length; i++) {
            this.valores[i] = this.servicos[i].valor
        }

        // Inicializando array de servicosEscolhidos com os serviços já escolhidos originalmente
        // isso impede que os dados sumam ao apertar no botão "EDITAR" sem realizar alterações
        this.evento.servicos.forEach((value) => {
            this.statusBotaoServico[value.servico_id - 1] = 1
            this.valores[value.servico_id - 1] = value.valor / value.quantidade
            this.formEditarServicos.servicosEscolhidos.push({
                id: value.servico_id,
                quantidade: value.quantidade,
                valor: this.valores[value.servico_id - 1] * value.quantidade
            })
        })


        // Inicializando array de servicosEscolhidos com os serviços já escolhidos originalmente
        // isso impede que os dados sumam ao apertar no botão "EDITAR" sem realizar alterações
        this.evento.equipes.forEach((value) => {
            this.formEditarEquipe.equipeEscolhida.push({
                evento_id: this.evento.id,
                funcionario_id: value.funcionario_id,
                funcao: value.funcao
            })
        })
    }
}
</script>

<template>
    <LayoutAdministrativo>
        <div class="shadow-xl bg-white p-5 mx-40 mt-24 max-h-[700px] overflow-auto">
            <!-- Header -->
            <div class="flex justify-between text-center font-bold text-xl">
                <h2>Edição: {{ tipo[evento.tipo] }} - {{ evento.cliente.nome }}</h2>
                <PrimaryButton @click="$inertia.get(route('admin.evento.unico', evento.id))">Voltar</PrimaryButton>
            </div>

            <hr class="my-2 border-yellow-400"/>
            <!-- Conteúdo de edição de evento -->
            <div>
                <div class="text-center text-md">
                    <h2 class=" font-bold">Evento</h2>
                    <hr class="m-auto w-5/12 border-yellow-400 mb-3"/>
                    <form @submit.prevent="enviarEditarEvento">
                        <div class="grid grid-cols-2 gap-4 text-xs p-5">
                            <div class="relative">
                                <label for="convidados" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Convidados</label>
                                <TextInput type="text" class="w-full" id="convidados" v-model="formEditarEvento.numero_convidados" />
                            </div>
                            <div class="relative">
                                <label for="data" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Data</label>
                                <TextInput type="datetime-local" class="w-full" id="data" v-model="formEditarEvento.dia" />
                            </div>
                            <div class="relative">
                                <label for="horario" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Duração</label>
                                <TextInput type="number" class="w-full" id="horario" v-model="formEditarEvento.duracao" />
                            </div>
                            <div class="relative">
                                <label for="local" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Endereço</label>
                                <TextInput type="text" class="w-full" id="local" v-model="formEditarEvento.local" />
                            </div>
                        </div>
                        <div class="p-5">
                            <p class="text-xs">Observação:</p>
                            <textarea id="observacao" class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500" v-model="formEditarEvento.observacao" />
                        </div>
                        <div class="flex flex-row-reverse pr-5">
                            <PrimaryButton type="submit">Editar Evento</PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Conteúdo de edição de complementos -->
            <div>
                <div class="text-center font-bold text-md">
                    <h2>Complementos</h2>
                    <hr class="m-auto w-5/12 border-yellow-400"/>
                </div>
                <!-- Listagem de edição de complementos -->
                <form @submit.prevent="enviarEditarServicos">
                    <!-- Títulos -->
                    <div class="grid grid-cols-3 gap-2 font-bold text-xl p-2 text-center mb-4">
                        <p></p>
                        <p>Serviço</p>
                        <p>Valor (und)</p>
                    </div>
                    <div v-for="servico in servicos">
                        <div class="grid grid-cols-3 gap-2 font-bold p-2 text-center p-5">
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
            </div>
            <!-- Conteúdo de edição de equipe -->
            <div>
                <div class="text-center font-bold text-md">
                    <h2>Equipe</h2>
                    <hr class="m-auto w-5/12 border-yellow-400">
                </div>
                <form @submit.prevent="enviarEditarEquipe">
                    <!-- Títulos -->
                    <div class="grid grid-cols-3 gap-2 font-bold text-xl p-2 text-center mb-4">
                        <div>
                            <PrimaryButton type="button" @click="adicionarFuncionario">Adicionar Funcionário</PrimaryButton>
                        </div>
                        <p>Nome</p>
                        <p>Função</p>
                    </div>
                    <div v-for="funcionario in formEditarEquipe.equipeEscolhida">
                        <div class="grid grid-cols-3 gap-2 font-bold p-2 text-center p-5">
                            <div class="">
                                <PrimaryButton type="button" @click="removerFuncionario(funcionario.funcionario_id)">
                                    Remover
                                </PrimaryButton>
                            </div>
                            <p>{{ funcionarios[funcionario.funcionario_id - 1].nome }}</p>
                            <p>{{ funcionario.funcao }}</p>
                        </div>
                    </div>
                    <!-- Cadastrar -->
                    <div class="flex flex-row-reverse gap-5 p-5">
                        <PrimaryButton type="submit">Cadastrar</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </LayoutAdministrativo>
</template>
