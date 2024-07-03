<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue';
import ConditionalInput from '@/Components/ConditionalInput.vue';

export default {
    props: ['evento', 'complementos', 'tipo'],

    components: {
        LayoutAdministrativo,
        PrimaryButton,
        TextInput,
        ConditionalInput
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

            formEditarComplemento: this.$inertia.form({
                cascata: this.evento.complemento.cascata,
                cascata_valor: this.evento.valor.cascata,

                crepe: this.evento.complemento.crepe,
                crepe_valor: this.evento.valor.crepe,

                salgado: this.evento.complemento.salgado,
                salgado_valor: this.evento.valor.salgado,

                buffet: this.evento.complemento.buffet,
                buffet_valor: this.evento.valor.buffet,

                maitre: this.evento.complemento.maitre,
                maitre_valor: this.evento.valor.maitre,

                porteiro: this.evento.complemento.porteiro,
                porteiro_valor: this.evento.valor.porteiro,

                montagem: this.evento.complemento.montagem,
                montagem_valor: this.evento.valor.montagem,

                taca: this.evento.complemento.taca,
                taca_valor: this.evento.valor.taca,

                cumbuca: this.evento.complemento.cumbuca,
                cumbuca_valor: this.evento.valor.cumbuca,

                prataria: this.evento.complemento.prataria,
                prataria_valor: this.evento.valor.prataria,

                louca_sobremesa: this.evento.complemento.louca_sobremesa,
                louca_sobremesa_valor: this.evento.valor.louca_sobremesa,

                cestinha: this.evento.complemento.cestinha,
                cestinha_valor: this.evento.valor.cestinha,

                garcom: this.evento.complemento.garcom,
                garcom_valor: this.evento.valor.garcom,

                cozinheiro: this.evento.complemento.cozinheiro,
                cozinheiro_valor: this.evento.valor.cozinheiro,

                bar: this.evento.complemento.bar,
                bar_valor: this.evento.valor.bar,

                ajudante_cozinha: this.evento.complemento.ajudante_cozinha,
                ajudante_cozinha_valor: this.evento.valor.ajudante_cozinha,

                entrada: this.evento.complemento.entradas,
                cardapio: this.evento.complemento.cardapio,

                evento_id: this.evento.id
            }),

            // Valor checkboxes
            salgado: this.evento.complemento.salgado ? true : false,
            buffet: this.evento.complemento.buffet ? true : false,
            maitre: this.evento.complemento.maitre ? true : false,
            porteiro: this.evento.complemento.porteiro ? true : false,
            montagem: this.evento.complemento.montagem ? true : false,
            taca: this.evento.complemento.taca ? true : false,
            cumbuca: this.evento.complemento.cumbuca ? true : false,
            prataria: this.evento.complemento.prataria ? true : false,
            louca_sobremesa: this.evento.complemento.louca_sobremesa ? true : false,
            cestinha: this.evento.complemento.cestinha ? true : false,
            garcom: this.evento.complemento.garcom ? true : false,
            cozinheiro: this.evento.complemento.cozinheiro ? true : false,
            bar: this.evento.complemento.bar ? true : false,
            ajudante_cozinha: this.evento.complemento.ajudante_cozinha ? true : false,
            cascata: this.evento.complemento.cascata ? true : false,
            crepe: this.evento.complemento.crepe ? true : false,
        }
    },

    methods: {
        enviarEditarEvento() {
            this.formEditarEvento.put(route('admin.evento.update', this.evento.id), {
                onSuccess: () => this.$swal('Edição salva!', '', 'success')
            })
        },
        enviarEditarComplemento() {
            this.formEditarComplemento.put(route('admin.complemento.editar', this.evento.id))
        }
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
                            <textarea id="observacao" class="w-full" v-model="formEditarEvento.observacao" />
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
                <form @submit.prevent="enviarEditarComplemento">
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
                    <ConditionalInput type="text" placeholder="Quantidade" :ativo="cascata" v-model="formEditarComplemento.cascata" />
                    <ConditionalInput type="text" placeholder="Valor" :ativo="cascata" v-model="formEditarComplemento.cascata_valor" />
                    <!-- Crepe -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="crepe"/>
                        </div>
                        <span>Crepe (máquina)</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="crepe" v-model="formEditarComplemento.crepe" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="crepe" v-model="formEditarComplemento.crepe_valor" />
                    <!-- Salgado -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="salgado"/>
                        </div>
                        <span>Salgado (fritadeira)</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="salgado" v-model="formEditarComplemento.salgado" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="salgado" v-model="formEditarComplemento.salgado_valor" />
                    <!-- Buffet -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="buffet"/>
                        </div>
                        <span>Réchaud</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="buffet" v-model="formEditarComplemento.buffet" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="buffet" v-model="formEditarComplemento.buffet_valor" />
                    <!-- Maitre -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="maitre"/>
                        </div>
                        <span>Maitre e/ou Cerimonialista</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="maitre" v-model="formEditarComplemento.maitre" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="maitre" v-model="formEditarComplemento.maitre_valor" />
                    <!-- Proteiro -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="porteiro"/>
                        </div>
                        <span>Porteiro</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="porteiro" v-model="formEditarComplemento.porteiro" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="porteiro" v-model="formEditarComplemento.porteiro_valor" />
                    <!-- Montagem -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="montagem"/>
                        </div>
                        <span>Montagem</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="montagem" v-model="formEditarComplemento.montagem" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="montagem" v-model="formEditarComplemento.montagem_valor" />
                    <!-- Taças -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="taca"/>
                        </div>
                        <span>Taças</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="taca" v-model="formEditarComplemento.taca" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="taca" v-model="formEditarComplemento.taca_valor" />
                    <!-- Cumbuquinhas -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="cumbuca"/>
                        </div>
                        <span>Cumbuquinhas</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="cumbuca" v-model="formEditarComplemento.cumbuca" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="cumbuca" v-model="formEditarComplemento.cumbuca_valor" />
                    <!-- Prataria -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="prataria"/>
                        </div>
                        <span>Prataria (pratos e talheres)</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="prataria" v-model="formEditarComplemento.prataria" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="prataria" v-model="formEditarComplemento.prataria_valor" />
                    <!-- Louça de Sobremesa -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="louca_sobremesa"/>
                        </div>
                        <span>Louça de Sobremesa</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="louca_sobremesa" v-model="formEditarComplemento.louca_sobremesa" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="louca_sobremesa" v-model="formEditarComplemento.louca_sobremesa_valor" />
                    <!-- Cestinhas -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="cestinha"/>
                        </div>
                        <span>Cestinhas</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="cestinha" v-model="formEditarComplemento.cestinha" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="cestinha" v-model="formEditarComplemento.cestinha_valor" />
                    <!-- Garçons -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="garcom"/>
                        </div>
                        <span>Garçons</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="garcom" v-model="formEditarComplemento.garcom" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="garcom" v-model="formEditarComplemento.garcom_valor" />
                    <!-- Cozinheiro -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="cozinheiro"/>
                        </div>
                        <span>Cozinheiro</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="cozinheiro" v-model="formEditarComplemento.cozinheiro" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="cozinheiro" v-model="formEditarComplemento.cozinheiro_valor" />
                    <!-- Ajudante de Cozinha -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="ajudante_cozinha"/>
                        </div>
                        <span>Ajudante de Cozinha</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="ajudante_cozinha" v-model="formEditarComplemento.ajudante_cozinha" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="ajudante_cozinha" v-model="formEditarComplemento.ajudante_cozinha_valor" />
                    <!-- Bar -->
                    <div class="grid grid-cols-2 font-bold">
                        <div class="text-center">
                            <input type="checkbox" v-model="bar"/>
                        </div>
                        <span>Serviço de bar</span>
                    </div>
                    <ConditionalInput type="number" placeholder="Quantidade" :ativo="bar" v-model="formEditarComplemento.bar" />
                    <ConditionalInput type="number" placeholder="Valor" :ativo="bar" v-model="formEditarComplemento.bar_valor" />
                </div>
                <!-- Entrada e Cardápio-->
                <div class="grid grid-cols-2 gap-5 p-5">
                    <div class="relative my-5">
                        <label for="entrada" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Entradas</label>
                        <textarea class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 h-16" id="entrada" v-model="formEditarComplemento.entrada"></textarea>
                    </div>
                    <div class="relative my-5">
                        <label for="cardapio" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Cardápio</label>
                        <textarea class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 h-16" id="cardapio" v-model="formEditarComplemento.cardapio"></textarea>
                    </div>
                </div>
                <!-- Cadastrar -->
                <div class="flex flex-row-reverse pr-5">
                    <PrimaryButton type="submit">Editar Complementos</PrimaryButton>
                </div>
            </form>
            </div>
        </div>
    </LayoutAdministrativo>
</template>
