<script>
import IconeUsuario from '@/Components/Icones/IconeUsuario.vue'
import NavLink from '@/Components/NavLink.vue'
import { Link, router } from '@inertiajs/vue3'

export default {
    components: {
        IconeUsuario,
        NavLink,
        Link
    },

    methods: {
        logout() {
            router.visit(route('logout'), {
                method: 'post',
                replace: true,
            })
        }
    },

    data() {
        return {
        }
    }
}
</script>

<template>
    <div class="grid grid-cols-12">
        <div class="bg-[#ffa32c] min-h-screen sticky shadow-2xl col-span-2">
            <!-- Topo usuário -->
            <Link :href="route('admin.usuario')">
                <div class="flex justify-center mt-8">
                    <IconeUsuario class="mr-3" />
                    <span class="text-2xl font-bold">{{ $page.props.auth.user.name }}</span>
                </div>
            </Link>

            <hr class="border-black border-2 rounded-md w-9/12 m-auto mt-2" />

            <!-- Navbar -->
            <div class="flex flex-col items-center mt-[100px]">
                <NavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
                    Dashboard
                </NavLink>

                <hr class="border-black w-3/12 my-5" />

                <NavLink :href="route('admin.evento')" :active="$page.url.startsWith('/admin/evento')">
                    Eventos
                </NavLink>

                <hr class="border-black w-3/12 my-5" />

                <NavLink :href="route('admin.funcionario')" :active="route().current('admin.funcionario')">
                    Funcionários
                </NavLink>

                <hr class="border-black w-3/12 my-5" />

                <NavLink :href="route('admin.feedback')" :active="route().current('admin.feedback')">
                    Feedbacks
                </NavLink>

                <hr class="border-black w-3/12 my-5" />

                <NavLink :href="route('admin.servico')" :active="route().current('admin.servico')">
                    Serviços
                </NavLink>

                <!--
                    <hr class="border-black w-3/12 my-5" />
                <p @click="logout">
                    Logout
                </p>
                -->
            </div>
        </div>

        <!-- Conteúdo -->
        <div class="col-span-10 bg-gray-200">
            <slot />
        </div>

        <!-- Footer -->
        <div class="fixed bg-gray-400 h-16 bottom-0 right-0 w-10/12 max-h-[25px]">
            <div class="flex justify-between mx-5 text-center">
                <p>{{ new Date().toDateString() }}</p>
                <p>Jul - 2024 / V 1.0 /</p>
            </div>
        </div>
    </div>
</template>
