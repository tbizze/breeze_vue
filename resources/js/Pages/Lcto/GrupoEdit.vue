<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionPageForm from "@/Components/SectionPageForm.vue";

import FormInput from "@/Components/FormInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
  grupo: Object,
  titulo: "",
});

const form = useForm({
  nome: props.grupo.nome,
  notas: props.grupo.notas,
  id: props.grupo.id,
});

/**
 * Função para submeter o formulário.
 * Persiste no BD.
 */
function submit() {
  form.put(route("lcto.grupos.update", props.grupo.id));
}

/**
 * Função para cancelar o cadastro.
 * Volta para a listagem.
 */
function cancelSave() {
  router.get(route("lcto.grupos"));
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
            <!-- Campo Nome -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  for="nome"
                  value="Nome"
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">
                <FormInput v-model="form.nome" class="w-4/12" />
                <InputError :message="form.errors.nome" />
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