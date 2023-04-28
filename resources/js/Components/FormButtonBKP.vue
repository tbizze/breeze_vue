<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
const props = defineProps({
  leftIcon: Object,
  rightIcon: Object,
  btAction: Object,
  btDisabled: Boolean,
  btPrimary: Boolean,
  btSecondary: Boolean,
  btDanger: Boolean,
  btText: Boolean,
  btClass: String,
  as: {
    type: [String, Object],
    default: "button",
  },
  /*modoButton: {
    type: String,
    validator: (val) => ["primary", "secondary", "danger", "text"].includes(val),
    default: "secondary",
  }, */
});

/* if (props.disabled) {
  console.log(props.disabled);    primary", "secondary", "danger", "text"
} */

/*  const varClass = computed(() => {
    if (props.modoButton === 'primary') {
      return 'bg-black text-white hover:bg-gray-800';
    }

    if (props.modoButton === 'secondary') {
        return 'bg-black/5 hover:bg-black/10 text-gray-700';
    }

    if (props.modoButton === 'danger') {
        return 'bg-red-600 text-white hover:bg-red-500';
    }

    if (props.modoButton === 'text') {
        return 'text-gray-700 hover:bg-black/5';
    }
}); */

/* const classes = computed(() => {
    return props.active
        ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-left text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
        : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
}); */

</script>

<template>
  <component :is="props.btDanger">
      <slot />danger
  </component>



 <!--  <Link v-else :href="href" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
      <slot />
  </Link> -->
  <!-- Estilo primary -->
  <button v-if="btClass == 'danger'"
    class="bg-black text-white hover:bg-gray-800"
  >

  <!-- Estilo secondary -->
  <!-- Estilo danger -->
  <!-- Estilo text -->
  <!-- <button
    class="bg-gray-800 text-white rounded font-semibold px-4 py-2 inline-flex items-center"
  > -->
 <!--  <button
    :class="varClass"
  > -->
    <component :is="props.leftIcon" class="w-5 h-5 mr-2" />
    <div class="varClass"></div>

    <span v-if="!props.btAction">
      <slot />
    </span>

    <component :is="props.rightIcon" class="w-5 h-5 ml-2" />

    <component :is="props.btAction" class="w-5 h-5" />
  </button>
</template>

<!-- 
    FONTE: https://tallpad.com/series/vuejs-misc/lessons/button-component
 -->

<!--inline-flex items-center px-4 py-2 
    bg-gray-800 
    border border-transparent rounded-md 
    font-semibold text-xs text-white uppercase tracking-widest 
    hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 -->