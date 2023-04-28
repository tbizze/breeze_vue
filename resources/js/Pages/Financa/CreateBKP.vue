<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

import FormInput from "@/Components/FormInput.vue";
import BaseListbox from "@/Components/ListBox.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
  grupos: Object,
  tipos: Object,
});
const form = useForm({
  lcto_data: "",
  lcto_historico: "",
  lcto_tipo: "",
  lcto_valor: "",
  grupo_id: "",
  errors: Object,

  person_id: null,
  role_ids: [],
});
function submit() {
  form.post("/financa");
}

/**
 * Função para cancelar o cadastro.
 * Volta para a listagem.
 */
function cancelSave() {
  router.get(route("financa"));
}

/* Criando uma Matriz de valores para popular um ListBox */
/* const roles = [
  {value: 1, label: "Marketing"},
  {value: 2, label: "Front desk"},
  {value: 3, label: "Support"},
]; */
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

    <!-- #### SEÇÃO: Corpo da Página -->
    <div class="py-12">
      <div class="max-w-5xl mx-auto py-1 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="font-sans text-gray-900 antialiased">
            <div class="m-5">
              <!-- se colocar a classe [ min-h-screen ] ===> definirá altura minima para elemento a da tela -->
              <div class="flex flex-col itens-center pt-6 sm:pt-0">
                <!-- #### START #### -->
                <!-- Conteúdo da Página -->

                <form @submit.prevent="submit()">
                  <!-- Campo Data -->
                  <div class="md:flex md:items-center mb-4">
                    <div class="md:w-1/6">
                      <InputLabel
                        for="nome"
                        value="Data"
                        class="font-bold md:text-right pr-4"
                      />
                    </div>

                    <div class="md:w-5/6">
                      <FormInput
                        v-model="form.lcto_data"
                        type="date"
                        class="w-3/12"
                      />
                      <InputError :message="form.errors.lcto_data" />
                    </div>
                  </div>

                  <!-- Campo Grupo -->
                  <div class="md:flex md:items-center mb-4">
                    <div class="md:w-1/6">
                      <InputLabel
                        for="nome"
                        value="Grupo"
                        class="font-bold md:text-right pr-4"
                      />
                    </div>

                    <div class="md:w-5/6">
                      <BaseListbox
                        v-model="form.grupo_id"
                        :options="grupos"
                        class="w-3/12"
                      />
                      <InputError :message="form.errors.grupo_id" />
                    </div>
                  </div>

                  <!-- Campo Tipo -->
                  <div class="md:flex md:items-center mb-4">
                    <div class="md:w-1/6">
                      <InputLabel
                        for="nome"
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

                  <!-- Campo Valor -->
                  <div class="md:flex md:items-center mb-4">
                    <div class="md:w-1/6">
                      <InputLabel
                        for="nome"
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
                        for="nome"
                        value="Histórico"
                        class="font-bold md:text-right pr-4"
                      />
                    </div>

                    <div class="md:w-5/6">
                      <FormInput
                        v-model="form.lcto_historico"
                        type=""
                        class="w-full"
                      />
                      <InputError :message="form.errors.lcto_historico" />
                    </div>
                  </div>

                  <!-- Campo Histórico -->
                  <div class="md:flex md:items-center mb-4">
                    <div class="md:w-1/6">
                      <InputLabel
                        for="nome"
                        value="Anotações"
                        class="font-bold md:text-right pr-4"
                      />
                    </div>

                    <div class="md:w-5/6">
                      <FormInput
                        v-model="form.lcto_notas"
                        type=""
                        class="w-full"
                      />
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>