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
const props = defineProps({
  lancamentos: Object,
  titulo: "",
  filters: Object,
});

const form = useForm({
  search: props.filters.search,
  field: props.filters.field,
  direction: props.filters.direction,
});

/**
 * Função para submeter o formulário de pesquisa.
 */
function submit() {
  /* form.post(route("lcto.grupos.store")); */
  router.get(route("lcto"), form);
}

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

function sort(field) {
  form.field = field;
  form.direction = form.direction === "asc" ? "desc" : "asc";
  /* this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc'; */
  /* console.log(form.direction);
      console.log(form.field); */
  submit();
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
          class="flex items-center justify-between space-x-4 px-4 py-2 mb-3 bg-gray-50"
        >
          <FormButtonNew
            @click.prevent="actionAdd"
            :iconLeft="PlusIcon"
            intent="other"
          >
            Adicionar
          </FormButtonNew>

          <div class="w-full md:w-1/2">
            <form @submit.prevent="submit()" class="flex items-center">
              <label for="simple-search" class="sr-only">Procurar</label>
              <div class="relative w-full">
                <div
                  class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                >
                  <svg
                    aria-hidden="true"
                    class="w-5 h-5 text-gray-500 dark:text-gray-400"
                    fill="currentColor"
                    viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"
                    />
                  </svg>
                </div>
                <input
                  type="search"
                  v-model="form.search"
                  class="block w-full p-1.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                  placeholder="Procurar"
                />
              </div>
            </form>
          </div>

          <!-- <PaginationNew :data="lancamentos" /> -->
          <Pagination :pagination="lancamentos" />
        </div>
      </template>

      <!-- Corpo da Página -->
      <template #corpo>
        <table class="">
          <thead
            class="text-sm font-semibold text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
          >
            <tr>
              <td>#</td>
              <td
                class="py-3 "
                @click="sort('lcto_data')"
              >
                
                <span class="inline-flex w-full justify-center items-center">Data
                  <svg
                    v-if="
                      form.field === 'lcto_data' && form.direction === 'asc'
                    "
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 ml-1"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                  >
                    <path
                      d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"
                    />
                  </svg>

                  <svg
                    v-if="
                      form.field === 'lcto_data' && form.direction === 'desc'
                    "
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 ml-1"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                  >
                    <path
                      d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"
                    />
                  </svg>
                </span>
              </td>
              <td
                class="py-3 flex items-center justify-center"
                @click="sort('lcto_historico')"
              >
                <span class="inline-flex w-full justify-center items-center">Histórico
                <svg
                  v-if="form.field === 'lcto_historico' && form.direction === 'asc'"
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4 ml-1"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"
                  />
                </svg>

                <svg
                  v-if="form.field === 'lcto_historico' && form.direction === 'desc'"
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4 ml-1"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"
                  />
                </svg>
              </span>
              </td>
              <td>C/D</td>
              <td>Valor</td>
              <td>Grupo</td>
              <td>Ação</td>
            </tr>
          </thead>
          <tbody>
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
          </tbody>
        </table>
      </template>
    </SectionPageForm>
    <!-- #### END: Conteúdo da Página #### -->
  </AppLayout>
</template>