l<script setup>
    import { Head,Link } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { router } from '@inertiajs/vue3'
    import DangerButton from '@/Components/DangerButton.vue';

    defineProps({
        grupos: Object,
    })
    //router.delete(url, options)
    
    function deleteItem(grupo){
        /* form.post('/contacts/update') */
        /* form.post('/contacts/' + props.contact.id + '/update') */
        /* this.$inertia.delete('financa/grupos/3'); */
        /* router.delete('/grupos/'+grupo) */
        /* router.delete('teste/grupos/' + grupo) */
        router.delete(route('teste.delete',grupo))
    }
    
</script>


<template>
  
    <!-- Carrega o Layout da Aplicação com "Logo e TopMenu, com botões Login/Logout..." -->
    <AppLayout title="Grupos">
         
         <!-- Título da Página -->
         <template #header>
                 <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                     Grupos
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
                                 <Link :href="route('financa.grupos.create')" class="w-2/12 bg-blue-500 hover:bg-blue-700 text-white font-bold text-center py-2 px-4 ml-4 mb-4 rounded">Criar Novo</Link>
                                 <table class=" table-fixed">
                                     <thead>
                                         <tr class="bg-gray-100">
                                             <th class="w-10 px-4 py-2">#</th>
                                             <th class="px-4 py-2">Descrição</th>
                                             <th class=" px-4 py-2">Notas</th>
                                             <th class=" w-3/12 px-4 py-2">Ação</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr v-for="grupo in grupos" :key="grupo.id">
                                             <td class="border px-4 py-2">{{grupo.id}}</td>
                                             <td class="border px-4 py-2">{{grupo.nome}}</td>
                                             <td class="border px-4 py-2">{{grupo.observacao}}</td>
                                             <td class="border px-4 py-2">
                     
                                                 <!-- <Link :href="route('financa.grupos.edit', grupo.id)" class="bg-blue-500 hover:bg-blue-700 text-white text-center py-1 px-3 ml-2 rounded">Editar</link>  -->
                                                 <!-- <Link :href="route('financa.grupos.delete',grupo.id)"  class="bg-red-500 hover:bg-red-700 text-white text-center py-1 px-3 ml-2 rounded">Apagar</link> -->
                                                    <!-- <DangerButton
                                                        class="ml-3"
                                                        :class="{ 'opacity-25': form.processing }"
                                                        :disabled="form.processing"
                                                        @click="deleteUser"
                                                    >
                                                    Delete Account
                                                    </DangerButton> -->


                                                    <!-- <DangerButton type="button" @click="deleteItem(grupo.id)" class="py-0">
                                                        Del
                                                    </DangerButton> -->
                                                
                                                    
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

