<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {onMounted} from 'vue'

onMounted(() => {
  console.log(props)
});

const props = defineProps({
  autos:{type:Object}
});

const form = useForm({
  nombre_carro:'',
  año:'',
  persona_id:'',
  modelo_id:''
});

const deleteAuto = (id, nombre) => {
  const confirmed = confirm(`¿Estás seguro de que deseas eliminar el auto "${nombre}"?`);
  if (confirmed) {
    form.delete(route('autos.destroy', { auto: id }));

  }

};

</script>

<template>
    <Head title="Autos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Autos</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                  <Link :href="route('autos.create')"
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
                            <th class="px-4 py-4">Auto</th>
                            <th class="px-4 py-4">Año</th>
                            <th class="px-4 py-4">Persona id</th>
                            <th class="px-4 py-4">Modelo id</th>
                            <th class="px-4 py-4"></th>
                            <th class="px-4 py-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr v-for="auto, i in autos" :key="auto.id">
                        <td class="border border-gray-400 px-4 py-4">{{ (i+1) }}</td>
                        <td class="border border-gray-400 px-4 py-4 text-center">{{ auto.nombre_carro }}</td>
                        <td class="border border-gray-400 px-4 py-4 text-center">{{ auto.año }}</td>
                        <td class="border border-gray-400 px-4 py-4 text-center">{{ auto.persona_id }}</td>
                        <td class="border border-gray-400 px-4 py-4 text-center">{{ auto.modelo_id }}</td>
                        <td class="border border-gray-400 px-4 py-4">
                          <Link :href="route('autos.edit',autos)"
                            :class="'px-4 py-2 bg-yellow-400 text-white border rounded-md font-semibold text-xs'">
                            <i class="fa-solid fa-edit">Editar</i>
                            </Link>
                        </td>
                        <td class="border border-gray-400 px-4 py-4">
                          <button class="px-4 py-2 bg-red-400 text-white border rounded-md font-semibold text-xs" type="danger" @click="deleteAuto(auto.id,auto.nombre_carro)">
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


