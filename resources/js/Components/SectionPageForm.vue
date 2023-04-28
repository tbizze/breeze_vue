<script setup>
import { Link } from "@inertiajs/vue3";
import { computed, useSlots } from 'vue';
import SectionTitle from './SectionTitle.vue';

defineEmits(['submitted']);

const hasActions = computed(() => !! useSlots().actions);
</script>

<template>
    <!-- #### SEÇÃO: Corpo da Página -->
    <div class="py-12">
      <div class="max-w-5xl mx-auto py-1 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-md  sm:rounded-lg">
          <div class="font-sans text-gray-900 antialiased">
            <!-- <div class="m-5"> -->
              <!-- se colocar a classe [ min-h-screen ] ===> definirá altura minima para elemento a da tela -->
              <div class="flex flex-col itens-center pt-6 sm:pt-0">
                
                <!-- #### START #### -->
                <!-- Conteúdo da Página -->
                <slot name="topo" />
                <!-- <Link :href="route('financa.grupos.create')" class="w-2/12 bg-blue-500 hover:bg-blue-700 text-white font-bold text-center py-2 px-4 ml-4 mb-4 rounded">Criar Novo</Link> -->
                <slot name="corpo" />

                <!-- #### END #### -->
                <!-- Conteúdo da Página -->
              </div>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
</template>
