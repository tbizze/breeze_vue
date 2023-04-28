<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
  lancamentos: Array,
});
</script>


<template>

    <table class="">
        <tr v-for="lancamento in lancamentos" :key="lancamento.id">
            <td class="border px-4 py-2">{{lancamento.id}}</td>
            <td class="border px-4 py-2">{{lancamento.lcto_data}}</td>
            <td class="border px-4 py-2">{{lancamento.lcto_historico}}</td>
            <td class="border px-4 py-2">{{lancamento.lcto_tipo}}</td>
            <td class="border px-4 py-2">{{lancamento.lcto_valor}}</td>
            <td class="border px-4 py-2">{{lancamento.grupo_id}}</td>
            <td class="border px-4 py-2">
                <Link :href="'financa/'+lancamento.id+'/edit'" 
                    class="bg-blue-500 hover:bg-blue-700 text-white text-center py-1 px-3 ml-2 rounded"
                    >EDIT
                </link>

                <Link :href="'financa/'+lancamento.id+'/delete'" 
                    class="bg-red-500 hover:bg-red-700 text-white text-center py-1 px-3 ml-2 rounded"
                    >DEL
                </link>    
            </td>
        </tr>
    </table>

    <div class="flex">
        <!-- BOTÃO: Criar Novo -->
        <Link href="/financa/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-center py-2 px-4 ml-4 mb-4 rounded">Criar</Link>
    </div>

</template>