<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {onMounted} from 'vue'

onMounted(() => {
  console.log(props)
})

const props = defineProps({
  modelos:{type:Object}
});

const form = useForm({
  id:'',
  nombre_modelo:''

});

const deleteModelo = (id, nombre) => {
  const confirmed = confirm(`¿Estás seguro de que deseas eliminar el modelo "${nombre}"?`);
  if (confirmed) {
    form.delete(route('modelos.destroy', { modelos: id }));

  }

};

</script>

<template>
    <Head title="Modelos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modelos</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                  <Link :href="route('modelos.create')"
                    :class="'px-4 py-2 bg-gray-800 text-white border rounded-md font-semibold text-xs'">
                    <i class="fa-solid fa-plus-circle"></i> Añadir
                    </Link>
                </div>
            </div>
            <div class="bg-white grid v-screen place-items-center">
              <table class="table-auto border border-gray-400">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-4">#</th>
                            <th class="px-4 py-4">MODELOS</th>
                            <th class="px-4 py-4"></th>
                            <th class="px-4 py-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr v-for="modelo, i in modelos" :key="modelo.id">
                        <td class="border border-gray-400 px-4 py-4">{{ (i+1) }}</td>
                        <td class="border border-gray-400 px-4 py-4">{{ modelo.nombre_modelo }}</td>
                        <td class="border border-gray-400 px-4 py-4">
                          <Link :href="route('modelos.edit',modelo)"
                            :class="'px-4 py-2 bg-yellow-400 text-white border rounded-md font-semibold text-xs'">
                            <i class="fa-solid fa-edit">Editar</i>
                            </Link>
                        </td>
                        <td class="border border-gray-400 px-4 py-4">
                          <button class="px-4 py-2 bg-red-400 text-white border rounded-md font-semibold text-xs" type="danger" @click="deleteModelo(modelo.id,modelo.nombre_modelo)">
                          <i>Eliminar</i>
                          </button>
                        </td>
                        
                      </tr>
                    </tbody>
                </table>

            </div>
        </div>
        
    </AuthenticatedLayout>
</template>


