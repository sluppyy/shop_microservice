<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Paginator from '@/Components/Paginator.vue'
import { Head, Link } from '@inertiajs/vue3';

defineProps({ userItems: Object })
</script>

<template>
  <Head title="User items purchases"/>

  <AuthenticatedLayout>
        <template #header>
            <h2 class="inline font-semibold text-xl text-gray-800 leading-tight">Hat user items</h2>
            <p>
                Total: {{  userItems.total }}
            </p>
        </template>

        <div class="py-12 px-8">
          <table class="table-auto w-full text-left text-xl">
            <thead class="text-xs font-semibold text-white uppercase tracking-wider">
              <tr>
                <th class="px-5 py-3 bg-gray-500">User Id</th>
                <th class="px-5 py-3 bg-gray-500">Product Id</th>
                <th class="px-5 py-3 bg-gray-500">Count</th>
                <th class="px-5 py-3 bg-gray-500">Created at</th>
                <th class="px-5 py-3 bg-gray-500">Updated at</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="userItem in userItems.data" :key="userItem.user_id+userItem.product_id">
                <td class="py-4 ps-4">{{ userItem.user_id }}</td>
                <td>
                  <Link 
                    :href="route('hatProducts.edit',userItem.product_id)"
                    class="text-sky-500 font-bold">
                    {{ userItem.product_id }}
                  </Link>
                </td>
                <td>{{ userItem.count }}</td>
                <td>{{ userItem.created_at }}</td>
                <td>{{ userItem.updated_at }}</td>
              </tr>
            </tbody>
          </table>

          <Paginator :paginator="userItems"/>
        </div>
    </AuthenticatedLayout>
</template>