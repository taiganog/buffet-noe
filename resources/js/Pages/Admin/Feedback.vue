<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';

import { router } from '@inertiajs/vue3';

export default {
    props: ['feedbacks', 'promocaoAtiva'],

    components: {
        LayoutAdministrativo,
        PrimaryButton,
        Modal,
        TextInput
    },

    data() {
        return {
            feedbackModal: false,
            feedbackPromocao: false,

            form: this.$inertia.form({
                data_inicial: '',
                data_final: '',
                mensagem: ''
            })
        }
    },

    methods: {
        fecharModal() {
            this.feedbackModal = false
            this.feedbackPromocao = false
        },

        enviar() {
            router.post('/admin/feedback', this.form)
        }
    },

    computed: {
        classePromocao() {
            if(this.promocaoAtiva === 'Ativa') {
                return 'text-green-500';
            } else if(this.promocaoAtiva === 'Não') {
                return 'text-red-500';
            } else {
                return 'text-yellow-500';
            }

        }
    }
}
</script>

<template>
    <LayoutAdministrativo>
        <div class="shadow-xl bg-white p-5 mx-40 mt-24 max-h-[700px] overflow-auto">
            <!-- Header -->
            <div class="flex justify-between items-center">
                <p class="text-gray-400 text-center italic">Clique em um card para expandi-lo</p>
                <PrimaryButton @click="feedbackPromocao = true">Ativar Promoção</PrimaryButton>
            </div>
            <hr class="my-2 border-yellow-400"/>
            <!-- Titulo tabela -->
            <div class="grid grid-cols-3 text-center font-bold">
                <span>Cliente</span>
                <span>Mensagem</span>
                <span>Data</span>

                <hr class="col-span-3 mt-2 w-10/12 m-auto border-yellow-400" />
            </div>
            <!-- Conteúdo de orcamentos -->
            <div v-for="(feedback, key) in feedbacks"
            class="grid grid-cols-3 my-3 p-2 rounded-md hover:bg-gray-100 transition duration-300 text-md"
            @click="feedbackModal = true; id = key">
                <div>
                    <span><b class="text-yellow-500">{{ feedback.tipo }}</b> - {{ feedback.nome }}</span>
                </div>
                <div class="truncate">{{ feedback.mensagem }}</div>
                <div class="text-right">{{ feedback.created_at }}</div>
            </div>
        </div>

        <!-- Modal para detalhes do feedback -->
        <Modal :show="feedbackModal" maxWidth="2xl" @close="fecharModal">
            <div class="p-5">
                <!-- Título -->
                <div>
                    <div class="text-center font-bold text-2xl">{{ feedbacks[id].nome }}</div>
                    <hr class="w-10/12 m-auto border-yellow-400" />
                </div>

                <!-- Conteúdo -->
                <div class="grid grid-cols-2 gap-3 mt-5 text-sm">
                    <p class="border-b border-l p-1"><b>Tipo:</b> {{ feedbacks[id].tipo }}</p>
                    <p class="border-b border-l p-1"><b>Email:</b> {{ feedbacks[id].email }}</p>
                    <p class="border-b border-l p-1"><b>Telefone:</b> {{ feedbacks[id].telefone }}</p>
                    <p class="border-b border-l p-1"><b>Data:</b> {{ feedbacks[id].created_at }}</p>

                    <p class="col-span-2 p-1 font-bold">Mensagem:</p>
                    <p class="col-span-2 border-b border-l p-1">{{ feedbacks[id].mensagem }}</p>
                </div>
            </div>
        </Modal>

        <!-- Modal para ativar promoção -->
        <Modal :show="feedbackPromocao" maxWidth="2xl" @close="fecharModal">
            <div class="p-5">
                <!-- Título -->
                <div class="flex font-semibold justify-between p-3 text-xl">
                    <p>Promoção Ativa:</p>
                    <p :class="classePromocao">{{ promocaoAtiva }}</p>
                </div>
                <hr class="p-1 border-yellow-400" />
                <!-- Formulário -->
                <form @submit.prevent="enviar">
                    <div class="p-2 text-xs">
                        <p class="text-base mb-7">Incluir promoção</p>
                        <!-- Input de datas -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="relative">
                                <label for="data_inicial" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Data inicial</label>
                                <TextInput id="data_inicial" class="w-full" type="date" v-model="form.data_inicial" />
                            </div>
                            <div class="relative">
                                <label for="data_final" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Data final</label>
                                <TextInput id="data_inicial" class="w-full" type="date" v-model="form.data_final" />
                            </div>
                        </div>
                        <!-- Input de mensagem -->
                        <div class="mt-3 relative">
                            <label for="data_inicial" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Mensagem</label>
                            <textarea class="border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 w-full" v-model="form.mensagem" />
                        </div>
                        <div class="flex justify-end mt-5">
                            <PrimaryButton type="submit" @click="ativarPromocao">Ativar</PrimaryButton>
                        </div>
                    </div>
                </form>
            </div>
        </Modal>
    </LayoutAdministrativo>
</template>
