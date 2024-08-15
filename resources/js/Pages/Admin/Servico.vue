<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import IconeEditar from '@/Components/Icones/IconeEditar.vue';
import { router } from '@inertiajs/vue3';

export default {
    props: ['evento', 'servicos'],

    components: {
        LayoutAdministrativo,
        PrimaryButton,
        Modal,
        TextInput,
        InputError,
        IconeEditar
    },

    data() {
        return {
            servicoModal: false,
            editarModal: false,

            form: this.$inertia.form({
                nome: '',
                valor: ''
            }),

            editForm: this.$inertia.form({
                id: '',
                nome: '',
                valor: ''
            })
        }
    },

    methods: {
        enviarForm() {
            this.form.post(route('admin.servico.create'), {
                onSuccess: () => { this.servicoModal = false; this.$swal('Serviço criado!', '', 'success'); this.form.reset(); }
            })
        },

        editarForm() {
            this.editForm.put(route('admin.servico.update', this.editForm.id), {
                onSuccess: () => { this.editarModal = false; this.$swal('Serviço editado!', '', 'success'); this.editForm.reset(); }
            })
        },

        editarServico(id) {
            this.editForm.id = id;
            this.editForm.nome = this.pegarNomeServico(id);
            this.editForm.valor = this.pegarValorServico(id);
            this.editarModal = true;
        },

        pegarNomeServico(id) {
            for(let i = 0; i < this.servicos.length; i++) {
                if (this.servicos[i].id == id) {
                    return this.servicos[i].nome;
                }
            }
        },

        pegarValorServico(id) {
            for(let i = 0; i < this.servicos.length; i++) {
                if (this.servicos[i].id == id) {
                    return this.servicos[i].valor;
                }
            }
        }
    }
}
</script>

<template>
    <LayoutAdministrativo>
        <div>
            <div class="shadow-xl bg-white p-5 mx-40 mt-24 max-h-[700px] overflow-auto">
                <!-- Header -->
                <div class="flex justify-between items-center">
                    <p class="text-xl font-bold text-center">Serviços</p>
                    <PrimaryButton @click="servicoModal = true">Cadastrar novo serviço</PrimaryButton>
                </div>
                <hr class="my-2 border-yellow-400"/>

                <!-- Listagem de serviços -->
                <div class="mt-5">
                    <table class="w-6/12 m-auto">
                        <thead>
                            <tr>
                                <th class="text-center border-2 border-yellow-500">Descrição</th>
                                <th class="text-center border-2 border-yellow-500">Valor Padrão</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="servico in servicos">
                                <td class="text-center border-2 border-yellow-500">{{ servico.nome }}</td>
                                <td class="text-center border-2 border-yellow-500">
                                    <div class="relative flex justify-center px-5">
                                        <span>R${{ servico.valor }},00</span>
                                        <IconeEditar @click="editarServico(servico.id)" class="absolute cursor-pointer right-5 top-[1px]" />
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <Modal :show="servicoModal" @close="servicoModal = false">
            <!-- Título -->
            <div class="text-center">
                <h3 class="font-bold text-2xl p-4">Cadastrar Serviços</h3>
                <hr class="border-yellow-400 w-10/12 m-auto" />
            </div>

            <!-- Formulário -->
            <form @submit.prevent="enviarForm">
                <div class="text-xs p-5">
                    <div class="relative">
                        <label for="nome" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Descrição</label>
                        <TextInput type="text" class="w-full" id="nome" v-model="form.nome" />
                        <InputError :message="form.errors.nome" class="mt-2" />
                    </div>
                    <div class="relative mt-5">
                        <label for="valor" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Valor</label>
                        <TextInput type="number" class="w-full" id="valor" v-model="form.valor" />
                        <InputError :message="form.errors.valor" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-5">
                        <PrimaryButton class="ml-4">
                            Cadastrar
                        </PrimaryButton>
                    </div>
                </div>
            </form>

        </Modal>
        <!-- Edição -->
        <Modal :show="editarModal" @close="editarModal = false">
            <!-- Título -->
            <div class="text-center">
                <h3 class="font-bold text-2xl p-4">Cadastrar Serviços</h3>
                <hr class="border-yellow-400 w-10/12 m-auto" />
            </div>

            <form @submit.prevent="editarForm">
                <div class="text-xs p-5">
                    <div class="relative">
                        <label for="nome" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Descrição</label>
                        <TextInput type="text" class="w-full" id="nome" v-model="editForm.nome" />
                        <InputError :message="editForm.errors.nome" class="mt-2" />
                    </div>
                    <div class="relative mt-5">
                        <label for="valor" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Valor</label>
                        <TextInput type="number" class="w-full" id="valor" v-model="editForm.valor" />
                        <InputError :message="editForm.errors.valor" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-5">
                        <PrimaryButton class="ml-4">
                            Cadastrar
                        </PrimaryButton>
                    </div>
                </div>
            </form>
        </Modal>
    </LayoutAdministrativo>
</template>
