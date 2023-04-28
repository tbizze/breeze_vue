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
  lancamentos: Object,
});

/**
 * Função para cancelar o cadastro.
 * Volta para a listagem.
 */
function actionEdit(id) {
  router.get("financa/" + id + "/edit");
}
function actionDelete(id) {
  router.get("financa/" + id + "/delete");
}
function actionAdd() {
  router.get(route("financa.create"));
}

function formataData(str) {
  return str.split('-').reverse().join('/');
}
function formataValor(str) {
  return str.split('.').join(',');
}

/* const widthClass = computed(() => {
    return {
        '48': 'w-48',
    }[props.width.toString()];
});
const fnData = computed(() => {
    if (props.align === 'left') {
        return 'origin-top-left left-0';
    }

    if (props.align === 'right') {
        return 'origin-top-right right-0';
    }

    return 'origin-top';
}); */
</script>


<template>
  <!-- Carrega o Layout da Aplicação com "Logo e TopMenu, com botões Login/Logout..." -->
  <AppLayout title="Editar Lançamento">
    <!-- #### SEÇÃO: Título da Página -->
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Editar Lançamento
      </h2>
    </template>

    <!-- #### START: Conteúdo da Página #### -->
    <SectionPageForm>
      
      <!-- Cabeçalho da Página -->
      <template #topo>
        <div class="flex items-center justify-between space-x-4 px-4 py-2 bg-gray-50">
          <FormButtonNew
            @click.prevent="actionAdd"
            :iconLeft="PlusIcon"
            intent="other"
          >
            Adicionar
          </FormButtonNew>
          <PaginationNew :data="lancamentos" />
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
            <!-- <td class="border px-4 py-2">{{ formataData(lancamento.lcto_data) }}</td> -->
            <!-- <td class="border px-4 py-2">{{\Carbon\Carbon::createFromTimeStamp(strtotime($Project.created_at))->diffForHumans()}}</td> -->
            <td class="border px-4 py-2">{{ lancamento.lcto_historico }}</td>
            <td class="border px-4 py-2">{{ lancamento.lcto_tipo }}</td>
            <td class="border px-4 py-2 text-right">{{ formataValor(lancamento.lcto_valor) }}</td>
            <!-- <td class="border px-4 py-2">{{ lancamento.grupo_id }}</td> -->
            <td class="border px-4 py-2">{{ lancamento.grupo.nome }}</td>
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
        

        <!-- <table>
          <tr class="" v-for="lancamento in lancamentos.links"
              :key="lancamento.id">
            <td>{{lancamento.links}}gsgs</td>
          </tr>
        </table> -->
      </template>

    </SectionPageForm>
    <!-- #### END: Conteúdo da Página #### -->
  </AppLayout>
</template>