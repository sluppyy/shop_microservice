<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Paginator from '@/Components/Paginator.vue'

defineProps({ purchases: Object })
</script>

<template>
  <Head title="Hat purchases"/>

  <AuthenticatedLayout>
        <template #header>
            <h2 class="inline font-semibold text-xl text-gray-800 leading-tight">User hat purchases</h2>
            <p>
                Total: {{  purchases.total }}
            </p>
        </template>

        <div class="py-12 px-8">
          <table class="table-auto w-full text-left text-xl">
                <thead>
                    <tr>
                        <th class="px-5 py-3 bg-gray-500 text-left text-xs font-semibold text-white uppercase tracking-wider">Id</th>
                        <th class="px-5 py-3 bg-gray-500 text-left text-xs font-semibold text-white uppercase tracking-wider">Product Id</th>
                        <th class="px-5 py-3 bg-gray-500 text-left text-xs font-semibold text-white uppercase tracking-wider">User Id</th>
                        <th class="px-5 py-3 bg-gray-500 text-left text-xs font-semibold text-white uppercase tracking-wider">Price</th>
                        <th class="px-5 py-3 bg-gray-500 text-left text-xs font-semibold text-white uppercase tracking-wider">Count</th>
                        <th class="px-5 py-3 bg-gray-500 text-left text-xs font-semibold text-white uppercase tracking-wider">Created at</th>
                    </tr>
                </thead>
            <tbody>
              <tr v-for="purchase in purchases.data" :key="purchase.id">
                <td class="py-4 ps-4">{{ purchase.id }}</td>
                <td>
                  <Link 
                    :href="route('hatProducts.edit',purchase.product_id)"
                    class="text-sky-500 font-bold">
                    {{ purchase.product_id }}
                  </Link>
                </td>
                <td>{{ purchase.user_id }}</td>
                <td>{{ purchase.price }}</td>
                <td>{{ purchase.count }}</td>
                <td>{{ purchase.created_at }}</td>
              </tr>
            </tbody>
            </table>

            <Paginator :paginator="purchases"/>
        </div>
    </AuthenticatedLayout>
</template>