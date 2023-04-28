<script setup>
    import { Head,Link, router, useForm } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    
    import InputLabel from '@/Components/InputLabel.vue';
    import FormInput from '@/Components/FormInput.vue';
    import InputError from '@/Components/InputError.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';

    const props = defineProps({
        grupo: Object,
    });

    const form = useForm({
        nome: props.grupo.nome,
        observacao: props.grupo.observacao,
        id: props.grupo.id,
    });

    /**
     * Função para submeter o formulário.
     * Exige: a rota de update => método PUT +++ ID como parâmetro.
     */
    function submit(){
        /* console.log(props.grupo.id + " | " + props.grupo.descricao + " | " + props.grupo.notas); */

        router.post(route('rota_teste', props.grupo.id));
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
    <AppLayout title="Editar Grupo">
         
        <!-- Título da Página -->
        <template #header>
                 <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                     Editar Grupo 
                 </h2>
        </template>
 
        <!-- Corpo da Página -->
        <div class="py-12">
            <div class="max-w-5xl mx-auto py-1 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                    <div class="font-sans text-gray-900 antialiased ">
                        <div class="m-5">
                            <!-- se colocar a classe [ min-h-screen ] ===> definirá altura minima para elemento a da tela -->
                            <div class=" flex flex-col itens-center pt-6 sm:pt-0">
                                
                                <!-- AQUI SE COLOCA O CONTEÚDO DA PÁGINA -->


                                <form @submit.prevent="submit()" >
                                    
                                    <!-- ############ CAMPO DESCRIÇÃO -->
                                    <div class="md:flex md:items-center mb-4">
                                        <div class="md:w-1/6">                                            
                                            <InputLabel for="nome" value="Nome" class="font-bold md:text-right pr-4" />
                                        </div>

                                        <div class="md:w-5/6">
                                            
                                            <FormInput
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
                                            <InputLabel for="observacao" value="Observação" class="font-bold md:text-right pr-4" />
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
        