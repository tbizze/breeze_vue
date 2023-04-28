<script setup>
import { computed, onMounted, onUnmounted, ref } from "vue";
const props = defineProps({
  rightIcon: '',
  leftIcon: '',
  btAction: '',
});
</script>

<template>
  <button class="text-white font-semibold  rounded px-2 py-1.5 inline-flex items-center">
    <component :is="props.leftIcon" class="w-5 h-5 mr-2" />
    <span v-if="!props.btAction">
      <slot />
    </span>

    <component :is="props.rightIcon" class="w-5 h-5 ml-2" />

    <component :is="props.btAction" class="w-4 h-4" />
  </button>
</template>

<!-- 
    FONTE: https://tallpad.com/series/vuejs-misc/lessons/button-component
 -->
<!-- 
 https://npm.io/package/class-variance-authority
 Neste endereço ensina a instalar a Biblioteca CVA, útil para lidar com as classes CSS.
 
 Código Fonte pronto para importar: 
 https://variantui.com/buttons
 -->


<!--inline-flex items-center px-4 py-2 
    bg-gray-800 
    border border-transparent rounded-md 
    font-semibold text-xs text-white uppercase tracking-widest 
    hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 -->