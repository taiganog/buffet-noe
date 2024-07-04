<script>
import IconeUsuario from '@/Components/Icones/IconeUsuario.vue'
import NavLink from '@/Components/NavLink.vue'

export default {
    components: {
        IconeUsuario,
        NavLink
    }
}
</script>

<template>
    <div class="grid grid-cols-12">
        <div class="bg-[#ffa32c] min-h-screen sticky shadow-2xl col-span-2">
            <!-- Topo usuário -->
            <div class="flex justify-center mt-8">
                <IconeUsuario class="mr-3" />
                <span class="text-2xl font-bold">{{ $page.props.auth.user.name }}</span>
            </div>

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
            </div>
        </div>

        <!-- Conteúdo -->
        <div class="col-span-10 bg-gray-200">
            <slot />
        </div>
    </div>
</template>
