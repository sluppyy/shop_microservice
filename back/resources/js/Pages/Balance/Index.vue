<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({ balances: Object })
</script>

<template>
  <Head title="User balances"/>

  <AuthenticatedLayout>
        <template #header>
            <h2 class="inline font-semibold text-xl text-gray-800 leading-tight">User balances</h2>
            <p>
                Total: {{  balances.total }}
            </p>
        </template>

        <div class="py-12 px-8">
          <table class="min-w-full leading-normal table-fixed">
            <thead>
                <tr>
                    <th class="px-5 py-3 bg-gray-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        User id
                    </th>
                    <th class="px-5 py-3 bg-gray-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        Candies <span class="text-lg">🍬</span>
                    </th>
                    <th class="px-5 py-3 bg-gray-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        Created at
                    </th>
                    <th class="px-5 py-3 bg-gray-500 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        Updated at
                    </th>
                </tr>
            </thead>
            <tbody>
              <tr v-for="balance in balances.data" :key="balance.user_id">
                <td class="py-4 ps-4">{{ balance.user_id }}</td>
                <td>{{ balance.candies }}</td>
                <td>{{ balance.created_at }}</td>
                <td>{{ balance.updated_at }}</td>
              </tr>
            </tbody>
            </table>

            <div class="flex flex-wrap justify-center mt-8" v-if="balances.links.length > 3">
                <template v-for="(link, k) in balances.links" :key="k">
                    <div v-if="link.url === null" 
                        class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                        v-html="link.label" />

                    <Link
                        v-else
                        class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded focus:border-indigo-500 focus:text-indigo-500"
                        :class="{ 'bg-gray-900 text-white hover:bg-gray-800': link.active, 'hover:bg-gray-200': !link.active }"
                        :href="link.url"
                        v-html="link.label"/>
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>