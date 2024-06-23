<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import IconeExcluir from '@/Components/Icones/IconeExcluir.vue';

export default {
    props: ['funcionarios'],

    components: {
        LayoutAdministrativo,
        PrimaryButton,
        IconeExcluir
    },

    data() {
        return {
            cadastroFuncionario: false
        }
    },

    methods: {
        fecharModal() {
            this.cadastroFuncionario = false
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
                    <IconeExcluir @click="$inertia.delete(route('admin.funcionario.destroy', funcionario.id))"/>
                </div>
            </div>
        </div>

    </LayoutAdministrativo>
</template>
