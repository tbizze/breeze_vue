<script setup>
/* import { Link }  from '@inertiajs/inertia-vue3'; */
import { Link } from '@inertiajs/vue3';

defineProps({
    data: {
        type: Object,
        default: () => ({}),
    },
});
</script>


<template>
    <div v-if="data.links.length > 3" class="flex justify-center space-x-2">
        <!-- <Link
            v-for="(link, k) in data.links"
            :key="k"
            class="px-4 py-3 text-sm leading-4 bg-white rounded hover:bg-white focus:text-indigo-500 hover:shadow"
            :class="{'bg-indigo-400 text-white': link.active}"
            :href="link.url"
            v-html="link.label"
        /> -->
        <Link
            v-for="(link, k) in data.links"
            :key="k"
            class="px-3 py-2 text-sm leading-4 bg-white rounded border hover:bg-gray-100  focus:text-indigo-500 "
            :class="{'bg-gray-600 border border-gray-600 hover:border-gray-200 text-white hover:text-gray-800': link.active}"
            :href="link.url"

        >{{ link.label }}
        </link>
    </div>
</template>