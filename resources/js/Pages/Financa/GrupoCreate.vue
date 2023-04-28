<script setup>
import { Head,Link, router, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import FormInput from '@/Components/FormInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

    defineProps({
        grupos: Array,
    })

    const form = useForm({
        observacao: '',
        nome:'',
        errors: Object,
    })

    /**
     * Função para submeter o formulário.
     * Exige a rota de storage.
     */
    function submit(){
        form.post('/financa/grupos/');
    };

    /**
     * Função para cancelar o cadastro.
     * Volta para a listagem.
     */
    function cancelSave(){
        router.get(route('financa.grupos'));
    };
</script>


<template>
  
    <!-- Carrega o Layout da Aplicação com "Logo e TopMenu, com botões Login/Logout..." -->
    <AppLayout title="Criar Grupos">
         
        <!-- Título da Página -->
        <template #header>
                 <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                     Criar Grupos
                 </h2>
        </template>
 
        <!-- Corpo da Página -->
        <div class="py-12">
            <div class="max-w-5xl mx-auto py-1 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                    <div class="font-sans text-gray-900 antialiased ">
                        <div class="m-5">
                            <!-- se colocar a classe -> min-h-screen --- definirá altura minima a tela -->
                            <div class=" flex flex-col itens-center pt-6 sm:pt-0">
                                
                                <!-- AQUI SE COLOCA O CONTEÚDO DA PÁGINA -->
                                
                                <form @submit.prevent="submit()"> <!-- Usando o .prevent ele irá sobrepor o submit comum do formulário. -->
                                    
                                    <!-- ############ CAMPO DESCRIÇÃO -->
                                    <div class="md:flex md:items-center mb-4">
                                        <div class="md:w-1/6">                                            
                                            <InputLabel for="descricao" value="Descrição" class="font-bold md:text-right pr-4" />
                                        </div>

                                        <div class="md:w-5/6">
                                            <FormInput
                                                id="descricao"
                                                v-model="form.nome"
                                                type="text"
                                                class="w-4/12"
                                                />
                                            <InputError :message="form.errors.nome" /> 
                                        </div>
                                    </div>

                                    <!-- ############ CAMPO NOTAS -->
                                    <div class="md:flex md:items-center mb-4">
                                        <div class="md:w-1/6">
                                            <InputLabel for="notas" value="Notas" class="font-bold md:text-right pr-4" />
                                        </div>

                                        <div class="md:w-5/6">
                                            <FormInput
                                                id="notas"
                                                v-model="form.observacao"
                                                type="text"
                                                class="w-full"
                                                />
                                            <InputError :message="form.errors.observacao" />
                                        </div>
                                    </div>
                                    
                                    <!-- ############ BOTÕES -->
                                    <div class="md:flex flex flex-row-reverse">
                                        <div class="md:w-5/6">
                                            <!-- Botão Salvar -->
                                            <PrimaryButton>Salvar</PrimaryButton>
                                            <!-- Botão cancelar -->
                                            <SecondaryButton type="button" @click.prevent="cancelSave" class="ml-2">Cancelar</SecondaryButton>
                                        </div>
                                    </div>

                                </form>
                                <!-- AQUI ENCERRA O CONTEÚDO DA PÁGINA -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>    
        