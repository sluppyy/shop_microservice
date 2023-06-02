<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
  product: Object
})

const confirmingProductDeletion = ref(false);

const form = useForm({});

const confirmProductDeletion = () => {
    confirmingProductDeletion.value = true;
};

const product = usePage().props.product;
const deleteProduct = () => {
    form.delete(route('hatProducts.destroy', product.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};

const closeModal = () => {
  confirmingProductDeletion.value = false;
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Delete product</h2>

            <p class="mt-1 text-sm text-gray-600">
              This action really delete product
            </p>
        </header>

        <DangerButton @click="confirmProductDeletion">Delete product</DangerButton>

        <Modal :show="confirmingProductDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete "{{product.name}}"?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                  This action really delete product</p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteProduct"
                    >
                        Delete
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
