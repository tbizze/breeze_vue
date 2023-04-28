<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionPageForm from "@/Components/SectionPageForm.vue";
import FormButtonNew from "@/Components/FormButtonNew.vue";
import { PencilIcon } from "@heroicons/vue/solid";
import { TrashIcon } from "@heroicons/vue/solid";
import { PlusIcon } from "@heroicons/vue/solid";
import PaginationNew from "@/Components/PaginationNew.vue";
import Pagination from "@/Components/Pagination.vue";
defineProps({
  lancamentos: Object,
  titulo: "",
});

/**
 * Função para editar um registro.
 * Como parâmetro recebe o ID.
 */
function actionEdit(id) {
  router.get(route("lcto.edit", id));
}
/**
 * Função para deletar um registro.
 * Como parâmetro recebe o ID.
 */
function actionDelete(id) {
  router.delete(route("lcto.delete", id));
}
/**
 * Função para abrir formulário de cadastro.
 */
function actionAdd() {
  router.get(route("lcto.create"));
}
/**
 * Função para formatar valores monetários.
 */
function formataValor(str) {
  return str.split(".").join(",");
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
          <!-- <PaginationNew :data="lancamentos" /> -->
          <Pagination :pagination="lancamentos" />
        </div>
      </template>

      <!-- Corpo da Página -->
      <template #corpo>
        <table class="">
          <tr
            v-for="lancamento in lancamentos.data"
            :key="lancamento.id"
            class="hover:bg-gray-100"
          >
            <td class="border px-4 py-2">{{ lancamento.id }}</td>
            <td class="border px-4 py-2">{{ lancamento.lcto_data }}</td>
            <td class="border px-4 py-2">{{ lancamento.lcto_historico }}</td>
            <td class="border px-4 py-2">{{ lancamento.lcto_tipo }}</td>
            <td class="border px-4 py-2 text-right">
              {{ formataValor(lancamento.lcto_valor) }}
            </td>
            <td class="border px-4 py-2">
              {{ lancamento.to_lcto_grupo.nome }}
            </td>
            <td class="border px-4 py-2 space-x-2 text-center">
              <FormButtonNew
                @click.prevent="actionEdit(lancamento.id)"
                :btAction="PencilIcon"
                intent="secondary"
                tpMin
              />
              <FormButtonNew
                @click.prevent="actionDelete(lancamento.id)"
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