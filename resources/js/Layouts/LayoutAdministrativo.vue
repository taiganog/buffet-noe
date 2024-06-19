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
    <div class="grid grid-cols-7">
        <div class="bg-[#ffa32c] min-h-screen sticky shadow-2xl">
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

                <NavLink :href="route('admin.evento')" :active="route().current('admin.evento')">
                    Eventos
                </NavLink>

                <hr class="border-black w-3/12 my-5" />

                <NavLink :href="route('admin.funcionario')" :active="route().current('admin.funcionario')">
                    Funcionarios
                </NavLink>
            </div>
        </div>

        <div class="col-span-6 bg-gray-200">
            <slot />
        </div>
    </div>
</template>
