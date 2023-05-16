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

const props = defineProps({
  user: Object,
  roles: Object,
  user_roles: Object,
  titulo: "",
});

const form = useForm({
  /* roles: [], */
  roles: props.user_roles,
});

/**
 * Função para submeter o formulário.
 * Persiste no BD.
 */
function submit() {
  form.put(route("admin.users.update", props.user.id));
}

/**
 * Função para cancelar o cadastro.
 * Volta para a listagem.
 */
function cancelSave() {
  router.get(route("admin.users"));
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

              <div class="md:w-5/6">{{ user.name }}</div>
            </div>

            <!-- Campo Notas -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  value="E-mail"
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">{{ user.email }}</div>
            </div>
          </div>

          <!-- Formulário -->
          <form @submit.prevent="submit()" class="pt-5">
            <!-- Campo Nome -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  for="nome"
                  value="Roles"
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6 flex space-x-3">
                <div v-for="role in roles" :key="role.id">
                  <!-- <Checkbox v-model="form.roles" :value="role.id" /> -->
                  <input type="checkbox" v-model="form.roles" :value="role.id" />
                  <span class="pl-1.5">{{ role.name }}</span>
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