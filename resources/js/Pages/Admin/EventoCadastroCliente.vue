<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import { router } from '@inertiajs/vue3';

export default {
    props: ['complementos'],

    components: {
        LayoutAdministrativo,
        TextInput,
        PrimaryButton
    },

    data() {
        return {
            tituloAtual: 'Cliente',

            form: this.$inertia.form({
                nome: '',
                telefone: '',
                telefone_backup: '',
                cpf: '',
                rg: '',
            })
        }
    },

    methods: {

    },

    computed: {
        atualizarTitulo() {
            return this.tituloAtual
        }
    }
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

            <!-- Formulário de cliente -->
            <div class="p-5">
                <form @submit.prevent="enviar">
                    <div class="text-xs">
                        <div class="relative my-5">
                            <label for="nome" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Nome</label>
                            <TextInput type="text" class="w-full" id="nome" v-model="form.nome" />
                        </div>
                        <div class="relative my-5">
                            <label for="telefone" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Telefone Principal</label>
                            <TextInput type="tel" class="w-full" id="telefone" v-model="form.telefone" />
                        </div>
                        <div class="relative my-5">
                            <label for="telefone_backup" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Telefone Secundário</label>
                            <TextInput type="tel" class="w-full" id="telefone_backup" v-model="form.telefone_backup" />
                        </div>
                        <div class="relative my-5">
                            <label for="cpf" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">CPF/CNPJ</label>
                            <TextInput type="text" class="w-full" id="cpf" v-model="form.cpf" />
                        </div>
                        <div class="relative my-5">
                            <label for="rg" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">RG</label>
                            <TextInput type="text" class="w-full" id="rg" v-model="form.rg" />
                        </div>
                    </div>

                    <div class="flex flex-row-reverse">
                        <PrimaryButton type="submit">Cadastrar</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </LayoutAdministrativo>
</template>
