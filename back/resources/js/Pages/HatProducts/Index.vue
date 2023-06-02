<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue'

defineProps({ products: Object })
</script>

<template>
  <Head title="Hat products"/>

  <AuthenticatedLayout>
        <template #header>
            <h2 class="inline font-semibold text-xl text-gray-800 leading-tight">Hat products</h2>
            <PrimaryButton class="ml-4"><Link :href="route('hatProducts.create')">Create</Link></PrimaryButton>
        </template>

        <div class="py-12 px-8">
            <table class="table-auto w-full text-left">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Preview</th>
                        <th>Price</th>
                        <th>Model</th>
                        <th>Model data</th>
                        <th>Created at</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products.data" :key="product.id">
                        <td>{{ product.id }}</td>
                        <td>{{ product.name }}</td>
                        <td><img class="preview_img" v-bind:src="product.preview_img_url" alt="preview"></td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.model }}</td>
                        <td>{{ product.custom_model_data }}</td>
                        <td>{{ product.created_at }}</td>
                        <td>
                            <Link v-bind:href="route('hatProducts.edit', product.id)">
                                <i class="bi-pencil-fill text-sky-500 text-xl"/>
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.preview_img {
    height: 80px;
    width: auto;
}
</style>