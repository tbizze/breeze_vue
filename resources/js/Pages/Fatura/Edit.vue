<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

import FormInput from "@/Components/FormInput.vue";
import Listbox from "@/Components/ListBox.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SectionPageForm from "@/Components/SectionPageForm.vue";

const props = defineProps({
  operadoras: Object,
  fatura: Object,
  titulo: "",
});
const form = useForm({
  dt_venc: props.fatura.dt_venc,
  dt_pgto: props.fatura.dt_pgto,
  valor_pgto: props.fatura.valor_pgto,
  notas: props.fatura.notas,
  fat_operadora_id: props.fatura.fat_operadora_id,
  errors: Object,
});

/**
 * Função para submeter o formulário.
 * Persiste no BD.
 */
function submit() {
  form.put(route("fat.update", props.fatura.id));
}

/**
 * Função para cancelar o cadastro.
 * Volta para a listagem.
 */
function cancelSave() {
  router.get(route("fat"));
}
</script>

<template>
  <!-- Carrega o Layout da Aplicação com "Logo e TopMenu, com botões Login/Logout..." -->
  <AppLayout :title="props.titulo">
    <!-- #### SEÇÃO: Título da Página -->
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ titulo }}
      </h2>
    </template>
    <SectionPageForm>
      <template #corpo>
        <div class="m-5">
          <!-- #### START #### -->
          <!-- Conteúdo da Página -->

          <form @submit.prevent="submit()">
            <!-- Campo Data Venc. -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  for="dt_venc"
                  value="Dt. Venc."
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">
                <FormInput type="date" v-model="form.dt_venc" class="w-4/12" />
                <InputError :message="form.errors.dt_venc" />
              </div>
            </div>

            <!-- Campo Data Pgto. -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  for="dt_pgto"
                  value="Dt. Pgto."
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">
                <FormInput type="date" v-model="form.dt_pgto" class="w-4/12" />
                <InputError :message="form.errors.dt_pgto" />
              </div>
            </div>

            <!-- Campo Valor Pgto. -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  for="valor_pgto"
                  value="Valor Pgto."
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">
                <FormInput type="number" min="0" step=".01" v-model="form.valor_pgto" class="w-4/12" />
                <InputError :message="form.errors.valor_pgto" />
              </div>
            </div>

            <!-- Campo Operadora -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  for="fat_operadora_id"
                  value="Operadora"
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">
                <Listbox
                  v-model="form.fat_operadora_id"
                  :options="operadoras"
                  class="w-3/12"
                />
                <InputError :message="form.errors.fat_operadora_id" />
              </div>
            </div>

            <!-- Campo Notas -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  for="notas"
                  value="Anotações"
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">
                <FormInput v-model="form.notas" type="" class="w-full" />
                <InputError :message="form.errors.notas" />
              </div>
            </div>

            <!-- BOTÕES -->
            <div class="md:flex flex flex-row-reverse">
              <div class="md:w-5/6">
                <!-- Botão Salvar -->
                <PrimaryButton>Salvar</PrimaryButton>
                <!-- Botão cancelar -->
                <SecondaryButton
                  type="button"
                  @click.prevent="cancelSave"
                  class="ml-2"
                  >Cancelar</SecondaryButton
                >
              </div>
            </div>
          </form>
          <!-- #### END #### -->
          <!-- Conteúdo da Página -->
        </div>
      </template>
    </SectionPageForm>
  </AppLayout>
</template>