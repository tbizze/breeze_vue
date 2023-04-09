<script setup>
    import { Head,Link, useForm } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import InputError from '@/Components/InputError.vue';

    const props = defineProps({
        contact: Object,
    })

    const form = useForm({
        nome: props.contact.nome,
        idade: props.contact.idade,
        id: props.contact.id,
    })
    function submit(){
        form.post('/contacts/update')
        /* form.post('/contacts/' + props.contact.id + '/update') */
    }


</script>


<template>
  
    <!-- Carrega o Layout da Aplicação com "Logo e TopMenu, com botões Login/Logout..." -->
    <AppLayout title="Editar Contatos">
         
        <!-- Título da Página -->
        <template #header>
                 <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                     Editar Contatos
                 </h2>
        </template>
 
        <!-- Corpo da Página -->
        <div class="py-12">
            <div class="max-w-5xl mx-auto py-1 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                    <div class="font-sans text-gray-900 antialiased ">
                        <div class="pt-4 bg-gray-100>">
                            <!-- se colocar a classe -> min-h-screen --- definirá altura minima a tela -->
                            <div class=" flex flex-col itens-center pt-6 sm:pt-0">
                                <!-- AQUI SE COLOCA O CONTEÚDO DA PÁGINA -->

                                <!-- AQUI SE COLOCA O CONTEÚDO DA PÁGINA -->
                                <form @submit.prevent="submit()" class="w-full max-w-sm">
                                    <div class="md:flex md:items-center mb-4">
                                        <div class="md:w-1/3">
                                            <label for="inline-full-name" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">Nome</label>
                                        </div>

                                        <div class="md:w-2/3">
                                            <input v-model="form.nome" class=" bg-gray-200 appearance-none border-2 border-gray-200 hover:border-gray-300 py-1 px-2 rounded w-full">
                                            <!-- <div  class="text-sm text-red-600">{{ form.errors.nome }}</div> -->
                                            <InputError :message="form.errors.nome" />
                                        </div>
                                    </div>

                                    <div class="md:flex md:items-center mb-4">
                                        <div class="md:w-1/3">
                                            <label for="inline-full-name" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">Idade</label>
                                        </div>

                                        <div class="md:w-2/3">
                                            <input v-model="form.idade" class=" bg-gray-200 appearance-none border-2 border-gray-200 hover:border-gray-300 py-1 px-2 rounded w-full">
                                            <!-- <div v-if="form.errors.idade" class="text-sm text-red-600">{{ form.errors.idade }}</div> -->
                                            <InputError :message="form.errors.idade" />
                                        </div>
                                    </div>

                                    <div class="md:flex md:items-center mb-6">
                                        <div class="md:w-1/3">
                                        </div>

                                        <div class="md:w-2/3">
                                            <button class=" shadow bg-purple-500 hover:bg-purple-400 text-white font-bold text-center py-2 px-4 rounded">Enviar</button>
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
        