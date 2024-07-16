<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue'
import TextInput from '@/Components/TextInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import InputError from '@/Components/TextInput.vue'

export default {
    components: {
        LayoutAdministrativo,
        TextInput,
        PrimaryButton,
        InputError
    },

    data() {
        return {
            form: this.$inertia.form({
                nome: '',
                email: '',
                senha: '',
                senha_confirmation: '',
            }),
        }
    },

    methods: {
        enviar() {
            this.form.post(route('admin.usuario.create'), {
                onSuccess: () => this.$swal('Edição salva!', '', 'success')
            })
        }
    }
}

</script>
<template>
    <LayoutAdministrativo>
        <div class="shadow-xl bg-white p-5 mx-40 mt-24 max-h-[700px] overflow-auto">
            <!-- Header -->
            <div class="text-center font-bold text-xl">
                <h2>Adicionar usuário</h2>
                <hr class="my-2 border-yellow-400"/>
            </div>
            <form @submit.prevent="enviar">
                <div class="p-5 text-xs">
                    <div class="relative">
                        <label for="nome" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Nome</label>
                        <TextInput type="text" class="w-full" id="nome" v-model="form.nome" />
                    </div>
                    <div class="relative mt-4" >
                        <label for="email" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">E-mail</label>
                        <TextInput type="text" class="w-full" id="email" v-model="form.email" />
                    </div>
                    <div class="relative mt-4" >
                        <label for="senha" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Senha</label>
                        <TextInput type="password" class="w-full" id="senha" v-model="form.senha" />
                    </div>
                    <div class="relative mt-4" >
                        <label for="senha_confirmation" class="absolute top-[-10px] left-[10px] z-index-20 bg-white">Confirmar Senha</label>
                        <TextInput type="password" class="w-full" id="senha_confirmation" v-model="form.senha_confirmation" />
                    </div>
                </div>

                <div class="flex flex-row-reverse gap-5 p-5">
                    <PrimaryButton type="submit">Cadastrar</PrimaryButton>
                </div>
            </form>
        </div>
    </LayoutAdministrativo>
</template>
