<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionPageForm from "@/Components/SectionPageForm.vue";

import FormInput from "@/Components/FormInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Card from "@/Components/Card.vue";

const props = defineProps({
  role: Object,
  permissions: Object,
  role_permissions: Object,
  permissions_models: Object,
  titulo: "",
});

const form = useForm({
  /* roles: [], */
  permissions: props.role_permissions,
});

/**
 * Função para submeter o formulário.
 * Persiste no BD.
 */
function submit() {
  form.put(route("admin.roles.update", props.role.id));
}

/**
 * Função para cancelar o cadastro.
 * Volta para a listagem.
 */
function cancelSave() {
  router.get(route("admin.roles"));
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

          <!-- Dados Cabeçalho -->
          <div class="border-b">
            <!-- Campo Nome -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel value="Nome" class="font-bold md:text-right pr-4" />
              </div>

              <div class="md:w-5/6">{{ role.name }}</div>
            </div>

            <!-- Campo Notas -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  value="E-mail"
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">{{ role.description }}</div>
            </div>
          </div>

          <!-- Formulário -->
          <form @submit.prevent="submit()" class="pt-5">
            <!-- Campo Nome -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  for="nome"
                  value="Permissões"
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <!-- <div class="md:w-5/6 flex flex-wrap ">
                <div v-for="permission in permissions" :key="permission.id" class=" w-full">
                    <input
                      type="checkbox"
                      v-model="form.permissions"
                      :value="permission.id"
                    />
                    <span class="pl-1.5">{{ permission.description }}</span>
                    <span class="pl-1.5">{{ permission.name }}</span>

                </div>
              </div> -->
              <div class="md:w-5/6 flex flex-wrap justify-between">
                <div
                  class="w-[48%] r-2 mb-6 sm:p-3 md:p-5 bg-white border border-gray-200 rounded-lg shadow"
                  v-for="permissions_model in permissions_models"
                  :key="permissions_model.model"
                >
                  <div class="text-xl font-medium text-gray-900 mb-1 py-1">
                    {{ permissions_model.model }}
                  </div>
                  <div
                    v-for="permission in permissions"
                    :key="permission.id"
                    class=""
                  >
                    <div
                      v-if="permission.model == permissions_model.model"
                      class="w-full text-sm flex items-center h-7"
                    >
                      <input
                      id="['permission.id']"
                      type="checkbox"
                        v-model="form.permissions"
                        :value="permission.id"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300"
                      />
                      <label class="ml-2 text-gray-900">{{permission.description}}</label>
                    </div>
                  </div>
                </div>
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