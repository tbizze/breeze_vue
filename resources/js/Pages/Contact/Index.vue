<script setup>
    import { Head,Link } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';

    defineProps({
        contacts: Array,
    })



</script>

<template>
  
   <!-- Carrega o Layout da Aplicação com "Logo e TopMenu, com botões Login/Logout..." -->
   <AppLayout title="Contatos">
        
        <!-- Título da Página -->
        <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Título da Página
                </h2>
        </template>

        <!-- Corpo da Página -->
        <div class="py-12">
            <div class="max-w-5xl mx-auto py-1 sm:px-6 lg:px-8">
                
                <div class="mb-4 max-w-xs">
                    <!-- <input type="search" v-model="params.search" aria-label="Search" placeholder="Search..." class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/> -->
                    <!-- <input type="search"  aria-label="Search" placeholder="Search..." class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/> -->
                </div>
                
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                    <div class="font-sans text-gray-900 antialiased ">
                        <div class="pt-4 bg-gray-100>">
                            <!-- se colocar a classe -> min-h-screen --- definirá altura minima a tela -->
                            <div class=" flex flex-col itens-center pt-6 sm:pt-0">

                                <!-- AQUI SE COLOCA O CONTEÚDO DA PÁGINA -->
                                <Link href="/contacts/create" class="w-2/12 bg-blue-500 hover:bg-blue-700 text-white font-bold text-center py-2 px-4 ml-4 mb-4 rounded">Criar</Link>
                                <table class=" table-fixed">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="w-10 px-4 py-2">#</th>
                                            <th class="px-4 py-2">Nome</th>
                                            <th class="w-1/12 px-4 py-2">idade</th>
                                            <th class=" w-2/12 px-4 py-2">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="contact in contacts" :key="contact.id">
                                            <td class="border px-4 py-2">{{contact.id}}</td>
                                            <td class="border px-4 py-2">{{contact.nome}}</td>
                                            <td class="border px-4 py-2 text-center">{{contact.idade}}</td>
                                            <td class="border px-4 py-2">
                                                <Link :href="'contacts/'+contact.id+'/show'" class=" bg-gray-500 hover:bg-gray-700 text-white text-center py-1 px-3 rounded">Ver</link>
                                                <Link :href="'contacts/'+contact.id+'/edit'" class="bg-blue-500 hover:bg-blue-700 text-white text-center py-1 px-3 ml-2 rounded">Editar</link>
                                                <Link :href="'contacts/'+contact.id+'/delete'" class="bg-red-500 hover:bg-red-700 text-white text-center py-1 px-3 ml-2 rounded">Apagar</link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- AQUI ENCERRA O CONTEÚDO DA PÁGINA -->
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

   </AppLayout>


</template>

