<script setup>
import { Link } from '@inertiajs/vue3';


defineProps(['paginator'])
</script>

<template>
  <div class="flex flex-wrap justify-center mt-8" v-if="paginator.links.length > 3">
    <template v-for="(link, k) in paginator.links" :key="k">
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
</template>