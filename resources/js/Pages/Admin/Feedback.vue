<script>
import LayoutAdministrativo from '@/Layouts/LayoutAdministrativo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';

export default {
    props: ['feedbacks'],

    components: {
        LayoutAdministrativo,
        PrimaryButton,
        Modal
    }
}
</script>

<template>
    <LayoutAdministrativo>
        <div class="shadow-xl bg-white p-5 mx-40 mt-24">
            <div class="flex flex-row-reverse">
                <PrimaryButton>Ativar Promoção</PrimaryButton>
            </div>
            <hr class="mt-2"/>
            <div>{{ feedbacks }}</div>
        </div>
    </LayoutAdministrativo>
</template>
