<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionPageTable from "@/Components/SectionPageTable.vue";
import FormButtonNew from "@/Components/FormButtonNew.vue";
import { PencilIcon } from "@heroicons/vue/solid";
import { TrashIcon } from "@heroicons/vue/solid";
import { PlusIcon } from "@heroicons/vue/solid";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
  users: Object,
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
  router.get(route("admin.users"), form);
}

/**
 * Função para editar um registro.
 * Como parâmetro recebe o ID.
 */
function actionEdit(id) {
  router.get(route("admin.users.edit", id));
}
/**
 * Função para deletar um registro.
 * Como parâmetro recebe o ID.
 */
function actionDelete(id) {
  router.delete(route("admin.users.delete", id));
}
/**
 * Função para abrir formulário de cadastro.
 */
function actionAdd() {
  router.get(route("admin.users.create"));
}

/**
 * Função para realizar o OrderBy.
 */
function sort(field) {
  form.field = field;
  form.direction = form.direction === "asc" ? "desc" : "asc";
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
    <SectionPageTable>
      <!-- #### Header da Página -->
      <template #header>
        <FormButtonNew
          @click.prevent="actionAdd"
          :iconLeft="PlusIcon"
          intent="other"
          >Adicionar
        </FormButtonNew>

        <div class="w-full md:w-1/2">
          <form @submit.prevent="submit()" class="flex items-center">
            <label for="search" class="sr-only">Procurar</label>
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
                id="search"  
                type="search"
                v-model="form.search"
                class="block w-full p-1.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Procurar"
              />
            </div>
          </form>
        </div>
      </template>

      <!-- #### Header e Body da Tabela -->
      <template #body>
        <table class="">
          <thead
            class="text-sm font-semibold text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
          >
            <tr>
              <td>#</td>
              <td class="py-3 cursor-pointer" @click="sort('name')">
                <span class="inline-flex w-full justify-center items-center"
                  >Nome
                  <!-- Se ASC-->
                  <svg
                    v-if="form.field === 'name' && form.direction === 'asc'"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 ml-1"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                  >
                    <path
                      d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"
                    />
                  </svg>
                  <!-- Se DESC-->
                  <svg
                    v-if="form.field === 'name' && form.direction === 'desc'"
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
              <td class="py-3 cursor-pointer" @click="sort('email')">
                <span class="inline-flex w-full justify-center items-center"
                  >E-mail
                  <svg
                    v-if="form.field === 'email' && form.direction === 'asc'"
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
                    v-if="form.field === 'email' && form.direction === 'desc'"
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
              <td>Funções</td>
              <td>Ação</td>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="user in users.data"
              :key="user.id"
              class="hover:bg-gray-100"
            >
              <td class="border px-4 py-2 w-10">{{ user.id }}</td>
              <td class="border px-4 py-2">{{ user.name }}</td>
              <td class="border px-4 py-2">{{ user.email }}</td>
              <td class="border px-4 py-2 space-x-2">
                <span
                  v-for="role in user.roles"
                  :key="role.id"
                  class="bg-orange-200 px-1 py-0.5 text-sm rounded-lg"
                  >{{ role.name }}
                </span>
              </td>
              <td class="border px-4 py-2 space-x-2 text-center w-36">
                <FormButtonNew
                  @click.prevent="actionEdit(user.id)"
                  :btAction="PencilIcon"
                  intent="secondary"
                  tpMin
                />
                <FormButtonNew
                  @click.prevent="actionDelete(user.id)"
                  :btAction="TrashIcon"
                  intent="danger"
                  tpMin
                />
              </td>
            </tr>
          </tbody>
        </table>
      </template>
      <!-- #### Footer da Tabela -->
      <template #footer>
        <!-- Totais -->
        <div class="font-semibold">
          <!-- TOTAL
          {{
            total.toLocaleString("pt-BR", {
              style: "currency",
              currency: "BRL",
            })
          }} -->
        </div>
        <!-- Paginação -->
        <Pagination :pagination="users" />
      </template>
    </SectionPageTable>
    <!-- #### END: Conteúdo da Página #### -->
  </AppLayout>
</template>