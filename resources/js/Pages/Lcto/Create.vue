<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

import FormInput from "@/Components/FormInput.vue";
import BaseListbox from "@/Components/ListBox.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SectionPageForm from "@/Components/SectionPageForm.vue";

const props = defineProps({
  grupos: Object,
  tipos: Object,
  titulo: "",
});
const form = useForm({
  lcto_data: "",
  lcto_historico: "",
  lcto_tipo: "",
  lcto_valor: "",
  lcto_notas: "",
  lcto_grupo_id: "",
  errors: Object,
});

/**
 * Função para submeter o formulário.
 * Persiste no BD.
 */
function submit() {
  form.post(route("lcto.store"));
}

/**
 * Função para cancelar o cadastro.
 * Volta para a listagem.
 */
function cancelSave() {
  router.get(route("lcto"));
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
            <!-- Campo Data -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  for="lcto_data"
                  value="Data Lcto."
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">
                <FormInput
                  v-model="form.lcto_data"
                  type="date"
                  class="w-4/12"
                />
                <InputError :message="form.errors.lcto_data" />
              </div>
            </div>

            <!-- Campo Tipo -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  for="lcto_tipo"
                  value="Tipo"
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">
                <BaseListbox
                  v-model="form.lcto_tipo"
                  :options="tipos"
                  class="w-3/12"
                />
                <InputError :message="form.errors.lcto_tipo" />
              </div>
            </div>

            <!-- Campo Grupo -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  for="lcto_grupo_id"
                  value="Grupo"
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">
                <BaseListbox
                  v-model="form.lcto_grupo_id"
                  :options="grupos"
                  class="w-3/12"
                />
                <InputError :message="form.errors.lcto_grupo_id" />
              </div>
            </div>

            

            <!-- Campo Valor -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  for="lcto_valor"
                  value="Valor"
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">
                <FormInput
                  v-model="form.lcto_valor"
                  type="number"
                  min="0"
                  step=".01"
                  class="w-3/12"
                />
                <InputError :message="form.errors.lcto_valor" />
              </div>
            </div>

            <!-- Campo Histórico -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  for="lcto_historico"
                  value="Histórico"
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">
                <FormInput v-model="form.lcto_historico" class="w-full" />
                <InputError :message="form.errors.lcto_historico" />
              </div>
            </div>

            <!-- Campo Notas -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  for="nome"
                  value="Anotações"
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">
                <FormInput v-model="form.lcto_notas" type="" class="w-full" />
                <InputError :message="form.errors.lcto_notas" />
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