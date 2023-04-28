<script setup>
import { Link } from "@inertiajs/vue3";
import { computed, useSlots } from "vue";

defineEmits(["submitted"]);

const hasActions = computed(() => !!useSlots().actions);
</script>

<template>
  <!-- #### SEÇÃO: Corpo da Página -->
  <div class="py-12">
    <div class="max-w-5xl mx-auto py-1 sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="font-sans text-gray-900 antialiased">
          <!-- <div class="m-5"> -->
          <!-- se colocar a classe [ min-h-screen ] ===> definirá altura minima para elemento a da tela -->
          <div class="flex flex-col itens-center pt-6 sm:pt-0">
            <!-- Insere o Cabeçalho da Página [Add | Filtros...] -->
            <div
              class="flex items-center justify-between space-x-4 px-4 py-4 "
            >
              <slot name="header" />
            </div>

            <!-- Insere o Cabeçalho e Corpo da Tabela -->
            <slot name="body" />
            <!-- Insere o Rodapé da Tabela -->
            <div class="flex items-center justify-between space-x-4 px-4 py-2">
              <slot name="footer" />
            </div>
            <!-- #### END #### -->
            <!-- Conteúdo da Página -->
          </div>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
</template>
