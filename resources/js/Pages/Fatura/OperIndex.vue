<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionPageForm from "@/Components/SectionPageForm.vue";
import FormButtonNew from "@/Components/FormButtonNew.vue";
import { PencilIcon } from "@heroicons/vue/solid";
import { TrashIcon } from "@heroicons/vue/solid";
import { PlusIcon } from "@heroicons/vue/solid";
import PaginationNew from "@/Components/PaginationNew.vue";
defineProps({
  operadoras: Object,
  titulo: "",
});

/**
 * Função para editar um registro.
 * Como parâmetro recebe o ID.
 */
function actionEdit(id) {
  router.get(route("fat.opers.edit", id));
}
/**
 * Função para deletar um registro.
 * Como parâmetro recebe o ID.
 */
function actionDelete(id) {
  router.delete(route("fat.opers.delete", id));
}
/**
 * Função para abrir formulário de cadastro.
 */
function actionAdd() {
  router.get(route("fat.opers.create"));
}
</script>

<template>
  <!-- Carrega o Layout da Aplicação com "Logo e TopMenu, com botões Login/Logout..." -->
  <AppLayout :title="$props.titulo">
    <!-- #### SEÇÃO: Título da Página -->
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ titulo }}
      </h2>
    </template>

    <!-- #### START: Conteúdo da Página #### -->
    <SectionPageForm>
      <!-- Cabeçalho da Página -->
      <template #topo>
        <div
          class="flex items-center justify-between space-x-4 px-4 py-2 bg-gray-50"
        >
          <FormButtonNew
            @click.prevent="actionAdd"
            :iconLeft="PlusIcon"
            intent="other"
          >
            Adicionar
          </FormButtonNew>
          <PaginationNew :data="operadoras" />
        </div>
      </template>

      <!-- Corpo da Página -->
      <template #corpo>
        <table class="">
          <tr
            v-for="operadora in operadoras.data"
            :key="operadora.id"
            class="hover:bg-gray-100"
          >
            <td class="border px-4 py-2 w-10">{{ operadora.id }}</td>
            <td class="border px-4 py-2">{{ operadora.nome }}</td>
            <td class="border px-4 py-2">{{ operadora.notas }}</td>
            <td class="border px-4 py-2 space-x-2 text-center w-28">
              <FormButtonNew
                @click.prevent="actionEdit(operadora.id)"
                :btAction="PencilIcon"
                intent="secondary"
                tpMin
              />
              <FormButtonNew
                @click.prevent="actionDelete(operadora.id)"
                :btAction="TrashIcon"
                intent="danger"
                tpMin
              />
            </td>
          </tr>
        </table>
      </template>
    </SectionPageForm>
    <!-- #### END: Conteúdo da Página #### -->
  </AppLayout>
</template>
