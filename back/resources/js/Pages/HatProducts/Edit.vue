<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteProductForm from './Partials/DeleteProductForm.vue'
import UpdateProductFields from './Partials/UpdateProductFields.vue'
import { Head } from '@inertiajs/vue3';

defineProps({ product: Object })
</script>

<template>
  <Head v-bind:title="product.name"/>

  <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ product.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProductFields class="max-w-xl" v-bind:product="product" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <DeleteProductForm class="max-w-xl" v-bind:product="product" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
