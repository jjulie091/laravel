<script setup>
import { defineProps, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({ modelos:{type:Object}});

onMounted(() => {
  console.log(props)
});

const params = new URLSearchParams(window.location.search)

onMounted(
     
    () => {console.log(params.get('edit_url'))}
);
const form = useForm({
    nombre_modelo:props.nombre_modelo
    
});

</script>

<template>
    <Head title="Editar Modelo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Modelo</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <form @submit.prevent="form.put(params.get('edit_url'))" class="mt-6 space-y-6 max-w-xl">
                    
                    <InputLabel for="nombre_modelo" value="Nombre del Modelo"></InputLabel>
                    <TextInput id="nombre_modelo" v-model="form.nombre_modelo" autofocus required
                    type="text" 
                    class="mt-1 block w-full"></TextInput>
                    
                    <InputError :message="form.errors.nombre_modelo" class="mt-2"></InputError>
                    <PrimaryButton :disabled="form.processing">
                        <i class="fa-solid fa-save"></i> Guardar
                    </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>