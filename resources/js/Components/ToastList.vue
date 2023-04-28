<script setup>
import ToastListItem from "@/Components/ToastListItem.vue";
import { ref } from "vue";
/* import {Inertia} from "@/inertiajs/inertia"; */
import { usePage } from "@inertiajs/vue3";

const items = ref([
  { message: "Deixe um recado!" },
  { message: "App de mensageria." },
  { message: "Vamos pesquisar juntos." },
  { message: "Deixe um recado!" },
]);


const page = usePage();

/* Inertia.on("finish", () => {
    if (page.props.value.toast) {
        items.value.unshift({
            message: page.props.value.toast
        });
    }
}); */

function remove(index) {
  items.value.splice(index, 1);
}
</script>

<template>
  <div class="fixed top-4 z-50 right-4 space-y-4 w-full max-w-xs">
    <ToastListItem
      v-for="(item, index) in items"
      :key="index"
      :message="item.message"
      @remove="remove(index)"
    />
  </div>


  <div v-if="$page.props.flash.message" class="alert">
        {{ $page.props.flash.message }}
    </div>
</template>