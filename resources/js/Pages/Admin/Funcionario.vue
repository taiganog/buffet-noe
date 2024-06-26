<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import IconeExcluir from '@/Components/Icones/IconeExcluir.vue';
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';

import { router } from '@inertiajs/vue3';

export default {
    props: ['funcionarios'],

    components: {
        LayoutAdministrativo,
        PrimaryButton,
        IconeExcluir,
        Modal,
        TextInput
    },

    data() {
        return {
            cadastroFuncionario: false,

            form: this.$inertia.form({
                nome: '',
                telefone: '',
                chave_pix: ''
            })
        }
    },

    methods: {
        fecharModal() {
            this.cadastroFuncionario = false
        },

        enviar() {
            router.post('admin.funcionario.create', this.form)
        },

        alert(id) {
            this.$swal({
                title: "Excluir funcionário?",
                text: "Não será possível refazer esta ação!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Excluir!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    router.delete(route('admin.funcionario.destroy', id))
                    this.$swal('Funcionário excluído!', '', 'success')
                }
            })
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
                <PrimaryButton @click="cadastroFuncionario = true">Cadastrar Funcionário</PrimaryButton>
            </div>
            <hr class="my-2 border-yellow-400"/>

            <!-- Título tabela -->
            <div class="grid grid-cols-3 text-center font-bold">
                <span>Nome</span>
                <span>Telefone</span>
                <span>Chave PIX</span>

                <hr class="col-span-3 mt-2 w-10/12 m-auto border-yellow-400" />
            </div>

            <!-- Listagem de funcionários -->
            <div v-for="funcionario in funcionarios"
            class="grid grid-cols-3 my-1 p-2 rounded-md hover:bg-gray-100 transition duration-300 text-md items-center">
                <p>{{ funcionario.nome }}</p>
                <p>{{ funcionario.telefone }}</p>
                <div class="flex justify-between items-center">
                    <p>{{ funcionario.chave_pix }}</p>
                    <IconeExcluir class="cursor-pointer"
                    @click="alert(funcionario.id)" />
                </div>
            </div>
        </div>

        <!-- Modal para cadastro de funcionário -->
        <Modal :show="cadastroFuncionario" maxWidth="2xl" @close="fecharModal">
            <div class="p-5">
                <div class="text-center font-bold text-2xl">Cadastrar Funcionário</div>
                <hr class="w-10/12 m-auto border-yellow-400" />
                <!-- Formulário -->
                <form @submit.prevent="enviar">
                    <div class="text-xs mt-5">
                        <div class="relative my-5">
                            <label for="nome" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Nome</label>
                            <TextInput type="text" class="w-full" id="nome" v-model="form.nome" />
                        </div>
                        <div class="relative my-5">
                            <label for="telefone" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Telefone</label>
                            <TextInput type="text" class="w-full" id="telefone" v-model="form.telefone"/>
                        </div>
                        <div class="relative my-5">
                            <label for="chave_pix" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Chave PIX</label>
                            <TextInput type="text" class="w-full" id="chave_pix" v-model="form.chave_pix" />
                        </div>
                    </div>
                    <div class="flex flex-row-reverse">
                        <PrimaryButton type="submit">Cadastrar</PrimaryButton>
                    </div>
                </form>
            </div>
        </Modal>
    </LayoutAdministrativo>
</template>
